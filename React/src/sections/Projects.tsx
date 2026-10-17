import ProjectCard from '../components/ProjectCard';
import SectionHeader from '../components/SectionHeader';
import Reveal from '../components/Reveal';
import { otherProjects } from '../data/projects';

export default function Projects() {
  return (
    <section id="projects" className="relative py-20 md:py-28">
      <div className="mx-auto max-w-7xl px-5 sm:px-6">
        <Reveal>
          <SectionHeader
            index="04"
            label="Projects"
            title="Other Projects"
            description="Web platforms and interactive experiences — all built by me."
          />
        </Reveal>

        {/* Wider cards for Tahaxs + Univers, single column on tablet */}
        <div className="grid md:grid-cols-2 gap-6 lg:gap-7">
          {otherProjects.map((p, i) => (
            <Reveal
              key={p.id}
              delay={i * 100}
              className={p.id === 'slade' ? 'md:col-span-2' : ''}
            >
              <ProjectCard project={p} size="wide" />
            </Reveal>
          ))}
        </div>
      </div>
    </section>
  );
}