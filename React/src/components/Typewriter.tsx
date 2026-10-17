import { useEffect, useState } from 'react';

interface Props {
  skills: readonly string[];
  prefix?: string;
}

export default function Typewriter({ skills, prefix = 'Developer' }: Props) {
  const [index, setIndex] = useState(0);
  const [text, setText] = useState('');
  const [phase, setPhase] = useState<'typing' | 'deleting'>('typing');

  useEffect(() => {
    const current = skills[index] ?? '';
    let t: number | undefined;

    if (phase === 'typing') {
      if (text.length < current.length) {
        t = window.setTimeout(() => setText(current.slice(0, text.length + 1)), 75);
      } else {
        t = window.setTimeout(() => setPhase('deleting'), 1600);
      }
    } else {
      if (text.length > 0) {
        t = window.setTimeout(() => setText(current.slice(0, text.length - 1)), 35);
      } else {
        setIndex((i) => (i + 1) % skills.length);
        setPhase('typing');
      }
    }
    return () => {
      if (t) window.clearTimeout(t);
    };
  }, [text, phase, index, skills]);

  return (
    <span className="font-mono text-lg sm:text-xl md:text-2xl font-medium tracking-tight">
      <span className="text-ink-soft">{prefix} </span>
      <span className="text-gradient-accent font-bold">{text}</span>
      <span
        aria-hidden
        className="inline-block w-[3px] h-[1.05em] bg-primary align-[-3px] ml-1 animate-blink rounded-full"
      />
    </span>
  );
}