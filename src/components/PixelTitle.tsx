import { useEffect, useState } from 'react';

const g = (...rows: string[]) => rows;
const glyphs: Record<string, string[]> = {
  A: g('01110', '10001', '10001', '11111', '10001', '10001', '10001'),
  B: g('11110', '10001', '10001', '11110', '10001', '10001', '11110'),
  C: g('01111', '10000', '10000', '10000', '10000', '10000', '01111'),
  D: g('11110', '10001', '10001', '10001', '10001', '10001', '11110'),
  E: g('11111', '10000', '10000', '11110', '10000', '10000', '11111'),
  F: g('11111', '10000', '10000', '11110', '10000', '10000', '10000'),
  G: g('01111', '10000', '10000', '10011', '10001', '10001', '01111'),
  H: g('10001', '10001', '10001', '11111', '10001', '10001', '10001'),
  I: g('11111', '00100', '00100', '00100', '00100', '00100', '11111'),
  J: g('00111', '00010', '00010', '00010', '00010', '10010', '01100'),
  K: g('10001', '10010', '10100', '11000', '10100', '10010', '10001'),
  L: g('10000', '10000', '10000', '10000', '10000', '10000', '11111'),
  M: g('10001', '11011', '10101', '10101', '10001', '10001', '10001'),
  N: g('10001', '11001', '11001', '10101', '10011', '10011', '10001'),
  O: g('01110', '10001', '10001', '10001', '10001', '10001', '01110'),
  P: g('11110', '10001', '10001', '11110', '10000', '10000', '10000'),
  Q: g('01110', '10001', '10001', '10001', '10101', '10010', '01101'),
  R: g('11110', '10001', '10001', '11110', '10100', '10010', '10001'),
  S: g('01111', '10000', '10000', '01110', '00001', '00001', '11110'),
  T: g('11111', '00100', '00100', '00100', '00100', '00100', '00100'),
  U: g('10001', '10001', '10001', '10001', '10001', '10001', '01110'),
  V: g('10001', '10001', '10001', '10001', '10001', '01010', '00100'),
  W: g('10001', '10001', '10001', '10101', '10101', '10101', '01010'),
  X: g('10001', '10001', '01010', '00100', '01010', '10001', '10001'),
  Y: g('10001', '10001', '01010', '00100', '00100', '00100', '00100'),
  Z: g('11111', '00001', '00010', '00100', '01000', '10000', '11111'),
  '0': g('01110', '10001', '10011', '10101', '11001', '10001', '01110'),
  '1': g('00100', '01100', '00100', '00100', '00100', '00100', '01110'),
  '2': g('01110', '10001', '00001', '00010', '00100', '01000', '11111'),
  '3': g('11110', '00001', '00001', '01110', '00001', '00001', '11110'),
  '4': g('00010', '00110', '01010', '10010', '11111', '00010', '00010'),
  '5': g('11111', '10000', '11110', '00001', '00001', '10001', '01110'),
  '6': g('01110', '10000', '10000', '11110', '10001', '10001', '01110'),
  '7': g('11111', '00001', '00010', '00100', '01000', '01000', '01000'),
  '8': g('01110', '10001', '10001', '01110', '10001', '10001', '01110'),
  '9': g('01110', '10001', '10001', '01111', '00001', '00001', '01110'),
  "'": g('00100', '00100', '01000', '00000', '00000', '00000', '00000'),
  ',': g('00000', '00000', '00000', '00000', '00110', '00100', '01000'),
  '.': g('00000', '00000', '00000', '00000', '00000', '01100', '01100'),
  '!': g('00100', '00100', '00100', '00100', '00100', '00000', '00100'),
  '?': g('01110', '10001', '00001', '00010', '00100', '00000', '00100'),
  '-': g('00000', '00000', '00000', '11111', '00000', '00000', '00000'),
};

export const BOARD_MAX_CHARS = 16;

// Split a lyric line into chunks that fit on the board.
export function chunkLyric(text: string): string[] {
  const words = text.toUpperCase().trim().split(/\s+/).filter(Boolean);
  const chunks: string[] = [];
  let current = '';
  for (let word of words) {
    while (word.length > BOARD_MAX_CHARS) {
      if (current) { chunks.push(current); current = ''; }
      chunks.push(word.slice(0, BOARD_MAX_CHARS));
      word = word.slice(BOARD_MAX_CHARS);
    }
    if (!current) current = word;
    else if ((current + ' ' + word).length <= BOARD_MAX_CHARS) current += ' ' + word;
    else { chunks.push(current); current = word; }
  }
  if (current) chunks.push(current);
  return chunks;
}

export function PixelTitle({ name, lyric }: { name: string; lyric?: string }) {
  const [tick, setTick] = useState(0);
  useEffect(() => {
    const timer = window.setInterval(() => setTick(value => value + 1), 80);
    return () => window.clearInterval(timer);
  }, []);

  const singing = lyric !== undefined;
  const messages = ['WELCOME USER', 'HELLO WORLD', `${name.toUpperCase()} PORTFOLIO`, 'I BUILD IDEAS'];
  const columns = 97;
  const rows = 13;
  const phase = tick % 75;
  const message = singing ? lyric : messages[Math.floor(tick / 75) % messages.length];
  // Scatter across the whole board, then settle individual cells into the message.
  const noise = (seed: number) => {
    let value = Math.imul(seed ^ 0x9e3779b9, 0x45d9f3b);
    value = Math.imul(value ^ (value >>> 16), 0x45d9f3b);
    return ((value ^ (value >>> 16)) >>> 0) / 4294967296;
  };
  const start = Math.floor((columns - (message.length * 6 - 1)) / 2);
  return <div className="pixel-board">
    <h1 aria-label={`The ${name} Portfolio - Welcome user. Hello world.`}>
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
          if (singing) {
            lit = isLetter || noise(index + tick * 977) > .985;
          } else if (phase < 7) lit = false;
          else if (phase < 17) lit = sparkle;
          else if (phase < 35) lit = threshold < (phase - 17) / 18 ? isLetter : sparkle;
          else if (phase >= 63) lit = threshold > (phase - 63) / 12 && (isLetter || sparkle);
          return <rect key={index} x={x * 10 + 1} y={y * 10 + 1} width="8" height="8" className={lit ? 'pixel-board-cell lit' : 'pixel-board-cell'} />;
        })}
      </svg>
    </h1>
  </div>;
}
