import { ArrowRight, Crown, Eye, Play } from 'lucide-react';
import { profile } from '../data/profile';
import GlassCard from '../components/GlassCard';
import Typewriter from '../components/Typewriter';

function HeroHUD() {
  return (
    <GlassCard className="p-6 sm:p-8 w-full max-w-md mx-auto">
      <div className="flex items-center justify-between mb-5">
        <span className="label-mono">Currently Building</span>
        <span className="flex items-center gap-1.5 font-mono text-[10px] text-emerald-300">
          <span className="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px] shadow-emerald-400" />
          ACTIVE
        </span>
      </div>

      <div className="flex items-center gap-3 mb-1">
        <img
          src={profile.wolfLogo}
          alt="Wolf Client"
          className="h-10 w-10 object-contain"
          onError={(e) => (e.currentTarget.style.display = 'none')}
        />
        <h3 className="text-xl font-bold text-ink">Wolf Client</h3>
      </div>
      <p className="text-sm text-ink-soft">A Minecraft Client project</p>

      <div className="my-6 divider-glow" />

      <div className="space-y-3 text-sm">
        <Row label="Platform" value="Minecraft 1.8.9" />
        <Row label="Stack" value="Java · Rust · LWJGL" />
        <Row label="Focus" value="Rendering · Systems" />
      </div>

      <div className="mt-6 pt-5 border-t border-white/[0.06]">
        <div className="label-mono mb-2">Status</div>
        <div className="flex items-center gap-2 text-sm text-ink">
          <span className="h-2 w-2 rounded-full bg-accent shadow-[0_0_10px] shadow-accent" />
          Active Development
        </div>
      </div>
    </GlassCard>
  );
}

function Row({ label, value }: { label: string; value: string }) {
  return (
    <div className="flex items-center justify-between gap-4">
      <span className="font-mono text-[10px] uppercase tracking-wider text-ink-muted">
        {label}
      </span>
      <span className="text-ink font-medium text-right">{value}</span>
    </div>
  );
}

export default function Hero() {
  const scrollTo = (id: string) => {
    const el = document.getElementById(id);
    if (el) window.scrollTo({ top: el.offsetTop - 90, behavior: 'smooth' });
  };

  return (
    <section
      id="home"
      className="relative min-h-[100svh] flex items-center pt-28 md:pt-32 pb-16 md:pb-20"
    >
      <div className="mx-auto w-full max-w-7xl px-5 sm:px-6">
        <div className="grid lg:grid-cols-[1.25fr_1fr] gap-10 lg:gap-16 items-center">
          {/* LEFT — Centered on mobile, left on desktop */}
          <div className="text-center lg:text-left flex flex-col items-center lg:items-start">
            {/* Founder badge */}
            <div className="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full glass-soft border-primary/25 mb-5">
              <Crown size={13} className="text-primary" />
              <span className="text-xs font-semibold text-ink tracking-wide">
                Founder & Owner of Wolf Client
              </span>
            </div>

            {/* Available pill */}
            <div className="mb-6">
              <span className="inline-flex items-center gap-2 px-3 py-1.5 rounded-full glass-soft">
                <span className="relative flex h-2 w-2">
                  <span className="absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-60 animate-ping" />
                  <span className="relative inline-flex h-2 w-2 rounded-full bg-emerald-400" />
                </span>
                <span className="text-xs font-medium text-ink-soft tracking-wide">
                  Available for Projects
                </span>
              </span>
            </div>

            {/* Avatar + Name — stack on mobile, row on desktop */}
            <div className="flex flex-col sm:flex-row items-center gap-4 mb-6 w-full sm:w-auto">
              <div className="relative shrink-0">
                <div className="absolute -inset-1 rounded-full bg-gradient-to-br from-primary/40 via-primaryDeep/30 to-accent/30 blur-md" />
                <img
                  src={profile.avatar}
                  alt={profile.name}
                  className="relative h-20 w-20 sm:h-24 sm:w-24 rounded-full object-cover border-2 border-primary/50 shadow-[0_0_40px_rgba(91,140,255,0.4)]"
                  onError={(e) => {
                    const el = e.currentTarget as HTMLImageElement;
                    el.src = 'https://ui-avatars.com/api/?name=MT&background=5B8CFF&color=fff&size=200';
                  }}
                />
                <img
                  src={profile.wolfLogo}
                  alt=""
                  className="absolute -bottom-1 -right-1 h-8 w-8 rounded-full border-2 border-bg bg-bg-soft object-contain p-0.5"
                  onError={(e) => (e.currentTarget.style.display = 'none')}
                />
              </div>
              <div className="min-w-0">
                <h1 className="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-[1.05]">
                  <span className="text-gradient">Mohammad</span>{' '}
                  <span className="text-gradient-accent">Taha</span>
                </h1>
                <div className="mt-2 font-mono text-xs text-ink-muted">
                  {profile.handle}
                </div>
              </div>
            </div>

            {/* Typewriter — bigger and full width on mobile */}
            <div className="h-10 sm:h-11 mb-4 w-full sm:w-auto text-center sm:text-left">
              <Typewriter skills={profile.skills} />
            </div>

            <p className="max-w-xl text-base sm:text-lg leading-relaxed text-ink-soft">
              {profile.intro}
            </p>

            <div className="mt-9 flex flex-wrap justify-center lg:justify-start gap-3 w-full sm:w-auto">
              <button onClick={() => scrollTo('wolf')} className="btn btn-primary">
                <Play size={15} />
                Explore Wolf Client
              </button>
              <button onClick={() => scrollTo('projects')} className="btn btn-ghost">
                <Eye size={15} />
                View My Work
              </button>
            </div>

            <button
              onClick={() => scrollTo('journey')}
              className="mt-10 inline-flex items-center gap-2 font-mono text-xs text-ink-muted hover:text-primary transition-colors"
            >
              <span>Scroll to explore</span>
              <ArrowRight size={12} />
            </button>
          </div>

          {/* RIGHT HUD */}
          <div className="w-full">
            <HeroHUD />
          </div>
        </div>
      </div>
    </section>
  );
}