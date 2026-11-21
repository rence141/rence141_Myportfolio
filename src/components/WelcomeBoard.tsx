import { useCallback, useEffect, useRef, useState } from 'react';
import { songs, type LyricLine } from '../data/songs';
import { PixelTitle } from './PixelTitle';
import { LyricBoard, chunkWide } from './LyricBoard';
import { ClimaxAnalyzer, createAudioEnergy, type AudioEnergy } from './audioClimax';
import { PixelClimaxOverlay } from './PixelClimaxOverlay';

type YTPlayer = {
  loadVideoById: (id: string) => void;
  stopVideo: () => void;
  destroy: () => void;
  getCurrentTime: () => number;
  getDuration: () => number;
};
type YTApi = { Player: new (el: HTMLElement, opts: unknown) => YTPlayer };
declare global { interface Window { YT?: YTApi; onYouTubeIframeAPIReady?: () => void } }

let apiPromise: Promise<YTApi> | null = null;
function loadYouTubeApi(): Promise<YTApi> {
  if (window.YT?.Player) return Promise.resolve(window.YT);
  if (!apiPromise) apiPromise = new Promise(resolve => {
    const previous = window.onYouTubeIframeAPIReady;
    window.onYouTubeIframeAPIReady = () => { previous?.(); resolve(window.YT as YTApi); };
    const script = document.createElement('script');
    script.src = 'https://www.youtube.com/iframe_api';
    document.head.appendChild(script);
  });
  return apiPromise;
}

// Fetch time-synced lyrics from LRCLIB (free, no key) when a song has none of its own.
async function fetchSyncedLyrics(title: string, artist: string, duration: number, signal: AbortSignal): Promise<LyricLine[]> {
  type Hit = { syncedLyrics?: string | null; duration?: number };
  const search = async (params: URLSearchParams) => {
    const response = await fetch(`https://lrclib.net/api/search?${params}`, { signal });
    return response.ok ? ((await response.json()) as Hit[]).filter(item => item.syncedLyrics) : [];
  };
  let synced = await search(new URLSearchParams(artist ? { track_name: title, artist_name: artist } : { track_name: title }));
  if (!synced.length) synced = await search(new URLSearchParams({ q: `${artist} ${title}`.trim() }));
  if (!synced.length) return [];
  synced.sort((a, b) => Math.abs((a.duration ?? 0) - duration) - Math.abs((b.duration ?? 0) - duration));
  const lines: LyricLine[] = [];
  for (const raw of (synced[0].syncedLyrics as string).split('\n')) {
    const match = raw.match(/^\[(\d+):(\d+(?:\.\d+)?)\](.*)$/);
    if (match && match[3].trim()) lines.push({ t: Number(match[1]) * 60 + Number(match[2]), text: match[3].trim() });
  }
  return lines;
}
const songHeading = (song: { title: string; artist: string }) => (song.artist ? `${song.title} - ${song.artist}` : song.title);

// Welcome board + a hidden easter-egg button. Clicking the tiny dot in the
// corner starts playing favourite songs with live pixel lyrics and pixelated
// video, revealing pixel prev, stop, and next buttons.
export function WelcomeBoard({ name }: { name: string }) {
  const [songIndex, setSongIndex] = useState(-1);
  const [playbackError, setPlaybackError] = useState(false);
  const [lyric, setLyric] = useState<string | undefined>(undefined);
  const boardRef = useRef<HTMLDivElement | null>(null);
  const hostRef = useRef<HTMLDivElement>(null);
  const mediaRef = useRef<HTMLVideoElement | null>(null);
  const canvasRef = useRef<HTMLCanvasElement | null>(null);
  const analyzerRef = useRef<ClimaxAnalyzer | null>(null);
  const energyRef = useRef<AudioEnergy>(createAudioEnergy());
  const [fetched, setFetched] = useState<Record<number, LyricLine[]>>({});
  const playerRef = useRef<YTPlayer | null>(null);
  const readyRef = useRef<Promise<YTPlayer> | null>(null);
  const playbackRequest = useRef(0);

  // Call play inside the tap handler so mobile browsers retain user activation.
  const selectSong = (index: number) => {
    setPlaybackError(false);
    const request = ++playbackRequest.current;
    const media = mediaRef.current;
    playerRef.current?.stopVideo();
    media?.pause();
    analyzerRef.current ??= new ClimaxAnalyzer();
    analyzerRef.current.resetTrack(energyRef.current);
    if (media && songs[index]?.src) {
      analyzerRef.current.ensureConnected(media);
      analyzerRef.current.resume();
      media.src = songs[index].src!;
      void media.play().catch(() => {
        if (playbackRequest.current === request) setPlaybackError(true);
      });
    } else if (media) {
      // Cancel pending downloads and release the decoder when playback stops.
      media.removeAttribute('src');
      media.load();
    }
    setSongIndex(index);
  };

  const tickAudio = useCallback((now: number) => {
    const media = mediaRef.current;
    const playingLocal = Boolean(media && !media.paused && !media.ended && media.readyState >= 2);
    analyzerRef.current?.update(now, playingLocal, energyRef.current);
  }, []);

  const getPlayer = useCallback(() => {
    if (!readyRef.current) readyRef.current = loadYouTubeApi().then(YT => new Promise<YTPlayer>(resolve => {
      const mount = document.createElement('div');
      hostRef.current?.appendChild(mount);
      const player: YTPlayer = new YT.Player(mount, {
        width: 200, height: 200,
        playerVars: { playsinline: 1, controls: 0, rel: 0 },
        events: { onReady: () => { playerRef.current = player; resolve(player); } },
      });
    }));
    return readyRef.current;
  }, []);

  // Start / stop playback whenever the selected song changes.
  useEffect(() => {
    const stopAll = () => { playerRef.current?.stopVideo(); mediaRef.current?.pause(); };
    if (songIndex < 0) { stopAll(); setLyric(undefined); return; }
    const song = songs[songIndex];
    setLyric(songHeading(song));
    let cancelled = false;
    if (!song.src && song.youtubeId) {
      stopAll();
      getPlayer().then(player => { if (!cancelled) player.loadVideoById(song.youtubeId as string); });
    }
    return () => { cancelled = true; };
  }, [songIndex, getPlayer]);

  // Look up live (time-synced) lyrics for songs that don't have any yet.
  useEffect(() => {
    if (songIndex < 0 || songs[songIndex].lines.length || fetched[songIndex] !== undefined) return;
    const song = songs[songIndex];
    if (!song.title || /^song \d+$/i.test(song.title)) return;
    const controller = new AbortController();
    const run = (duration: number) => {
      if (controller.signal.aborted) return;
      fetchSyncedLyrics(song.title, song.artist, duration, controller.signal)
        .then(lines => setFetched(previous => ({ ...previous, [songIndex]: lines })))
        .catch(() => { if (!controller.signal.aborted) setFetched(previous => ({ ...previous, [songIndex]: [] })); });
    };
    const knownDuration = song.duration ?? (mediaRef.current?.duration || 0);
    if (knownDuration > 0 && Number.isFinite(knownDuration)) {
      run(knownDuration);
      return () => controller.abort();
    }
    const media = song.src ? mediaRef.current : null;
    if (!media) {
      run(0);
      return () => controller.abort();
    }
    let settled = false;
    const finish = () => {
      if (settled) return;
      settled = true;
      window.clearTimeout(fallbackTimer);
      media.removeEventListener('loadedmetadata', finish);
      run(Number.isFinite(media.duration) && media.duration > 0 ? media.duration : 0);
    };
    const fallbackTimer = window.setTimeout(finish, 1500);
    media.addEventListener('loadedmetadata', finish, { once: true });
    return () => {
      controller.abort();
      window.clearTimeout(fallbackTimer);
      media.removeEventListener('loadedmetadata', finish);
    };
  }, [songIndex, fetched]);
  // Follow the playback position and pick the lyric line.
  useEffect(() => {
    if (songIndex < 0) return;
    const song = { ...songs[songIndex], lines: songs[songIndex].lines.length ? songs[songIndex].lines : (fetched[songIndex] ?? []) };
    const lyricChunks = song.lines.map(line => chunkWide(line.text));
    const timer = window.setInterval(() => {
      if (document.hidden) return;
      const media = mediaRef.current;
      const player = song.src ? null : playerRef.current;
      if (!song.src && !player) return;
      const time = song.src ? (media?.currentTime ?? 0) : player!.getCurrentTime();
      const duration = song.src ? (media?.duration || 0) : (player!.getDuration() || 0);
      let current = -1;
      for (let i = 0; i < song.lines.length; i++) if (song.lines[i].t <= time) current = i;
      if (current < 0) { setLyric(songHeading(song)); return; }
      const line = song.lines[current];
      const end = song.lines[current + 1]?.t ?? Math.max(line.t + 4, duration || line.t + 4);
      const chunks = lyricChunks[current];
      const progress = Math.min(.999, Math.max(0, (time - line.t) / Math.max(.5, end - line.t)));
      setLyric(chunks[Math.floor(progress * chunks.length)] ?? '');
    }, 120);
    return () => window.clearInterval(timer);
  }, [songIndex, fetched]);

  // Draw the playing video as a pixelated violet dot grid (local files only),
  // adding subtle pixel shimmer and delicate rising sparks during musical climaxes.
  useEffect(() => {
    const song = songIndex >= 0 ? songs[songIndex] : undefined;
    const canvas = canvasRef.current;
    const media = mediaRef.current;
    if (!song?.src || !canvas || !media) return;
    const cols = 128, rows = 72, cell = 6;
    const frameInterval = 1000 / 24;
    canvas.width = cols * cell; canvas.height = rows * cell;
    const ctx = canvas.getContext('2d');
    const sample = document.createElement('canvas'); sample.width = cols; sample.height = rows;
    const sctx = sample.getContext('2d', { willReadFrequently: true });
    if (!ctx || !sctx) return;
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let raf = 0;
    let videoFrame = 0;
    const decodedFrames = typeof media.requestVideoFrameCallback === 'function';
    let lastDraw = -Infinity;
    let lastMediaTime = -1;
    let frameTick = 0;
    const sparks: { x: number; y: number; vy: number; vx: number; life: number; bright: boolean }[] = [];
    const draw = (now: number) => {
      if (!document.hidden && !media.paused && media.readyState >= 2 &&
          (decodedFrames || now - lastDraw >= frameInterval) && media.currentTime !== lastMediaTime) {
        lastDraw = now;
        lastMediaTime = media.currentTime;
        frameTick++;
        sctx.drawImage(media, 0, 0, cols, rows);
        const data = sctx.getImageData(0, 0, cols, rows).data;

        const energy = energyRef.current;
        const climax = energy.climax;
        const beat = reducedMotion ? 0 : energy.beat;
        const high = energy.high;
        const gain = 1.25 + climax * 0.14 + beat * climax * 0.08;
        const hotCutoff = 0.85 - climax * 0.06;

        ctx.fillStyle = '#0d0a14';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        const sparkleChance = climax > 0.4 ? Math.round((climax - 0.4) * (4 + high * 8)) : 0;

        for (let y = 0; y < rows; y++) for (let x = 0; x < cols; x++) {
          const p = (y * cols + x) * 4;
          const light = Math.min(1, ((data[p] * .3 + data[p + 1] * .59 + data[p + 2] * .11) / 255) * gain);
          if (light < .06) {
            if (sparkleChance > 0 && (((x * 73856093 ^ y * 19349663 ^ frameTick * 83492791) >>> 0) % 1000) < sparkleChance) {
              ctx.fillStyle = climax > 0.7 ? '#6c51a8' : '#3d2c5e';
              ctx.fillRect(x * cell, y * cell, cell - 1, cell - 1);
            }
            continue;
          }
          const b = .35 + light * .65;
          ctx.fillStyle = light > hotCutoff
            ? `rgb(${238 * b | 0},${237 * b | 0},${246 * b | 0})`
            : `rgb(${184 * b | 0},${160 * b | 0},${255 * b | 0})`;
          ctx.fillRect(x * cell, y * cell, cell - 1, cell - 1);

          // Spawn delicate rising single-pixel sparks from bright regions during climax.
          if (climax > 0.4 && light > 0.8 && sparks.length < 18 && Math.random() < climax * 0.0022) {
            sparks.push({
              x,
              y,
              vx: (Math.random() - 0.5) * 0.35,
              vy: -(0.35 + Math.random() * 0.55),
              life: 10 + Math.floor(Math.random() * 12),
              bright: climax > 0.7 && Math.random() < 0.35,
            });
          }
        }

        // Update & draw subtle rising pixel sparks inside the dot grid.
        for (let i = sparks.length - 1; i >= 0; i--) {
          const sp = sparks[i];
          sp.x += sp.vx;
          sp.y += sp.vy;
          sp.life--;
          const gx = Math.round(sp.x);
          const gy = Math.round(sp.y);
          if (sp.life <= 0 || gy < 0 || gx < 0 || gx >= cols) {
            sparks.splice(i, 1);
            continue;
          }
          ctx.fillStyle = sp.bright ? '#eeedf6' : sp.life > 6 ? '#cdbbff' : '#8d72d4';
          ctx.fillRect(gx * cell, gy * cell, cell - 1, cell - 1);
        }
      }
      schedule();
    };
    // Only process decoded frames; older browsers use the throttled RAF path.
    const schedule = () => {
      if (decodedFrames) {
        videoFrame = media.requestVideoFrameCallback(draw);
      } else {
        raf = requestAnimationFrame(draw);
      }
    };
    schedule();
    return () => {
      cancelAnimationFrame(raf);
      if (videoFrame) media.cancelVideoFrameCallback(videoFrame);
    };
  }, [songIndex]);
  useEffect(() => {
    const media = mediaRef.current;
    return () => {
      ++playbackRequest.current;
      media?.pause();
      media?.removeAttribute('src');
      media?.load();
      playerRef.current?.destroy();
      analyzerRef.current?.dispose();
    };
  }, []);

  const start = () => selectSong(0);
  const prev = () => selectSong((songIndex - 1 + songs.length) % songs.length);
  const next = () => selectSong((songIndex + 1) % songs.length);
  const stop = () => selectSong(-1);

  const currentSong = songIndex >= 0 ? songs[songIndex] : undefined;
  const videoUrl = currentSong?.videoUrl ?? (currentSong?.youtubeId ? `https://www.youtube.com/watch?v=${currentSong.youtubeId}` : undefined);
  const artistChannelUrl = currentSong?.artistChannelUrl;

  return <div ref={boardRef} className={songIndex >= 0 ? 'welcome-board playing' : 'welcome-board'}>
    <PixelClimaxOverlay active={songIndex >= 0} energyRef={energyRef} anchorRef={boardRef} onTick={tickAudio} />
    {lyric === undefined ? <PixelTitle name={name} /> : <LyricBoard text={lyric} energyRef={energyRef} />}
    {songs.length > 0 && songIndex < 0 && (
      <div className="egg-hint">
        <button id="egg-play-btn" type="button" className="egg-button" onClick={start} aria-label="Play song" title="Play song" />
      </div>
    )}
    <div className="song-stage" hidden={songIndex < 0}>
        <video ref={mediaRef} className="egg-video-src"
          playsInline preload="metadata" aria-hidden="true"
          onError={() => { if (songIndex >= 0) setPlaybackError(true); }}
          onEnded={() => selectSong(songIndex + 1 < songs.length ? songIndex + 1 : -1)} />
        {currentSong && <>
        {playbackError && <div role="status">Video could not start. <button type="button" className="egg-ctrl" onClick={() => selectSong(songIndex)}>Retry</button></div>}
        {currentSong.src && <canvas ref={canvasRef} className="song-video" role="img" aria-label="Pixelated music video" />}
        <div className="song-bar">
          <span className="song-meta">
            <span className="song-meta-note" aria-hidden="true">♪ </span>
            {videoUrl ? (
              <a
                className="song-meta-link song-meta-title"
                href={videoUrl}
                target="_blank"
                rel="noopener noreferrer"
                aria-label={`${currentSong.title} — official music video on YouTube (opens in a new tab)`}
                title={`Watch ${currentSong.title} official music video on YouTube`}
              >
                <span className="song-meta-label">{currentSong.title}</span>
              </a>
            ) : (
              <span className="song-meta-title">{currentSong.title}</span>
            )}
            {currentSong.artist && (
              <>
                <span className="song-meta-sep" aria-hidden="true"> — </span>
                {artistChannelUrl ? (
                  <a
                    className="song-meta-link song-meta-artist"
                    href={artistChannelUrl}
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label={`${currentSong.artist} — official YouTube channel (opens in a new tab)`}
                    title={`Visit ${currentSong.artist} official YouTube channel`}
                  >
                    <span className="song-meta-label">{currentSong.artist}</span>
                    <svg className="song-meta-ext-icon" viewBox="0 0 9 9" width="9" height="9" shapeRendering="crispEdges" aria-hidden="true">
                      <rect x="0" y="2" width="4" height="1" />
                      <rect x="0" y="3" width="1" height="6" />
                      <rect x="1" y="8" width="6" height="1" />
                      <rect x="6" y="5" width="1" height="3" />
                      <rect x="5" y="0" width="4" height="1" />
                      <rect x="8" y="1" width="1" height="3" />
                      <rect x="7" y="1" width="1" height="1" />
                      <rect x="6" y="2" width="1" height="1" />
                      <rect x="5" y="3" width="1" height="1" />
                      <rect x="4" y="4" width="1" height="1" />
                    </svg>
                  </a>
                ) : (
                  <span className="song-meta-artist">{currentSong.artist}</span>
                )}
              </>
            )}
          </span>
          <div className="egg-controls" role="group" aria-label="Song controls">
            <button type="button" className="egg-ctrl" onClick={prev} aria-label="Previous song" title="Previous song">
              <svg viewBox="0 0 7 7" width="9" height="9" shapeRendering="crispEdges" aria-hidden="true">
                <rect x="1" y="1" width="1" height="5" />
                <rect x="3" y="3" width="1" height="1" />
                <rect x="4" y="2" width="1" height="3" />
                <rect x="5" y="1" width="1" height="5" />
              </svg>
            </button>
            <button type="button" className="egg-ctrl egg-stop" onClick={stop} aria-label="Stop song" title="Stop">
              <svg viewBox="0 0 7 7" width="9" height="9" shapeRendering="crispEdges" aria-hidden="true">
                <rect x="1" y="1" width="5" height="5" />
              </svg>
            </button>
            <button type="button" className="egg-ctrl" onClick={next} aria-label="Next song" title="Next song">
              <svg viewBox="0 0 7 7" width="9" height="9" shapeRendering="crispEdges" aria-hidden="true">
                <rect x="1" y="1" width="1" height="5" />
                <rect x="2" y="2" width="1" height="3" />
                <rect x="3" y="3" width="1" height="1" />
                <rect x="5" y="1" width="1" height="5" />
              </svg>
            </button>
          </div>
        </div>
        </>}
    </div>
    <div ref={hostRef} className="egg-player" aria-hidden="true" />
  </div>;
}
