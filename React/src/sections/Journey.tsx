import SectionHeader from '../components/SectionHeader';
import Reveal from '../components/Reveal';
import { timeline } from '../data/timeline';

export default function Journey() {
  return (
    <section id="journey" className="relative py-20 md:py-28">
      <div className="mx-auto max-w-7xl px-5 sm:px-6">
        <Reveal>
          <SectionHeader
            index="05"
            label="Journey"
            title="My Journey"
            description="From first lines of code to building the Wolf ecosystem."
          />
        </Reveal>

        <div className="mx-auto max-w-3xl relative">
          {/* Vertical line */}
          <div
            className="absolute left-[11px] top-2 bottom-2 w-px"
            style={{
              background:
                'linear-gradient(to bottom, rgba(91,140,255,0.7), rgba(91,140,255,0.1))',
            }}
          />

          <ul className="space-y-6">
            {timeline.map((item, i) => (
              <li key={item.year + item.title} className="relative pl-10 sm:pl-12">
                {/* Dot */}
                <span
                  className={`absolute left-0 top-2 h-[22px] w-[22px] rounded-full border-[2.5px] border-primary bg-bg grid place-items-center z-10 ${
                    item.now
                      ? 'animate-pulse-soft shadow-[0_0_24px_rgba(91,140,255,0.5)]'
                      : ''
                  }`}
                >
                  <span className="h-1.5 w-1.5 rounded-full bg-primary shadow-[0_0_8px] shadow-primary" />
                </span>

                <Reveal delay={i * 100} y={20}>
                  <div className="glass-soft glass-hover rounded-2xl p-5 sm:p-6">
                    <div
                      className={`font-mono text-[11px] uppercase tracking-widest mb-1 ${
                        item.now ? 'text-primary' : 'text-ink-muted'
                      }`}
                    >
                      {item.year}
                    </div>
                    <h3 className="text-base sm:text-lg font-semibold text-ink">
                      {item.title}
                    </h3>
                    <p className="mt-2 text-sm leading-relaxed text-ink-soft">
                      {item.description}
                    </p>
                  </div>
                </Reveal>
              </li>
            ))}
          </ul>
        </div>
      </div>
    </section>
  );
}