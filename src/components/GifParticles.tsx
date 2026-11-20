import { useEffect, useRef, useState } from 'react';
import { decompressFrames, parseGIF } from 'gifuct-js';

export function GifParticles({ src }: { src: string }) {
  const canvasRef = useRef<HTMLCanvasElement>(null);
  const [ready, setReady] = useState(false);
  useEffect(() => {
    let disposed = false, raf = 0, visible = true;
    const controller = new AbortController();
    const canvas = canvasRef.current;
    const ctx = canvas?.getContext('2d');
    if (!canvas || !ctx) return;
    const observer = new IntersectionObserver(entries => { visible = entries[0].isIntersecting; });
    observer.observe(canvas.parentElement || canvas);
    async function load() {
      try {
        const response = await fetch(src, { signal: controller.signal });
        if (!response.ok) throw Error('GIF unavailable');
        const parsed = parseGIF(await response.arrayBuffer());
        if (disposed) return;
        const frames = decompressFrames(parsed, true);
        if (!frames.length) throw Error('No GIF frames');
        const composite = document.createElement('canvas');
        composite.width = parsed.lsd.width; composite.height = parsed.lsd.height;
        const compositor = composite.getContext('2d', { willReadFrequently: true });
        const patch = document.createElement('canvas'); const patchCtx = patch.getContext('2d');
        const sample = document.createElement('canvas'); sample.width = 240; sample.height = 240;
        const sampler = sample.getContext('2d', { willReadFrequently: true });
        if (!compositor || !patchCtx || !sampler || !ctx || !canvas) return;
        const dpr = Math.min(devicePixelRatio || 1, 2); canvas.width = 280 * dpr; canvas.height = 280 * dpr; ctx.setTransform(dpr,0,0,dpr,0,0);
        let index = 0, last = 0;
        setReady(true);
        let previous: typeof frames[number] | undefined;
        let restore: ImageData | null = null;
        function render(now: number) {
          if (disposed || !ctx || !compositor || !patchCtx || !sampler) return;
          if (visible && !document.hidden && (!last || (now - last >= Math.max(30, previous?.delay ?? 60)))) {
            if (previous?.disposalType === 2) compositor.clearRect(previous.dims.left, previous.dims.top, previous.dims.width, previous.dims.height);
            if (previous?.disposalType === 3 && restore) compositor.putImageData(restore, 0, 0);
            const frame = frames[index];
            restore = frame.disposalType === 3 ? compositor.getImageData(0,0,composite.width,composite.height) : null;
            patch.width = frame.dims.width; patch.height = frame.dims.height;
            const data = patchCtx.createImageData(patch.width, patch.height); data.data.set(frame.patch); patchCtx.putImageData(data,0,0);
            compositor.drawImage(patch,frame.dims.left,frame.dims.top);
            sampler.clearRect(0,0,240,240);
            const scale = Math.min(240/composite.width,240/composite.height);
            sampler.drawImage(composite,(240-composite.width*scale)/2,(240-composite.height*scale)/2,composite.width*scale,composite.height*scale);
            const pixels = sampler.getImageData(0,0,240,240).data;
            ctx.clearRect(0,0,280,280);
            const palette = getComputedStyle(canvas!);
            const accent = palette.getPropertyValue('--particle-accent').trim() || '184,160,255';
            const highlight = palette.getPropertyValue('--particle-highlight').trim() || '238,237,246';
            for(let y=0;y<240;y+=3) for(let x=0;x<240;x+=3) {
              const p=(y*240+x)*4;
              if(pixels[p+3]<32) continue;
              const light=(pixels[p]*.3+pixels[p+1]*.59+pixels[p+2]*.11)/255;
              if(light<.08) continue;
              const brightness=.45+light*.55;
              ctx.fillStyle=light>.8 ? `rgba(${highlight},${brightness})` : `rgba(${accent},${brightness})`;
              ctx.fillRect(20 + x, 20 + y, 1.9, 1.9);
            }
            previous=frame; index=(index+1)%frames.length; last=now;
            setReady(true);
          }
          raf=requestAnimationFrame(render);
        }
        raf=requestAnimationFrame(render);
      } catch { if(!disposed) setReady(false); }
    }
    void load();
    return () => { disposed=true;controller.abort();cancelAnimationFrame(raf);observer.disconnect(); };
  }, [src]);
  return <figure className="about-gif"><div className="about-gif-stage"><img hidden={ready} src={src} alt="Animated illustration" /><canvas hidden={!ready} ref={canvasRef} role="img" aria-label="Animated illustration rendered with square purple particles" /></div></figure>;
}
