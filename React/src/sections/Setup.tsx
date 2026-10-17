import { Cpu, HardDrive, Laptop, MemoryStick, Monitor } from 'lucide-react';
import { useState } from 'react';
import GlassCard from '../components/GlassCard';
import SectionHeader from '../components/SectionHeader';
import Reveal from '../components/Reveal';
import { setupItems } from '../data/setup';
import type { SetupItem as SetupItemType } from '../types';

const iconMap: Record<SetupItemType['icon'], React.ReactNode> = {
  laptop: <Laptop size={16} />,
  cpu: <Cpu size={16} />,
  gpu: <Monitor size={16} />,
  storage: <HardDrive size={16} />,
  ram: <MemoryStick size={16} />,
};

function SetupImage({ src, alt }: { src: string; alt: string }) {
  const [err, setErr] = useState(false);

  if (err) {
    return (
      <div className="h-14 w-14 sm:h-16 sm:w-16 rounded-xl border border-white/10 bg-white/[0.03] grid place-items-center">
        <span className="font-mono text-[10px] text-ink-muted">
          {alt.slice(0, 3).toUpperCase()}
        </span>
      </div>
    );
  }

  return (
    <img
      src={src}
      alt={alt}
      loading="lazy"
      onError={() => setErr(true)}
      className="h-14 w-14 sm:h-16 sm:w-16 object-contain rounded-xl border border-white/10 bg-white/[0.03] p-1.5 transition-transform duration-300 group-hover:scale-105"
    />
  );
}

export default function Setup() {
  return (
    <section id="setup" className="relative py-20 md:py-28">
      <div className="mx-auto max-w-7xl px-5 sm:px-6">
        <Reveal>
          <SectionHeader
            index="06"
            label="Workstation"
            title="My Setup"
            description="The hardware and environment I use to build and create."
          />
        </Reveal>

        <Reveal delay={100}>
          <GlassCard hover={false} className="overflow-hidden">
            <div className="flex items-center justify-between px-6 sm:px-8 py-4 border-b border-white/[0.06]">
              <span className="label-mono">System Configuration</span>
              <span className="font-mono text-[10px] text-ink-muted">
                WORKSTATION
              </span>
            </div>

            <ul className="divide-y divide-white/[0.05]">
              {setupItems.map((item, i) => (
                <Reveal
                  key={item.label}
                  as="li"
                  delay={i * 80}
                  y={12}
                  className="group grid grid-cols-1 sm:grid-cols-[auto_1fr] gap-4 sm:gap-6 px-6 sm:px-8 py-6 hover:bg-white/[0.02] transition-colors"
                >
                  {/* Images */}
                  <div className="flex items-center gap-3">
                    {item.images.map((src) => (
                      <SetupImage key={src} src={src} alt={item.label} />
                    ))}
                  </div>

                  {/* Content */}
                  <div className="min-w-0">
                    <div className="flex items-center gap-2.5 mb-1.5">
                      <span className="grid h-7 w-7 place-items-center rounded-lg border border-white/10 bg-white/[0.03] text-primary">
                        {iconMap[item.icon]}
                      </span>
                      <span className="font-mono text-[11px] uppercase tracking-widest text-ink-muted">
                        {item.label}
                      </span>
                    </div>
                    <div className="text-lg font-semibold text-ink">
                      {item.value}
                    </div>
                    <div className="mt-1 text-sm text-ink-soft">
                      {item.description}
                    </div>
                  </div>
                </Reveal>
              ))}
            </ul>
          </GlassCard>
        </Reveal>
      </div>
    </section>
  );
}