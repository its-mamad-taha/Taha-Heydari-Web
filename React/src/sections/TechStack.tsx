import { useMemo, useState } from 'react';
import SectionHeader from '../components/SectionHeader';
import TechItem from '../components/TechItem';
import Reveal from '../components/Reveal';
import { techCategories, technologies } from '../data/technologies';
import type { TechCategory } from '../types';

type Filter = 'all' | TechCategory;

export default function TechStack() {
  const [filter, setFilter] = useState<Filter>('all');

  const items = useMemo(() => {
    if (filter === 'all') return technologies;
    return technologies.filter((t) => t.category === filter);
  }, [filter]);

  return (
    <section id="stack" className="relative py-20 md:py-28">
      <div className="mx-auto max-w-7xl px-5 sm:px-6">
        <Reveal>
          <SectionHeader
            index="03"
            label="Stack"
            title="Tech Stack"
            description="Technologies I work with daily — focused on systems, performance, and the web."
          />
        </Reveal>

        {/* Filters */}
        <Reveal delay={80}>
          <div className="mb-8 flex flex-wrap gap-2">
            {techCategories.map((c) => {
              const isActive = filter === c.id;
              return (
                <button
                  key={c.id}
                  onClick={() => setFilter(c.id as Filter)}
                  className={`rounded-full px-4 py-2 text-xs sm:text-[13px] font-medium border transition-all duration-300 ${
                    isActive
                      ? 'border-primary/50 bg-primary/[0.1] text-ink shadow-[0_0_20px_-6px_rgba(91,140,255,0.5)]'
                      : 'border-white/10 bg-white/[0.02] text-ink-soft hover:text-ink hover:border-white/25'
                  }`}
                >
                  {c.label}
                </button>
              );
            })}
          </div>
        </Reveal>

        {/* Grid */}
        <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4">
          {items.map((t, i) => (
            <Reveal key={t.name} delay={Math.min(i * 40, 400)} y={16}>
              <TechItem tech={t} />
            </Reveal>
          ))}
        </div>
      </div>
    </section>
  );
}