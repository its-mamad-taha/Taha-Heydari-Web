import { useEffect, useState } from 'react';
import { Menu, X, Send, Github } from 'lucide-react';
import { navSections, profile } from '../data/profile';
import { useScrollSpy } from '../hooks/useScrollSpy';

const ids = navSections.map((s) => s.id);

export default function Navbar() {
  const [open, setOpen] = useState(false);
  const [compact, setCompact] = useState(false);
  const active = useScrollSpy(ids);

  useEffect(() => {
    const onScroll = () => setCompact(window.scrollY > 40);
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
    return () => window.removeEventListener('scroll', onScroll);
  }, []);

  useEffect(() => {
    document.body.style.overflow = open ? 'hidden' : '';
    return () => {
      document.body.style.overflow = '';
    };
  }, [open]);

  const go = (id: string) => {
    setOpen(false);
    const el = document.getElementById(id);
    if (el) window.scrollTo({ top: el.offsetTop - 90, behavior: 'smooth' });
  };

  return (
    <>

      <div className="fixed top-4 inset-x-0 z-50 flex justify-center px-4 pointer-events-none">
        {/* Desktop / Tablet nav */}
        <nav
          className={`pointer-events-auto hidden md:flex items-center gap-1
            glass rounded-full px-2 transition-[max-width,padding] duration-500 ease-out
            ${compact ? 'py-1.5 max-w-[880px]' : 'py-2 max-w-[1040px]'}`}
        >
          {/* Logo — pfp.jpg */}
          <button
            onClick={() => go('home')}
            className="flex items-center gap-2.5 pl-1.5 pr-3"
            aria-label="Home"
          >
            <img
              src={profile.avatar}
              alt="Mohammad Taha"
              className="h-8 w-8 rounded-full object-cover border border-primary/40 shadow-[0_0_16px_rgba(91,140,255,0.3)]"
              onError={(e) => {
                const el = e.currentTarget as HTMLImageElement;
                el.src =
                  'https://ui-avatars.com/api/?name=MT&background=5B8CFF&color=fff';
              }}
            />
            <span className="text-sm font-semibold text-ink hidden lg:block">
              Mohammad Taha
            </span>
          </button>

          <ul className="flex items-center gap-0.5">
            {navSections.map((s) => (
              <li key={s.id}>
                <button
                  onClick={() => go(s.id)}
                  className={`relative px-3.5 py-1.5 text-[13px] font-medium rounded-full transition-colors ${
                    active === s.id ? 'text-ink' : 'text-ink-soft hover:text-ink'
                  }`}
                >
                  {active === s.id && (
                    <span className="absolute inset-0 rounded-full bg-white/[0.07] border border-white/10" />
                  )}
                  <span className="relative">{s.label}</span>
                </button>
              </li>
            ))}
          </ul>

          <div className="flex items-center gap-2 pr-1">
            <span className="hidden lg:flex items-center gap-1.5 px-3 py-1 rounded-full border border-emerald-400/25 bg-emerald-400/[0.08]">
              <span className="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_8px] shadow-emerald-400" />
              <span className="text-[11px] font-mono text-emerald-300">
                Available
              </span>
            </span>

          </div>
        </nav>

        {/* Mobile top bar */}
        <nav className="pointer-events-auto md:hidden w-full max-w-md flex items-center justify-between glass rounded-2xl px-3 py-2">
          <button
            onClick={() => go('home')}
            className="flex items-center gap-2"
            aria-label="Home"
          >
            <img
              src={profile.avatar}
              alt="Mohammad Taha"
              className="h-8 w-8 rounded-full object-cover border border-primary/40"
              onError={(e) => {
                const el = e.currentTarget as HTMLImageElement;
                el.src =
                  'https://ui-avatars.com/api/?name=MT&background=5B8CFF&color=fff';
              }}
            />
            <span className="text-sm font-semibold">Mohammad Taha</span>
          </button>
          <button
            onClick={() => setOpen(true)}
            aria-label="Open menu"
            className="grid h-9 w-9 place-items-center rounded-xl border border-white/10 bg-white/[0.04] text-ink"
          >
            <Menu size={18} />
          </button>
        </nav>
      </div>

      {/* Mobile drawer */}
      <div
        className={`fixed inset-0 z-[60] md:hidden transition-opacity duration-300 ${
          open ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'
        }`}
      >
        <div
          className="absolute inset-0 bg-black/60 backdrop-blur-sm"
          onClick={() => setOpen(false)}
        />
        <aside
          className={`absolute right-0 top-0 h-full w-[86%] max-w-sm glass border-l border-white/10
            transition-transform duration-500 ${
              open ? 'translate-x-0' : 'translate-x-full'
            }`}
          style={{ transitionTimingFunction: 'cubic-bezier(0.22,1,0.36,1)' }}
        >
          <div className="flex items-center justify-between px-5 py-4 border-b border-white/5">
            <span className="label-mono">Navigation</span>
            <button
              onClick={() => setOpen(false)}
              aria-label="Close menu"
              className="grid h-9 w-9 place-items-center rounded-xl border border-white/10 bg-white/[0.04]"
            >
              <X size={18} />
            </button>
          </div>

          <ul className="p-4 space-y-1">
            {navSections.map((s, i) => (
              <li key={s.id}>
                <button
                  onClick={() => go(s.id)}
                  className={`w-full text-left rounded-2xl px-4 py-3.5 transition-colors ${
                    active === s.id
                      ? 'bg-white/[0.07] border border-white/10 text-ink'
                      : 'text-ink-soft hover:bg-white/[0.04] border border-transparent'
                  }`}
                >
                  <div className="flex items-center justify-between">
                    <span className="font-medium">{s.label}</span>
                    <span className="label-mono text-[10px]">
                      {String(i + 1).padStart(2, '0')}
                    </span>
                  </div>
                </button>
              </li>
            ))}
          </ul>

          <div className="px-6 py-4 border-t border-white/5">
            <div className="label-mono mb-3">Connect</div>
            <div className="flex items-center gap-2">
              <a
                href={profile.links.github}
                target="_blank"
                rel="noopener noreferrer"
                aria-label="GitHub"
                className="grid h-10 w-10 place-items-center rounded-xl border border-white/10 bg-white/[0.03] text-ink-soft hover:text-ink"
              >
                <Github size={16} />
              </a>
              <a
                href={profile.links.telegram}
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Telegram"
                className="grid h-10 w-10 place-items-center rounded-xl border border-white/10 bg-white/[0.03] text-ink-soft hover:text-ink"
              >
                <Send size={16} />
              </a>
            </div>
          </div>
        </aside>
      </div>
    </>
  );
}