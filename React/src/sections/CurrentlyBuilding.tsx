import { Activity, Cpu, Layers } from 'lucide-react';
import GlassCard from '../components/GlassCard';
import SectionHeader from '../components/SectionHeader';
import Reveal from '../components/Reveal';
import { profile } from '../data/profile';

const stack = ['Java', 'Rust', 'LWJGL', 'JNI'];

export default function CurrentlyBuilding() {
  return (
    <section id="focus" className="relative py-20 md:py-28">
      <div className="mx-auto max-w-7xl px-5 sm:px-6">
        <Reveal>
          <SectionHeader
            index="01"
            label="Focus"
            title="Currently Building"
            description="A snapshot of what is being actively developed right now."
          />
        </Reveal>

        <Reveal delay={120}>
          <GlassCard className="p-6 sm:p-8 lg:p-10">
            <div className="grid lg:grid-cols-[1.2fr_1fr] gap-8 lg:gap-12 items-start">
              {/* Left: project identity */}
              <div>
                <div className="flex items-center gap-4 mb-4">
                  <div className="relative shrink-0">
                    <div className="absolute -inset-1.5 rounded-2xl bg-primary/20 blur-lg" />
                    <img
                      src={profile.wolfLogo}
                      alt="Wolf Client"
                      className="relative h-12 w-12 object-contain"
                      onError={(e) => (e.currentTarget.style.display = 'none')}
                    />
                  </div>
                  <div>
                    <span className="label-mono">Active Project</span>
                    <h3 className="text-2xl sm:text-3xl font-bold text-ink mt-0.5">
                      Wolf Client
                    </h3>
                  </div>
                </div>

                <p className="text-ink-soft leading-relaxed">
                  A Minecraft Client built around performance, customization, and
                  full control over the runtime. Founded and led by Mohammad Taha.
                </p>

                <div className="mt-6 flex flex-wrap gap-2">
                  {stack.map((s) => (
                    <span
                      key={s}
                      className="rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 font-mono text-[11px] uppercase tracking-wider text-ink-soft"
                    >
                      {s}
                    </span>
                  ))}
                </div>
              </div>

              {/* Right: status panel */}
              <div className="grid gap-3">
                <div className="glass-soft rounded-2xl p-4 flex items-center justify-between">
                  <div className="flex items-center gap-2.5">
                    <Cpu size={15} className="text-primary" />
                    <span className="font-mono text-[10px] uppercase tracking-wider text-ink-muted">
                      Platform
                    </span>
                  </div>
                  <span className="text-sm text-ink font-medium">
                    Minecraft 1.8.9
                  </span>
                </div>

                <div className="glass-soft rounded-2xl p-4 flex items-center justify-between">
                  <div className="flex items-center gap-2.5">
                    <Activity size={15} className="text-accent" />
                    <span className="font-mono text-[10px] uppercase tracking-wider text-ink-muted">
                      Status
                    </span>
                  </div>
                  <span className="flex items-center gap-1.5 text-sm text-emerald-300">
                    <span className="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px] shadow-emerald-400" />
                    Active Development
                  </span>
                </div>

                <div className="glass-soft rounded-2xl p-4">
                  <div className="flex items-center gap-2.5 mb-2">
                    <Layers size={14} className="text-primary" />
                    <span className="font-mono text-[10px] uppercase tracking-wider text-ink-muted">
                      Focus Areas
                    </span>
                  </div>
                  <div className="flex flex-wrap gap-1.5">
                    {['Rendering', 'Systems', 'Performance'].map((f) => (
                      <span
                        key={f}
                        className="rounded-full border border-white/10 bg-white/[0.04] px-2.5 py-0.5 text-xs text-ink-soft"
                      >
                        {f}
                      </span>
                    ))}
                  </div>
                </div>
              </div>
            </div>
          </GlassCard>
        </Reveal>
      </div>
    </section>
  );
}