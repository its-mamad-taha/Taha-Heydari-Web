import { ArrowUpRight, Crown } from 'lucide-react';
import type { Project } from '../types';
import GlassCard from './GlassCard';
import LazyVideo from './LazyVideo';

function Preview({ preview }: { preview: Project['preview'] }) {
  if (!preview) return null;

  if (preview.type === 'video') {
    return (
      <LazyVideo
        src={preview.src}
        className="absolute inset-0 h-full w-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500"
      />
    );
  }

  if (preview.type === 'iframe') {
    return (
      <iframe
        src={preview.src}
        title={preview.title}
        loading="lazy"
        className="absolute inset-0 h-full w-full border-0"
        style={{ background: '#05060A' }}
      />
    );
  }

  if (preview.type === 'image') {
    return (
      <img
        src={preview.src}
        alt=""
        loading="lazy"
        className="absolute inset-0 h-full w-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-500"
      />
    );
  }

  return (
    <div className="absolute inset-0 grid place-items-center bg-gradient-to-br from-primary/10 via-bg to-accent/5">
      <div className="text-center">
        <div className="mx-auto grid h-20 w-20 place-items-center rounded-3xl border border-primary/30 bg-primary/[0.08] text-3xl font-bold text-gradient-accent">
          {preview.label}
        </div>
        {preview.hint && (
          <div className="mt-3 font-mono text-[11px] uppercase tracking-widest text-ink-muted">
            {preview.hint}
          </div>
        )}
      </div>
    </div>
  );
}

interface Props {
  project: Project;
  size?: 'default' | 'wide';
}

export default function ProjectCard({ project, size = 'default' }: Props) {
  
  const hasLink = Boolean(project.link);
  const aspect = size === 'wide' ? 'aspect-[16/10]' : 'aspect-[16/11]';

  return (
    <GlassCard rounded="rounded-3xl" className="overflow-hidden group flex flex-col h-full">
      <div className={`relative ${aspect} overflow-hidden bg-bg-soft`}>
        <Preview preview={project.preview} />
        <div className="pointer-events-none absolute inset-0 bg-gradient-to-t from-bg/90 via-bg/10 to-transparent" />

        {project.byWolf && (
          <div className="absolute top-4 left-4 flex items-center gap-1.5 px-3 py-1.5 rounded-full glass-soft border-primary/30">
            <Crown size={12} className="text-primary" />
            <span className="font-mono text-[10px] uppercase tracking-wider text-primary">
              Wolf Ecosystem
            </span>
          </div>
        )}

        {project.status && !project.byWolf && (
          <div className="absolute top-4 left-4 flex items-center gap-1.5 px-3 py-1.5 rounded-full glass-soft border-white/10">
            <span className="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_6px] shadow-emerald-400" />
            <span className="font-mono text-[10px] text-emerald-200 uppercase tracking-wider">
              {project.status}
            </span>
          </div>
        )}
      </div>

      <div className="p-6 sm:p-7 lg:p-8 flex-1 flex flex-col">
        <div className="flex items-start justify-between gap-4">
          <div className="min-w-0">
            <h3 className="text-xl sm:text-2xl font-bold text-ink leading-tight">
              {project.title}
            </h3>
            <p className="mt-1 font-mono text-[11px] sm:text-xs text-primary uppercase tracking-wider">
              {project.tagline}
            </p>
          </div>
          {hasLink && (
            <span className="grid h-10 w-10 shrink-0 place-items-center rounded-full border border-white/10 bg-white/[0.04] text-ink-soft group-hover:text-primary group-hover:border-primary/40 transition-colors">
              <ArrowUpRight size={18} />
            </span>
          )}
        </div>

        {project.description && (
          <p className="mt-4 text-sm sm:text-[15px] leading-relaxed text-ink-soft flex-1">
            {project.description}
          </p>
        )}

        {project.tech && project.tech.length > 0 && (
          <div className="mt-5 flex flex-wrap gap-2">
            {project.tech.map((t) => (
              <span
                key={t}
                className="rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 font-mono text-[10px] uppercase tracking-wider text-ink-soft"
              >
                {t}
              </span>
            ))}
          </div>
        )}

        {hasLink && (
          <a
            href={project.link}
            target="_blank"
            rel="noopener noreferrer"
            className="mt-6 inline-flex items-center gap-2 text-sm font-medium text-primary hover:text-ink transition-colors"
          >
            <ArrowUpRight size={15} />
            Visit Project
          </a>
        )}
      </div>
    </GlassCard>
  );
}