import { useEffect, useRef } from 'react';

interface Props {
  src: string;
  poster?: string;
  className?: string;
}

export default function LazyVideo({ src, poster, className = '' }: Props) {
  const ref = useRef<HTMLVideoElement>(null);

  useEffect(() => {
    const v = ref.current;
    if (!v) return;

    if (typeof IntersectionObserver === 'undefined') {
      v.play().catch(() => {});
      return;
    }

    const obs = new IntersectionObserver(
      ([entry]) => {
        if (!v) return;
        if (entry.isIntersecting) {
          // Only when in view
          if (v.preload === 'none') v.preload = 'metadata';
          v.play().catch(() => {});
        } else {
          v.pause();
        }
      },
      { threshold: 0.15 }
    );

    obs.observe(v);
    return () => obs.disconnect();
  }, []);

  return (
    <video
      ref={ref}
      muted
      loop
      playsInline
      preload="none"
      poster={poster}
      className={className}
    >
      <source src={src} type="video/mp4" />
    </video>
  );
}