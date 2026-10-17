import { Award, MapPin, Trophy } from 'lucide-react';
import GlassCard from '../components/GlassCard';
import SectionHeader from '../components/SectionHeader';
import Reveal from '../components/Reveal';
import { achievements } from '../data/achievements';
import type { Achievement } from '../types';

function RankBadge({ ach }: { ach: Achievement }) {
  const v = ach.variant ?? 'info';

  if (ach.rank) {
    const styles: Record<string, string> = {
      gold: 'from-amber-200 via-amber-400 to-amber-600',
      silver: 'from-slate-200 via-slate-400 to-slate-600',
      muted: 'from-slate-400 via-slate-500 to-slate-600',
      info: 'from-primary via-primaryDeep to-accent',
    };
    return (
      <div
        className={`bg-gradient-to-br ${styles[v]} bg-clip-text text-transparent text-5xl sm:text-6xl font-extrabold tracking-tight leading-none`}
      >
        {ach.rank}
      </div>
    );
  }

  return (
    <div className="text-3xl sm:text-4xl font-bold text-ink-soft">
      {ach.rankLabel}
    </div>
  );
}

export default function Achievements() {
  return (
    <section id="achievements" className="relative py-20 md:py-28">
      <div className="mx-auto max-w-7xl px-5 sm:px-6">
        <Reveal>
          <SectionHeader
            index="07"
            label="Achievements"
            title="Recognition & Milestones"
            description="A record of competitions, events and certificates."
          />
        </Reveal>

        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
          {achievements.map((ach, i) => (
            <Reveal key={ach.id} delay={Math.min(i * 80, 400)}>
              <GlassCard className="p-6 sm:p-7 flex flex-col h-full">
                <div className="flex items-start justify-between gap-4">
                  <div className="flex-1">
                    {ach.variant === 'gold' ? (
                      <Trophy size={22} className="text-amber-300" />
                    ) : (
                      <Award size={22} className="text-ink-soft" />
                    )}
                  </div>
                  {ach.image && (
                    <img
                      src={ach.image}
                      alt=""
                      loading="lazy"
                      onError={(e) => (e.currentTarget.style.display = 'none')}
                      className="h-16 w-16 object-contain opacity-90"
                    />
                  )}
                </div>

                <div className="mt-4">
                  <RankBadge ach={ach} />
                  {ach.rank && (
                    <div className="mt-1 font-mono text-[11px] uppercase tracking-widest text-ink-muted">
                      {ach.rankLabel}
                    </div>
                  )}
                </div>

                <div className="mt-5 pt-5 border-t border-white/[0.06]">
                  <h3 className="text-base font-semibold text-ink">{ach.title}</h3>
                  {ach.location && (
                    <div className="mt-1.5 flex items-center gap-1.5 font-mono text-[11px] text-ink-muted">
                      <MapPin size={11} />
                      {ach.location}
                    </div>
                  )}
                  <p className="mt-3 text-sm leading-relaxed text-ink-soft">
                    {ach.description}
                  </p>
                </div>
              </GlassCard>
            </Reveal>
          ))}

          {/* Certificates card */}
          <Reveal delay={400}>
            <GlassCard className="p-6 sm:p-7 flex flex-col h-full">
              <div className="flex items-start justify-between">
                <Award size={22} className="text-amber-200" />
              </div>
              <div className="mt-4">
                <div className="text-2xl sm:text-3xl font-bold text-ink">
                  Proof & Certificates
                </div>
                <div className="mt-1 font-mono text-[11px] uppercase tracking-widest text-ink-muted">
                  On request
                </div>
              </div>
              <div className="mt-5 pt-5 border-t border-white/[0.06]">
                <p className="text-sm leading-relaxed text-ink-soft">
                  Official certificates and rank confirmations are available upon
                  request on Telegram.
                </p>
                <div className="mt-4 inline-flex items-center rounded-full border border-white/10 bg-white/[0.03] px-3 py-1.5 font-mono text-xs text-primary">
                  @its_mamad_taha
                </div>
              </div>
            </GlassCard>
          </Reveal>
        </div>
      </div>
    </section>
  );
}