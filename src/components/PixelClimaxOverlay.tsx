import { useEffect, useRef, type RefObject } from 'react';
import type { AudioEnergy } from './audioClimax';

type PixelEmber = {
  x: number;
  y: number;
  vx: number;
  vy: number;
  size: number;
  life: number;
  maxLife: number;
  color: string;
};

// Restrained lavender-only palette matching the portfolio's pixel-art theme.
const PALETTE = ['#b8a0ff', '#b8a0ff', '#cdbbff', '#8b6fd6', '#eeedf6'];

const snap = (value: number, step: number) => Math.round(value / step) * step;

// Player-scoped pixel ember field: stays quiet during verses and gently drifts
// crisp 3-4px lavender pixels off the player edges when the track hits climax.
export function PixelClimaxOverlay({
  active,
  energyRef,
  anchorRef,
  onTick,
}: {
  active: boolean;
  energyRef: RefObject<AudioEnergy>;
  anchorRef: RefObject<HTMLDivElement | null>;
  onTick?: (now: number) => void;
}) {
  const canvasRef = useRef<HTMLCanvasElement>(null);
  const onTickRef = useRef(onTick);
  onTickRef.current = onTick;

  useEffect(() => {
    if (!active) return;
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const canvas = canvasRef.current;
    const ctx = canvas?.getContext('2d');
    if (!canvas || !ctx) return;

    let width = 0;
    let height = 0;
    let compact = false;
    let bleed = 20;

    const resize = () => {
      const anchor = anchorRef.current;
      if (!anchor) return;
      const rect = anchor.getBoundingClientRect();
      compact = window.matchMedia('(max-width: 600px), (pointer: coarse)').matches;
      bleed = compact ? 12 : 20;
      width = Math.max(1, Math.round(rect.width + bleed * 2));
      height = Math.max(1, Math.round(rect.height + bleed * 2));
      if (canvas.width !== width || canvas.height !== height) {
        canvas.width = width;
        canvas.height = height;
      }
    };
    resize();

    const observer = typeof ResizeObserver !== 'undefined' && anchorRef.current
      ? new ResizeObserver(resize)
      : null;
    if (observer && anchorRef.current) observer.observe(anchorRef.current);
    window.addEventListener('resize', resize);

    const embers: PixelEmber[] = [];
    let lastTime = performance.now();
    let spawnCarry = 0;
    let raf = 0;

    const spawnEmber = (climax: number) => {
      const maxEmbers = compact ? 16 : reducedMotion ? 18 : 30;
      if (embers.length >= maxEmbers || width <= bleed * 2 || height <= bleed * 2) return;

      const innerW = width - bleed * 2;
      const innerH = height - bleed * 2;
      const side = Math.random();
      let x: number;
      let y: number;
      let vx: number;
      let vy: number;

      if (side < 0.45) {
        // Gentle sparks rising from the top edge of the player.
        x = bleed + Math.random() * innerW;
        y = bleed + 2;
        vx = (Math.random() - 0.5) * 14;
        vy = -(16 + Math.random() * (22 + climax * 18));
      } else if (side < 0.85) {
        // Delicate pixels drifting softly off the left and right borders.
        const left = Math.random() < 0.5;
        x = left ? bleed + 1 : width - bleed - 1;
        y = bleed + Math.random() * innerH;
        vx = (left ? -1 : 1) * (10 + Math.random() * (16 + climax * 12));
        vy = -(12 + Math.random() * 20);
      } else {
        // Occasional sparks along the bottom border.
        x = bleed + Math.random() * innerW;
        y = height - bleed - 1;
        vx = (Math.random() - 0.5) * 16;
        vy = 8 + Math.random() * 14;
      }

      const maxLife = 0.75 + Math.random() * 0.75;
      embers.push({
        x,
        y,
        vx,
        vy,
        size: Math.random() < 0.25 ? 4 : 3,
        life: maxLife,
        maxLife,
        color: PALETTE[Math.floor(Math.random() * PALETTE.length)],
      });
    };

    const draw = (now: number) => {
      raf = requestAnimationFrame(draw);
      if (document.hidden) {
        lastTime = now;
        return;
      }

      const dt = Math.min(0.05, Math.max(0.001, (now - lastTime) / 1000));
      lastTime = now;

      onTickRef.current?.(now);
      const { climax, beat } = energyRef.current;

      const anchor = anchorRef.current;
      if (anchor) {
        anchor.style.setProperty('--climax', climax.toFixed(3));
        anchor.style.setProperty('--beat', (reducedMotion ? 0 : beat).toFixed(3));
      }

      ctx.clearRect(0, 0, width, height);

      // Only spawn pixel embers once the track genuinely reaches climax.
      if (climax > 0.28) {
        const intensity = (climax - 0.28) / 0.72;
        const rate = (compact ? 7 : 15) * intensity + (!reducedMotion ? beat * intensity * 8 : 0);
        spawnCarry += rate * dt;
        const count = Math.min(3, Math.floor(spawnCarry));
        spawnCarry -= count;
        for (let i = 0; i < count; i++) spawnEmber(climax);
      }

      for (let i = embers.length - 1; i >= 0; i--) {
        const p = embers[i];
        p.life -= dt;
        if (p.life <= 0 || p.x < 0 || p.x > width || p.y < 0 || p.y > height) {
          embers.splice(i, 1);
          continue;
        }
        p.x += p.vx * dt;
        p.y += p.vy * dt;
        p.vx *= 0.97;

        const progress = p.life / p.maxLife;
        const fade = Math.min(1, progress * 1.5) * Math.min(1, (1 - progress) * 5);
        ctx.globalAlpha = fade * (0.4 + climax * 0.45);
        ctx.fillStyle = p.color;
        ctx.fillRect(snap(p.x, 2), snap(p.y, 2), p.size, p.size);
      }
      ctx.globalAlpha = 1;
    };

    raf = requestAnimationFrame(draw);
    return () => {
      cancelAnimationFrame(raf);
      observer?.disconnect();
      window.removeEventListener('resize', resize);
      if (anchorRef.current) {
        anchorRef.current.style.removeProperty('--climax');
        anchorRef.current.style.removeProperty('--beat');
      }
    };
  }, [active, energyRef, anchorRef]);

  if (!active) return null;
  return <canvas ref={canvasRef} className="climax-pixel-overlay" aria-hidden="true" />;
}
