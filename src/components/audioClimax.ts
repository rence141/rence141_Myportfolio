// Real-time Web Audio analyzer that detects true musical climaxes (choruses/drops)
// from local <video> playback without triggering React re-renders.

export const SPECTRUM_BANDS = 16;

export type AudioEnergy = {
  active: boolean;
  energy: number;
  bass: number;
  mid: number;
  high: number;
  climax: number;
  beat: number;
  bands: Float32Array;
};

export function createAudioEnergy(): AudioEnergy {
  return {
    active: false,
    energy: 0,
    bass: 0,
    mid: 0,
    high: 0,
    climax: 0,
    beat: 0,
    bands: new Float32Array(SPECTRUM_BANDS),
  };
}

const clamp01 = (v: number) => (v < 0 ? 0 : v > 1 ? 1 : v);

export class ClimaxAnalyzer {
  private ctx: AudioContext | null = null;
  private analyser: AnalyserNode | null = null;
  private source: MediaElementAudioSourceNode | null = null;
  private freqData: Uint8Array<ArrayBuffer> | null = null;
  private timeData: Uint8Array<ArrayBuffer> | null = null;
  private connectedEl: HTMLMediaElement | null = null;
  private failed = false;

  // Adaptive loudness & beat trackers (reset on each track change).
  private fastEnergy = 0;
  private slowEnergy = 0.36;
  private peakEnergy = 0.6;
  private bassAvg = 0.3;
  private highAvg = 0.22;
  private lastBeatTime = 0;
  private activeFrames = 0;

  ensureConnected(media: HTMLMediaElement): boolean {
    if (this.failed) return false;
    if (this.connectedEl === media && this.ctx && this.analyser) return true;
    const AudioCtx = window.AudioContext ?? (window as unknown as { webkitAudioContext?: typeof AudioContext }).webkitAudioContext;
    if (!AudioCtx) {
      this.failed = true;
      return false;
    }
    try {
      const ctx = new AudioCtx();
      const analyser = ctx.createAnalyser();
      analyser.fftSize = 512;
      analyser.smoothingTimeConstant = 0.78;
      const source = ctx.createMediaElementSource(media);
      source.connect(analyser);
      analyser.connect(ctx.destination);
      this.ctx = ctx;
      this.analyser = analyser;
      this.source = source;
      this.freqData = new Uint8Array(new ArrayBuffer(analyser.frequencyBinCount));
      this.timeData = new Uint8Array(new ArrayBuffer(analyser.fftSize));
      this.connectedEl = media;
      return true;
    } catch {
      this.failed = true;
      return false;
    }
  }

  resume(): void {
    if (this.ctx && this.ctx.state === 'suspended') {
      void this.ctx.resume().catch(() => undefined);
    }
  }

  resetTrack(target?: AudioEnergy): void {
    this.fastEnergy = 0;
    this.slowEnergy = 0.36;
    this.peakEnergy = 0.6;
    this.bassAvg = 0.3;
    this.highAvg = 0.22;
    this.lastBeatTime = 0;
    this.activeFrames = 0;
    if (target) {
      target.energy = 0;
      target.bass = 0;
      target.mid = 0;
      target.high = 0;
      target.climax = 0;
      target.beat = 0;
      target.bands.fill(0);
    }
  }

  update(now: number, playing: boolean, out: AudioEnergy): AudioEnergy {
    if (!playing || !this.analyser || !this.freqData || !this.timeData || this.ctx?.state !== 'running') {
      out.active = false;
      out.energy *= 0.88;
      out.bass *= 0.86;
      out.mid *= 0.86;
      out.high *= 0.86;
      out.climax *= 0.9;
      out.beat *= 0.8;
      for (let i = 0; i < out.bands.length; i++) out.bands[i] *= 0.86;
      return out;
    }

    const freq = this.freqData;
    const time = this.timeData;
    this.analyser.getByteFrequencyData(freq);
    this.analyser.getByteTimeDomainData(time);

    let sumSq = 0;
    for (let i = 0; i < time.length; i++) {
      const sample = (time[i] - 128) / 128;
      sumSq += sample * sample;
    }
    const rms = Math.sqrt(sumSq / time.length);

    const avgBins = (start: number, end: number) => {
      let sum = 0;
      const clampedEnd = Math.min(freq.length, end);
      for (let i = start; i < clampedEnd; i++) sum += freq[i];
      return clampedEnd > start ? sum / ((clampedEnd - start) * 255) : 0;
    };
    const bass = avgBins(1, 5);
    const mid = avgBins(5, 28);
    const high = avgBins(28, 100);

    const maxBin = Math.min(freq.length - 1, 118);
    for (let b = 0; b < SPECTRUM_BANDS; b++) {
      const t0 = b / SPECTRUM_BANDS;
      const t1 = (b + 1) / SPECTRUM_BANDS;
      const i0 = Math.max(1, Math.floor(Math.pow(maxBin, t0)));
      const i1 = Math.max(i0 + 1, Math.floor(Math.pow(maxBin, t1)));
      out.bands[b] = out.bands[b] * 0.6 + avgBins(i0, i1) * 0.4;
    }

    const spectralFullness = bass * 0.38 + mid * 0.34 + high * 0.28;
    const rawEnergy = clamp01(rms * 1.4 * 0.55 + spectralFullness * 0.45);

    // Calibrate smoothly during opening ~3s so intros stay understated and only
    // genuine high-energy climaxes trigger stronger pixel effects.
    this.activeFrames++;
    this.fastEnergy += (rawEnergy - this.fastEnergy) * 0.12;
    const slowRate = this.activeFrames < 140 ? 0.08 : 0.005;
    this.slowEnergy += (rawEnergy - this.slowEnergy) * slowRate;
    if (this.fastEnergy > this.peakEnergy) {
      this.peakEnergy += (this.fastEnergy - this.peakEnergy) * 0.08;
    } else {
      this.peakEnergy = Math.max(0.52, this.peakEnergy * 0.9995);
    }

    const warmup = clamp01((this.activeFrames - 30) / 110);
    const loudnessScore = clamp01((this.fastEnergy - 0.36) / Math.max(0.16, this.peakEnergy * 0.92 - 0.36));
    const surgeScore = clamp01((this.fastEnergy - this.slowEnergy - 0.05) / 0.16);
    const spectrumGate = clamp01((bass * 0.5 + high * 0.5 - 0.28) / 0.38);

    const combined = clamp01(loudnessScore * 0.68 + surgeScore * 0.42) * (0.35 + 0.65 * spectrumGate) * warmup;
    const shapedClimax = combined > 0.32 ? Math.pow((combined - 0.32) / 0.68, 1.35) : 0;

    // Smooth, unhurried swell and fade so visuals feel atmospheric, never frantic.
    const climaxRate = shapedClimax > out.climax ? 0.07 : 0.025;
    out.climax += (shapedClimax - out.climax) * climaxRate;

    const bassDelta = bass - this.bassAvg;
    const highDelta = high - this.highAvg;
    this.bassAvg += (bass - this.bassAvg) * 0.12;
    this.highAvg += (high - this.highAvg) * 0.14;

    const onset = Math.max(0, bassDelta * 3.4) + Math.max(0, highDelta * 1.4);
    if (onset > 0.32 && now - this.lastBeatTime > 200 && rawEnergy > 0.3) {
      out.beat = Math.max(out.beat, clamp01(onset));
      this.lastBeatTime = now;
    } else {
      out.beat *= 0.86;
    }

    out.active = true;
    out.energy = this.fastEnergy;
    out.bass = bass;
    out.mid = mid;
    out.high = high;
    return out;
  }

  dispose(): void {
    try {
      this.source?.disconnect();
      this.analyser?.disconnect();
      void this.ctx?.close().catch(() => undefined);
    } catch {
      // Ignore cleanup errors on already-closed contexts.
    }
    this.source = null;
    this.analyser = null;
    this.ctx = null;
    this.connectedEl = null;
  }
}
