import { ArrowUpRight, CheckCircle2, Crown, Play } from 'lucide-react';
import GlassCard from '../components/GlassCard';
import SectionHeader from '../components/SectionHeader';
import ProjectCard from '../components/ProjectCard';
import Reveal from '../components/Reveal';
import { profile } from '../data/profile';
import { wolfFeatured } from '../data/projects';

const tech = ['Java', 'Rust', 'LWJGL', 'Performance', 'Native Engine'];

export default function WolfClient() {
  const primary = wolfFeatured[0];
  const others = wolfFeatured.slice(1);

  return (
    <section id="wolf" className="relative py-20 md:py-28">
      <div className="mx-auto max-w-7xl px-5 sm:px-6">
        <Reveal>
          <SectionHeader
            index="02"
            label="Featured Project"
            title="Wolf Ecosystem"
            description="The flagship of the Wolf ecosystem — built by me, from launcher to core engine."
          />
        </Reveal>

        {/* PRIMARY — Wolf Client */}
        <Reveal>
          <GlassCard hover={false} className="overflow-hidden mb-6 lg:mb-8">
            <div className="relative flex flex-col sm:flex-row items-start sm:items-center gap-5 px-6 sm:px-8 lg:px-10 py-6 border-b border-white/[0.06]">
              <div className="relative shrink-0">
                <div className="absolute -inset-2 rounded-2xl bg-primary/20 blur-xl" />
                <img
                  src={profile.wolfLogo}
                  alt="Wolf Client Logo"
                  className="relative h-16 w-16 sm:h-20 sm:w-20 object-contain"
                  onError={(e) => (e.currentTarget.style.display = 'none')}
                />
              </div>
              <div className="flex-1 min-w-0">
                <h3 className="text-2xl sm:text-3xl font-bold text-ink">Wolf Client</h3>
                <p className="mt-1 text-ink-soft">
                  A Minecraft client built around performance, customization, and control.
                </p>
                <div className="mt-3 flex flex-wrap items-center gap-2">
                  <span className="inline-flex items-center gap-1.5 rounded-full border border-primary/30 bg-primary/[0.08] px-3 py-1">
                    <Crown size={11} className="text-primary" />
                    <span className="font-mono text-[10px] uppercase tracking-wider text-primary">
                      Founded by Mohammad Taha
                    </span>
                  </span>
                  <span className="inline-flex items-center gap-1.5 rounded-full border border-emerald-400/25 bg-emerald-400/[0.06] px-3 py-1">
                    <span className="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px] shadow-emerald-400" />
                    <span className="font-mono text-[10px] uppercase tracking-wider text-emerald-200">
                      Active Development
                    </span>
                  </span>
                </div>
              </div>
            </div>

            <div className="relative aspect-video bg-bg-soft overflow-hidden">
              <video
                autoPlay
                muted
                loop
                playsInline
                preload="none"
                className="absolute inset-0 h-full w-full object-cover"
              >
                <source src="/assets/media/Wolfclient.mp4" type="video/mp4" />
              </video>
              <div className="pointer-events-none absolute inset-0 bg-gradient-to-t from-bg via-transparent to-transparent" />
            </div>

            <div className="p-6 sm:p-8 lg:p-10">
              <div className="grid lg:grid-cols-[1.4fr_1fr] gap-8 lg:gap-12">
                <div>
                  <h4 className="text-xl sm:text-2xl font-bold text-ink">
                    Core Engine & Framework
                  </h4>
                  <p className="mt-4 leading-relaxed text-ink-soft">
                    Built around a native-performance core with a clean architecture.
                    Wolf Client brings together rendering, systems, and customization
                    under one coherent ecosystem.
                  </p>
                  <ul className="mt-6 space-y-2.5">
                    {[
                      'Native engine powered by Rust + JNI bridges',
                      'Rendering and systems tuned for low-latency gameplay',
                      'Integrated with the Wolf Launcher and ecosystem',
                    ].map((t) => (
                      <li key={t} className="flex items-start gap-2.5 text-sm text-ink-soft">
                        <CheckCircle2 size={16} className="mt-0.5 shrink-0 text-primary" />
                        <span>{t}</span>
                      </li>
                    ))}
                  </ul>
                </div>

                <div className="space-y-5">
                  <div>
                    <div className="label-mono mb-3">Tech Stack</div>
                    <div className="flex flex-wrap gap-2">
                      {tech.map((t) => (
                        <span
                          key={t}
                          className="rounded-full border border-white/10 bg-white/[0.04] px-3 py-1 font-mono text-[11px] uppercase tracking-wider text-ink-soft"
                        >
                          {t}
                        </span>
                      ))}
                    </div>
                  </div>

                  <div className="flex flex-wrap gap-2 pt-2">
                    <a
                      href={profile.links.wolf}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="btn btn-primary"
                    >
                      <Play size={14} />
                      Visit Wolf Client
                    </a>
                    <a
                      href={profile.links.wolf}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="btn btn-ghost"
                    >
                      <ArrowUpRight size={14} />
                      Learn More
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </GlassCard>
        </Reveal>

        {/* WOLF LAUNCHER + WOLF WEBSITE — big cards */}
        <div className="grid md:grid-cols-2 gap-6 lg:gap-7">
          {others.map((p, i) => (
            <Reveal key={p.id} delay={i * 100}>
              <ProjectCard project={p} size="wide" />
            </Reveal>
          ))}
        </div>
      </div>
    </section>
  );
}