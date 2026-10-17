import { useEffect, useRef } from 'react';

export default function AmbientBackground() {
  const spotRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    if (window.matchMedia('(pointer: coarse)').matches) return;

    let raf = 0;
    const onMove = (e: MouseEvent) => {
      cancelAnimationFrame(raf);
      raf = requestAnimationFrame(() => {
        if (!spotRef.current) return;
        spotRef.current.style.transform = `translate3d(${e.clientX - 300}px, ${e.clientY - 300}px, 0)`;
      });
    };
    window.addEventListener('mousemove', onMove, { passive: true });
    return () => {
      window.removeEventListener('mousemove', onMove);
      cancelAnimationFrame(raf);
    };
  }, []);

  return (
    <div aria-hidden className="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
      <div className="absolute inset-0 bg-bg" />

      {/* Aurora — only blue/cyan */}
      <div
        className="absolute -top-[30%] -left-[15%] w-[900px] h-[900px] rounded-full opacity-40 blur-[140px] animate-float-slow"
        style={{ background: 'radial-gradient(circle, #5B8CFF 0%, transparent 60%)' }}
      />
      <div
        className="absolute top-1/3 -right-[20%] w-[820px] h-[820px] rounded-full opacity-30 blur-[150px]"
        style={{
          background: 'radial-gradient(circle, #2E6BFF 0%, transparent 60%)',
          animation: 'floatSlow 16s ease-in-out infinite reverse',
        }}
      />
      <div
        className="absolute -bottom-[25%] left-1/4 w-[720px] h-[720px] rounded-full opacity-20 blur-[150px]"
        style={{
          background: 'radial-gradient(circle, #22D3EE 0%, transparent 60%)',
          animation: 'floatSlow 20s ease-in-out infinite',
        }}
      />

      {/* Mouse-follow blue ambient */}
      <div
        ref={spotRef}
        className="absolute top-0 left-0 w-[600px] h-[600px] rounded-full opacity-[0.08] blur-[120px]"
        style={{
          background: 'radial-gradient(circle, #5B8CFF 0%, transparent 60%)',
          willChange: 'transform',
        }}
      />

      <div className="absolute inset-0 grid-layer opacity-60 mask-radial" />
      <div className="absolute inset-0 noise-layer" />

      <div
        className="absolute inset-0"
        style={{
          background:
            'radial-gradient(ellipse at center, transparent 35%, rgba(5,6,10,0.75) 100%)',
        }}
      />
    </div>
  );
}