import { useEffect, useRef, useState } from 'react';

type Particle = { x: number; y: number; z: number; color: string; phase: number; spreadX: number; spreadY: number };
const size = 280;
export function ParticlePortrait({ src, alt, active, reducedMotion }: { src: string; alt: string; active: boolean; reducedMotion: boolean }) {
  const canvasRef = useRef<HTMLCanvasElement>(null);
  const pointer = useRef({ x: 0, y: 0, inside: false });
  const scatterTime = useRef(-10000);
  const [ready, setReady] = useState(false);
  const [lightTheme, setLightTheme] = useState(() => document.documentElement.dataset.theme === 'light');
  useEffect(() => {
    const observer = new MutationObserver(() => setLightTheme(document.documentElement.dataset.theme === 'light'));
    observer.observe(document.documentElement, { attributes: true, attributeFilter: ['data-theme'] });
    return () => observer.disconnect();
  }, []);
  const [paused, setPaused] = useState(false);
  const [enabledByUser, setEnabledByUser] = useState(false);
  const [failed, setFailed] = useState(false);
  const restartRef = useRef<() => void>(() => {});
  const staticMode = false; void reducedMotion; void enabledByUser;
  function scatter() {
    if (!active) return;
    setEnabledByUser(true);
    setPaused(false);
    scatterTime.current = performance.now();
    restartRef.current();
  }
  useEffect(() => {
    if (!active || staticMode) return;
    const canvas = canvasRef.current;
    const ctx = canvas?.getContext('2d');
    if (!canvas || !ctx) return;
    let disposed = false;
    let frame = 0;
    let observer: IntersectionObserver | undefined;
    let visible = true;
    let particles: Particle[] = [];
    let started = 0;
    let last = 0;
    const dpr = Math.min(window.devicePixelRatio || 1, 2);
    canvas.width = size * dpr;
    canvas.height = size * dpr;
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    function draw(now: number) {
      if (disposed || !ctx) return;
      if (!started) started = now;
      if (now - last > 30) {
        last = now;
        ctx.clearRect(0, 0, size, size);
        const age = paused ? 10 : (now - started) / 1000;
        const assembly = paused ? 0 : Math.pow(Math.max(0, 1 - age / 1.7), 3);
        const elapsed = (now - scatterTime.current) / 1000;
        const burst = paused || elapsed < 0 ? 0 : elapsed < .15 ? elapsed / .15 : elapsed < .65 ? 1 : Math.exp(-(elapsed - .65) * 2.6);
        const px = paused || !pointer.current.inside ? 0 : pointer.current.x;
        const py = paused || !pointer.current.inside ? 0 : pointer.current.y;
        const ry = px * .18;
        const rx = -py * .14;
        const cosY = Math.cos(ry), sinY = Math.sin(ry), cosX = Math.cos(rx), sinX = Math.sin(rx);
        for (const p of particles) {
          const x = p.x * cosY + p.z * sinY;
          const z = -p.x * sinY + p.z * cosY;
          const y = p.y * cosX - z * sinX;
          const depth = p.y * sinX + z * cosX;
          const perspective = 500 / (500 - depth);
          let sx = size / 2 + x * perspective;
          let sy = size / 2 + y * perspective;
          if (pointer.current.inside && !paused) {
            const dx = sx - (size / 2 + px * size / 2);
            const dy = sy - (size / 2 + py * size / 2);
            const distance = Math.hypot(dx, dy);
            const force = Math.max(0, 1 - distance / 36) * 9;
            sx += dx / (distance || 1) * force;
            sy += dy / (distance || 1) * force;
          }
          const spread = assembly + burst * .7;
          sx += p.spreadX * spread;
          sy += p.spreadY * spread;
          if (!paused) sy += Math.sin(age * .8 + p.phase) * .65;
          ctx.fillStyle = p.color;
          ctx.globalAlpha = .94;
          const radius = 1.05 * perspective;
          ctx.fillRect(sx - radius, sy - radius, radius * 2, radius * 2);
        }
        ctx.globalAlpha = 1;
      }
      if (visible && !document.hidden && !paused) frame = requestAnimationFrame(draw);
    }
    const restart = () => {
      cancelAnimationFrame(frame);
      if (particles.length && visible && !document.hidden) frame = requestAnimationFrame(draw);
    };
    restartRef.current = restart;
    const img = new Image();
    img.onerror = () => { if (!disposed) { setReady(false); setFailed(true); } };
    img.onload = () => {
      if (disposed) return;
      try {
        const sample = document.createElement('canvas'); sample.width = size; sample.height = size;
        const sampleCtx = sample.getContext('2d', { willReadFrequently: true });
        if (!sampleCtx) return;
        const scale = Math.max(size / img.width, size / img.height);
        sampleCtx.drawImage(img, (size - img.width * scale) / 2, (size - img.height * scale) / 2, img.width * scale, img.height * scale);
        const pixels = sampleCtx.getImageData(0, 0, size, size).data;
        for (let y = 12; y < size - 12; y += 2.8) for (let x = 12; x < size - 12; x += 2.8) {
          const nx = x - size / 2, ny = y - size / 2;
          const index = (Math.floor(y) * size + Math.floor(x)) * 4;
          const r = pixels[index], g = pixels[index + 1], b = pixels[index + 2];
          const light = (r * .3 + g * .59 + b * .11) / 255;
          const u = x / size, v = y / size;
          const warm = r - b;
          const inFace = ((u - .5) / .25) ** 2 + ((v - .38) / .23) ** 2 < 1;
          const inNeck = u > .34 && u < .58 && v > .55 && v < .72;
          const isSkin = light > .3 && ((inFace && warm > 60) || (inNeck && warm > 50));
          let tone: number[];
          if (light < .27) { const s = Math.round(8 + light * 60); tone = [s, s - 2, s + 8]; }
          else if (isSkin) { const s = Math.round(170 + 85 * Math.min(1, light * 1.1)); tone = [s, s, s]; }
          else { const s = .72 + .28 * light; tone = [Math.round(122 * s), Math.round(84 * s), Math.round(210 * s)]; }
          if (lightTheme && light >= .27) {
            tone = isSkin ? [72, 36, 108] : [Math.round(128 * (.8 + .2 * light)), Math.round(88 * (.8 + .2 * light)), Math.round(178 * (.8 + .2 * light))];
          }
          particles.push({ x: nx, y: ny, z: (1 - Math.min(1, Math.hypot(nx / 120, ny / 130))) * 38 + light * 8, color: `rgb(${tone[0]},${tone[1]},${tone[2]})`, phase: Math.random() * 6.28, spreadX: (Math.random() - .5) * 450, spreadY: (Math.random() - .5) * 450 });
        }
        setFailed(false);
        setReady(true);
        observer = new IntersectionObserver(entries => { visible = entries[0].isIntersecting; restart(); });
        observer.observe(canvas);
        document.addEventListener('visibilitychange', restart);
        restart();
      } catch { setReady(false); setFailed(true); }
    };
    img.src = src;
    return () => { disposed = true; restartRef.current = () => {}; cancelAnimationFrame(frame); observer?.disconnect(); document.removeEventListener('visibilitychange', restart); };
  }, [src, active, staticMode, paused, lightTheme]);
  const animated = ready && !staticMode;
  void scatter; void animated;
  return <div className="particle-portrait">
    <div className="particle-stage" style={{ cursor: 'default' }}>
      <img className={failed ? 'particle-fallback' : 'particle-fallback is-hidden'} src={src} alt={alt} />
      <canvas ref={canvasRef} className={failed ? 'particle-canvas is-hidden' : 'particle-canvas'} role="img" aria-label={`${alt}, rendered as a portrait made of particles`} />
    </div>
  </div>;
}
