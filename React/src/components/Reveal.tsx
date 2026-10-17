import { ReactNode } from 'react';
import { useInView } from '../hooks/useInView';

interface Props {
  children: ReactNode;
  delay?: number;
  y?: number;
  className?: string;
  as?: 'div' | 'section' | 'li' | 'article';
}

export default function Reveal({
  children,
  delay = 0,
  y = 24,
  className = '',
  as: Tag = 'div',
}: Props) {
  const { ref, inView } = useInView<HTMLDivElement>();

  return (
    <Tag
      ref={ref as never}
      className={className}
      style={{
        opacity: inView ? 1 : 0,
        transform: inView ? 'translateY(0)' : `translateY(${y}px)`,
        transition: `opacity 0.75s cubic-bezier(0.22,1,0.36,1) ${delay}ms, transform 0.75s cubic-bezier(0.22,1,0.36,1) ${delay}ms`,
        willChange: inView ? 'auto' : 'transform, opacity',
      }}
    >
      {children}
    </Tag>
  );
}