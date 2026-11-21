import { useEffect, useRef, type RefObject } from 'react';
import type { AudioEnergy } from './audioClimax';

const COLS = 160;
const ROWS = 20;
const CELL = 5;
const FONT = '16px "DotGothic16", "MS Gothic", "Yu Gothic", monospace';
const FONT_SM = '12px "DotGothic16", "MS Gothic", "Yu Gothic", monospace';
export const LYRIC_MAX_EM = 10; // full-width characters per board line

const width = (ch: string) => (/[\u0000-\u00ff]/.test(ch) ? 0.5 : 1);

// Split a lyric line into pieces that fit the board (Japanese or Latin text).
export function chunkWide(text: string, maxEm = LYRIC_MAX_EM): string[] {
  const chunks: string[] = [];
  let current = '';
  let size = 0;
  for (const word of text.trim().split(/\s+/).filter(Boolean)) {
    const wordSize = [...word].reduce((sum, ch) => sum + width(ch), 0);
    if (current && size + .5 + wordSize <= maxEm) { current += ' ' + word; size += .5 + wordSize; continue; }
    if (current) { chunks.push(current); current = ''; size = 0; }
    if (wordSize <= maxEm) { current = word; size = wordSize; continue; }
    for (const ch of word) {
      if (size + width(ch) > maxEm) { chunks.push(current); current = ''; size = 0; }
      current += ch; size += width(ch);
    }
  }
  if (current) chunks.push(current);
  return chunks;
}

// Pixel-grid lyric display: text is rasterised onto a small grid, then drawn as lit cells.
export function LyricBoard({ text, energyRef }: { text: string; energyRef?: RefObject<AudioEnergy> }) {
  const canvasRef = useRef<HTMLCanvasElement>(null);
  const maskRef = useRef<Uint8Array>(new Uint8Array(COLS * ROWS));
  const haloRef = useRef<Uint8Array>(new Uint8Array(COLS * ROWS));

  useEffect(() => {
    let cancelled = false;
    const sample = document.createElement('canvas');
    sample.width = COLS; sample.height = ROWS;
    const ctx = sample.getContext('2d', { willReadFrequently: true });
    const mask = new Uint8Array(COLS * ROWS);
    const halo = new Uint8Array(COLS * ROWS);
    const render = () => {
      if (cancelled || !ctx) return;
      ctx.clearRect(0, 0, COLS, ROWS);
      ctx.fillStyle = '#fff';
      ctx.font = FONT;
      const small = ctx.measureText(text).width > COLS - 4;
      if (small) ctx.font = FONT_SM;
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      ctx.fillText(text, COLS / 2, ROWS / 2 + 1, COLS - 4);
      const data = ctx.getImageData(0, 0, COLS, ROWS).data;
      const cutoff = small ? 90 : 110;
      for (let i = 0; i < mask.length; i++) mask[i] = data[i * 4 + 3] > cutoff ? 1 : 0;
      halo.fill(0);
      for (let y = 0; y < ROWS; y++) for (let x = 0; x < COLS; x++) {
        const i = y * COLS + x;
        if (mask[i]) continue;
        if ((x > 0 && mask[i - 1]) || (x < COLS - 1 && mask[i + 1]) ||
            (y > 0 && mask[i - COLS]) || (y < ROWS - 1 && mask[i + COLS])) {
          halo[i] = 1;
        }
      }
      maskRef.current = mask;
      haloRef.current = halo;
    };
    render();
    // Re-rasterise once the pixel font finishes loading.
    document.fonts?.load(FONT, text).then(render).catch(() => undefined);
    return () => { cancelled = true; };
  }, [text]);

  useEffect(() => {
    const canvas = canvasRef.current;
    const ctx = canvas?.getContext('2d');
    if (!canvas || !ctx) return;
    canvas.width = COLS * CELL; canvas.height = ROWS * CELL;
    const compact = window.matchMedia('(max-width: 600px), (pointer: coarse)').matches;
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let tick = 0;
    let lastDraw = -Infinity;
    let raf = 0;
    const draw = (now: number) => {
      raf = requestAnimationFrame(draw);
      if (document.hidden) return;
      const energy = energyRef?.current;
      const climax = energy?.climax ?? 0;
      const beat = reducedMotion ? 0 : (energy?.beat ?? 0);
      const interval = compact ? 240 : climax > 0.5 ? 70 : 90;
      if (now - lastDraw < interval) return;
      lastDraw = now;
      tick++;

      ctx.fillStyle = '#100d18';
      ctx.fillRect(0, 0, canvas.width, canvas.height);

      const mask = maskRef.current;
      const halo = haloRef.current;
      const sparkleLimit = 4 + Math.round(climax * 18);
      const brightSparkleLimit = Math.round(Math.max(0, climax - 0.55) * 6);
      const showHalo = climax > 0.6;
      const litColor = climax > 0.72 && beat > 0.55
        ? '#e2d7ff'
        : climax > 0.55
          ? '#cbb8ff'
          : '#b8a0ff';

      for (let y = 0; y < ROWS; y++) for (let x = 0; x < COLS; x++) {
        const index = y * COLS + x;
        if (mask[index]) {
          ctx.fillStyle = litColor;
        } else if (showHalo && halo[index]) {
          ctx.fillStyle = '#402f63';
        } else {
          const hash = ((index * 2654435761 + tick * 40503) >>> 0) % 997;
          if (brightSparkleLimit > 0 && hash < brightSparkleLimit) {
            ctx.fillStyle = '#8b6fd6';
          } else if (hash < sparkleLimit) {
            ctx.fillStyle = climax > 0.5 ? '#5c468c' : '#4a3a6b';
          } else {
            ctx.fillStyle = '#282033';
          }
        }
        ctx.fillRect(x * CELL + .5, y * CELL + .5, CELL - 1, CELL - 1);
      }
    };
    raf = requestAnimationFrame(draw);
    return () => cancelAnimationFrame(raf);
  }, [energyRef]);

  return <div className="pixel-board">
    <canvas ref={canvasRef} className="lyric-board" role="img" aria-label={`Lyric: ${text}`} />
  </div>;
}
