import { useEffect, useState } from 'react';

const glyphs: Record<string, string[]> = {
  T: ['11111', '00100', '00100', '00100', '00100', '00100', '00100'],
  H: ['10001', '10001', '10001', '11111', '10001', '10001', '10001'],
  E: ['11111', '10000', '10000', '11110', '10000', '10000', '11111'],
  R: ['11110', '10001', '10001', '11110', '10100', '10010', '10001'],
  N: ['10001', '11001', '11001', '10101', '10011', '10011', '10001'],
  C: ['01111', '10000', '10000', '10000', '10000', '10000', '01111'],
  P: ['11110', '10001', '10001', '11110', '10000', '10000', '10000'],
  O: ['01110', '10001', '10001', '10001', '10001', '10001', '01110'],
  F: ['11111', '10000', '10000', '11110', '10000', '10000', '10000'],
  L: ['10000', '10000', '10000', '10000', '10000', '10000', '11111'],
  I: ['11111', '00100', '00100', '00100', '00100', '00100', '11111'],
  W: ['10001', '10001', '10001', '10101', '10101', '10101', '01010'],
  M: ['10001', '11011', '10101', '10101', '10001', '10001', '10001'],
  U: ['10001', '10001', '10001', '10001', '10001', '10001', '01110'],
  S: ['01111', '10000', '10000', '01110', '00001', '00001', '11110'],
  D: ['11110', '10001', '10001', '10001', '10001', '10001', '11110'],
  B: ['11110', '10001', '10001', '11110', '10001', '10001', '11110'],
  A: ['01110', '10001', '10001', '11111', '10001', '10001', '10001'],
};

export function PixelTitle({ name }: { name: string }) {
  const [tick, setTick] = useState(0);
  const [reduced, setReduced] = useState(() => window.matchMedia('(prefers-reduced-motion: reduce)').matches);
  useEffect(() => {
    const media = window.matchMedia('(prefers-reduced-motion: reduce)');
    const update = () => setReduced(media.matches);
    media.addEventListener('change', update);
    return () => media.removeEventListener('change', update);
  }, []);
  useEffect(() => {
    if (reduced) return;
    const timer = window.setInterval(() => setTick(value => value + 1), 80);
    return () => window.clearInterval(timer);
  }, [reduced]);

  const messages = ['WELCOME USER', 'HELLO WORLD', `${name.toUpperCase()} PORTFOLIO`, 'I BUILD IDEAS'];
  const columns = 97;
  const rows = 13;
  const phase = tick % 75;
  const message = messages[Math.floor(tick / 75) % messages.length];
  // Scatter across the whole board, then settle individual cells into the message.
  const noise = (seed: number) => {
    let value = Math.imul(seed ^ 0x9e3779b9, 0x45d9f3b);
    value = Math.imul(value ^ (value >>> 16), 0x45d9f3b);
    return ((value ^ (value >>> 16)) >>> 0) / 4294967296;
  };
  const start = Math.floor((columns - (message.length * 6 - 1)) / 2);
  return <div className="pixel-board">
    <h1 aria-label={`The ${name} Portfolio — Welcome user. Hello world.`}>
      <svg viewBox={`0 0 ${columns * 10} ${rows * 10}`} aria-hidden="true" className="pixel-board-grid">
        {Array.from({ length: columns * rows }, (_, index) => {
          const x = index % columns;
          const y = Math.floor(index / columns);
          const localX = x - start;
          const letter = message[Math.floor(localX / 6)];
          const isLetter = localX >= 0 && y >= 3 && y < 10 && glyphs[letter]?.[y - 3]?.[localX % 6] === '1';
          const threshold = noise(index + 17);
          const sparkle = noise(index + Math.floor(tick / 2) * 1301) > .78;
          let lit = isLetter;
          if (!reduced) {
            if (phase < 7) lit = false;
            else if (phase < 17) lit = sparkle;
            else if (phase < 35) lit = threshold < (phase - 17) / 18 ? isLetter : sparkle;
            else if (phase >= 63) lit = threshold > (phase - 63) / 12 && (isLetter || sparkle);
          }
          return <rect key={index} x={x * 10 + 1} y={y * 10 + 1} width="8" height="8" className={lit ? 'pixel-board-cell lit' : 'pixel-board-cell'} />;
        })}
      </svg>
    </h1>
  </div>;
}
