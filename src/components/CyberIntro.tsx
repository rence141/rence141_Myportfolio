import { useEffect, useRef } from 'react';

export function CyberIntro({ onDone }: { onDone: () => void }) {
  const canvasRef = useRef<HTMLCanvasElement>(null);
  const doneRef = useRef(onDone);
  doneRef.current = onDone;
  useEffect(() => {
    if (matchMedia('(prefers-reduced-motion: reduce)').matches) { doneRef.current(); return; }
    const canvas = canvasRef.current;
    const context = canvas?.getContext('2d');
    if (!canvas || !context) { doneRef.current(); return; }
    let raf = 0, disposed = false;
    let width = 0, height = 0;
    const artwork = document.createElement('canvas');
    const art = artwork.getContext('2d');
    if (!art) { doneRef.current(); return; }
    function resize() {
      if (!canvas || !context || !art) return;
      const dpr = Math.min(devicePixelRatio || 1, 1.5);
      width = innerWidth; height = innerHeight;
      canvas.width = Math.round(width * dpr); canvas.height = Math.round(height * dpr);
      artwork.width = canvas.width; artwork.height = canvas.height;
      art.setTransform(dpr, 0, 0, dpr, 0, 0);
      const colors = getComputedStyle(document.documentElement);
      const bg = colors.getPropertyValue('--site-bg').trim() || '#111019';
      const accent = colors.getPropertyValue('--site-accent').trim() || '#b8a0ff';
      const text = colors.getPropertyValue('--site-text').trim() || '#eeedf6';
      const muted = colors.getPropertyValue('--site-muted').trim() || '#b1a8bf';
      art.fillStyle = bg; art.fillRect(0, 0, width, height);
      art.strokeStyle = accent + '12'; art.lineWidth = 1;
      for(let x=0;x<width;x+=32) { art.beginPath();art.moveTo(x,0);art.lineTo(x,height);art.stroke(); }
      for(let y=0;y<height;y+=32) { art.beginPath();art.moveTo(0,y);art.lineTo(width,y);art.stroke(); }
      art.textAlign = 'center';art.textBaseline = 'middle';
      art.font = '12px "Courier New", monospace'; art.fillStyle = accent;
      art.fillText('RENCE / PORTFOLIO', width/2,height/2-100);
      const fontSize = Math.max(36,Math.min(112,width*.105));
      art.font = `${fontSize}px "VT323", monospace`;art.fillStyle = text;
      art.fillText('TURNING IDEAS',width/2,height/2-28,width-44);
      art.fillStyle = accent;art.fillText('INTO SYSTEMS_',width/2,height/2+fontSize*.65,width-44);
      art.font = '11px "Courier New", monospace';art.fillStyle = muted;
      art.fillText('LORENZE PREPOTENTE / FULL-STACK DEVELOPER',width/2,height/2+fontSize*.65+64,width-48);
      art.fillStyle='#11101918';for(let y=0;y<height;y+=4)art.fillRect(0,y,width,1);
    }
    resize();
    window.addEventListener('resize',resize);
    const themeObserver = new MutationObserver(resize);
    themeObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['data-theme'] });
    void document.fonts.load('80px "VT323"').then(() => { if(!disposed) resize(); });
    const started = performance.now();
    const draw = (now: number) => {
      if(disposed) return;
      const elapsed = now-started;
      context.clearRect(0,0,canvas.width,canvas.height);
      const entrance = Math.max(0,Math.min(1,elapsed/650));
      const progress = Math.max(0,Math.min(1,(elapsed-2100)/950));
      if(entrance===1 && progress===0) context.drawImage(artwork,0,0);
      else {
        const cols = Math.ceil(width/32), rows = Math.ceil(height/32);
        const tileW=canvas.width/cols,tileH=canvas.height/rows;
        for(let row=0;row<rows;row++) for(let col=0;col<cols;col++) {
          const hash = ((col*374761393 ^ row*668265263)>>>0)%1000/1000;
          const threshold = .3*(col/cols)+.7*hash;
          if(entrance<1 && entrance<=threshold)continue;
          if(progress>threshold)continue;
          const x=Math.floor(col*tileW),y=Math.floor(row*tileH);
          const w=Math.ceil(tileW),h=Math.ceil(tileH);
          context.drawImage(artwork,x,y,w,h,x,y,w,h);
        }
      }
      if(progress>=1) { doneRef.current(); return; }
      raf=requestAnimationFrame(draw);
    };
    raf=requestAnimationFrame(draw);
    return () => { disposed=true;cancelAnimationFrame(raf);window.removeEventListener('resize',resize);themeObserver.disconnect(); };
  }, []);
  return <div className="cyber-intro" role="region" aria-label="Rence portfolio introduction">
    <canvas ref={canvasRef} aria-hidden="true" />
    <button className="intro-skip" type="button" onClick={() => doneRef.current()}>Skip intro</button>
    <p className="cyber-intro-label">Turning ideas into systems.</p>
  </div>;
}
