import { useEffect, useRef } from 'react';

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
export function LyricBoard({ text }: { text: string }) {
  const canvasRef = useRef<HTMLCanvasElement>(null);
  const maskRef = useRef<Uint8Array>(new Uint8Array(COLS * ROWS));

  useEffect(() => {
    let cancelled = false;
    const sample = document.createElement('canvas');
    sample.width = COLS; sample.height = ROWS;
    const ctx = sample.getContext('2d', { willReadFrequently: true });
    const mask = new Uint8Array(COLS * ROWS);
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
      maskRef.current = mask;
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
    let tick = 0;
    const draw = () => {
      if (document.hidden) return;
      tick++;
      ctx.fillStyle = '#100d18';
      ctx.fillRect(0, 0, canvas.width, canvas.height);
      const mask = maskRef.current;
      for (let y = 0; y < ROWS; y++) for (let x = 0; x < COLS; x++) {
        const index = y * COLS + x;
        const sparkle = ((index * 2654435761 + tick * 40503) >>> 0) % 997 < 4;
        ctx.fillStyle = mask[index] ? '#b8a0ff' : sparkle ? '#4a3a6b' : '#282033';
        ctx.fillRect(x * CELL + .5, y * CELL + .5, CELL - 1, CELL - 1);
      }
    };
    const compact = window.matchMedia('(max-width: 600px), (pointer: coarse)').matches;
    const timer = window.setInterval(draw, compact ? 250 : 90);
    draw();
    return () => window.clearInterval(timer);
  }, []);

  return <div className="pixel-board">
    <canvas ref={canvasRef} className="lyric-board" role="img" aria-label={`Lyric: ${text}`} />
  </div>;
}
