import { Github, Send } from 'lucide-react';
import { navSections, profile } from '../data/profile';

export default function Footer() {
  const year = new Date().getFullYear();

  const go = (id: string) => {
    const el = document.getElementById(id);
    if (el) window.scrollTo({ top: el.offsetTop - 90, behavior: 'smooth' });
  };

  return (
    <footer id="contact" className="relative pt-20 md:pt-28 pb-10">
      <div className="mx-auto max-w-7xl px-5 sm:px-6">
        <div className="glass rounded-[2rem] p-8 sm:p-10 lg:p-12">
          <div className="grid lg:grid-cols-[1.4fr_1fr_1fr] gap-10 lg:gap-16">
            <div>
              <div className="flex items-center gap-3">
                <img
                  src={profile.wolfLogo}
                  alt="Wolf"
                  className="h-10 w-10 object-contain"
                  onError={(e) => (e.currentTarget.style.display = 'none')}
                />
                <div>
                  <div className="text-base font-semibold text-ink">{profile.name}</div>
                  <div className="font-mono text-[11px] text-ink-muted">{profile.handle}</div>
                </div>
              </div>
              <p className="mt-5 max-w-sm text-sm leading-relaxed text-ink-soft">
                Founder & Owner of Wolf Client. Building high-performance Minecraft
                clients and system-level software.
              </p>
            </div>

            <div>
              <div className="label-mono mb-4">Navigate</div>
              <ul className="space-y-2.5">
                {navSections.slice(1).map((s) => (
                  <li key={s.id}>
                    <button
                      onClick={() => go(s.id)}
                      className="text-sm text-ink-soft hover:text-ink transition-colors"
                    >
                      {s.label}
                    </button>
                  </li>
                ))}
              </ul>
            </div>

            <div>
              <div className="label-mono mb-4">Connect</div>
              <ul className="space-y-2.5">
                <li>
                  <a
                    href={profile.links.github}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="inline-flex items-center gap-2 text-sm text-ink-soft hover:text-ink transition-colors"
                  >
                    <Github size={14} /> its-mamad-taha
                  </a>
                </li>
                <li>
                  <a
                    href={profile.links.telegram}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="inline-flex items-center gap-2 text-sm text-ink-soft hover:text-ink transition-colors"
                  >
                    <Send size={14} /> Telegram
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <div className="mt-10 pt-6 border-t border-white/[0.06] flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <p className="font-mono text-[11px] text-ink-muted">
              © {year} {profile.name} — All rights reserved.
            </p>
            <p className="font-mono text-[11px] text-ink-muted">
              Founder of the Wolf ecosystem
            </p>
          </div>
        </div>
      </div>
    </footer>
  );
}