import { useState } from 'react';
import type { Tech } from '../types';

export default function TechItem({ tech }: { tech: Tech }) {
  const [imgError, setImgError] = useState(false);

  return (
    <div
      className="glass-soft glass-hover rounded-2xl p-4 flex items-center gap-3.5 group"
      title={tech.name}
    >
      <div className="relative shrink-0 h-10 w-10 rounded-xl border border-white/10 bg-white/[0.03] grid place-items-center overflow-hidden">
        {tech.image && !imgError ? (
          <img
            src={tech.image}
            alt={tech.name}
            loading="lazy"
            onError={() => setImgError(true)}
            className="h-6 w-6 object-contain transition-transform duration-300 group-hover:scale-110"
          />
        ) : (
          <span className="font-mono text-[10px] font-semibold text-primary">
            {tech.name.slice(0, 2).toUpperCase()}
          </span>
        )}
      </div>
      <div className="min-w-0">
        <div className="text-sm font-semibold text-ink truncate">{tech.name}</div>
        {tech.sub && (
          <div className="font-mono text-[10px] uppercase tracking-wider text-ink-muted">
            {tech.sub}
          </div>
        )}
      </div>
    </div>
  );
}