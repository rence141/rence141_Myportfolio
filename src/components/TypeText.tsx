import { useEffect, useState } from "react";

type TypeTextProps = {
  words: string[];
};

export function TypeText({ words }: TypeTextProps) {
  const [wordIndex, setWordIndex] = useState(0);
  const [charIndex, setCharIndex] = useState(0);
  const [deleting, setDeleting] = useState(false);

  useEffect(() => {
    const current = words[wordIndex];
    const doneTyping = !deleting && charIndex === current.length;
    const doneDeleting = deleting && charIndex === 0;
    const delay = doneTyping ? 1600 : doneDeleting ? 450 : deleting ? 45 : 90;

    const timer = window.setTimeout(() => {
      if (doneTyping) {
        setDeleting(true);
      } else if (doneDeleting) {
        setDeleting(false);
        setWordIndex((index) => (index + 1) % words.length);
      } else {
        setCharIndex((index) => index + (deleting ? -1 : 1));
      }
    }, delay);

    return () => window.clearTimeout(timer);
  }, [charIndex, deleting, wordIndex, words]);

  return <span>{words[wordIndex].slice(0, charIndex)}</span>;
}
