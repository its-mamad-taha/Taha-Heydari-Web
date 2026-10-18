import { useState, useEffect } from 'react';

interface Wish {
  name: string;
  message: string;
  timestamp: string;
}

// ⚠️ فقط این خط رو عوض کن — آدرس فایل PHP روی هاست خودت
const API_URL = 'https://wolfclient.ir/birthday-wishes.php';

export default function BirthdayPopup() {
  const [isOpen, setIsOpen] = useState(false);
  const [showForm, setShowForm] = useState(false);
  const [name, setName] = useState('');
  const [message, setMessage] = useState('');
  const [wishes, setWishes] = useState<Wish[]>([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');
  const [success, setSuccess] = useState(false);

  useEffect(() => {
    fetch(API_URL)
      .then((r) => r.json())
      .then((data) => setWishes(Array.isArray(data) ? data : []))
      .catch(() => {});

    const timer = setTimeout(() => setIsOpen(true), 800);
    return () => clearTimeout(timer);
  }, []);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!name.trim() || !message.trim() || loading) return;

    setLoading(true);
    setError('');

    try {
      const res = await fetch(API_URL, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name: name.trim(), message: message.trim() }),
      });

      const data = await res.json();
      if (!res.ok) throw new Error(data.error || 'Failed to send wish');

      setWishes((prev) => [...prev, data.wish]);
      setName('');
      setMessage('');
      setShowForm(false);
      setSuccess(true);
      setTimeout(() => setSuccess(false), 3000);
    } catch (err: any) {
      setError(err.message || 'Something went wrong.');
    } finally {
      setLoading(false);
    }
  };

  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 bg-black/80 backdrop-blur-lg overflow-y-auto">
      <div className="relative w-full max-w-lg glass rounded-3xl overflow-hidden border border-primary/30 shadow-[0_0_60px_rgba(91,140,255,0.4)] my-8">
        <div className="bg-gradient-to-r from-primary via-accent to-primary h-1.5 w-full" />

        <button
          onClick={() => setIsOpen(false)}
          className="absolute top-4 right-4 z-20 h-9 w-9 rounded-full bg-black/40 text-white/70 hover:text-white hover:bg-black/60 transition-all text-xl font-bold"
        >
          ×
        </button>

        <div className="p-6 sm:p-8 text-center">
          <div className="flex justify-center mb-5">
            <div className="relative">
              <div className="absolute -inset-2 bg-primary/30 rounded-full blur-lg animate-pulse-soft" />
              <div className="relative grid h-16 w-16 place-items-center rounded-full bg-gradient-to-br from-primary to-accent text-white shadow-lg text-3xl">
                🎂
              </div>
            </div>
          </div>

          <h2 className="text-2xl sm:text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-primary via-white to-accent mb-3">
            It's Taha's Birthday! 🎉
          </h2>

          <p className="text-ink-soft text-sm sm:text-base leading-relaxed mb-6">
            Thank you for visiting my portfolio and celebrating this special moment
            with me. Your wishes mean the world to me! 🥳
          </p>

          <div className="relative rounded-2xl overflow-hidden border border-white/10 shadow-2xl mb-6">
            <img
              src="assets/img/HBD.png"
              alt="Happy Birthday"
              className="w-full h-auto object-cover"
              onError={(e) => (e.currentTarget.style.display = 'none')}
            />
          </div>

          {error && (
            <div className="mb-4 rounded-xl border border-red-400/30 bg-red-400/10 px-4 py-3 text-sm text-red-200">
              {error}
            </div>
          )}

          {success && (
            <div className="mb-4 rounded-xl border border-emerald-400/30 bg-emerald-400/10 px-4 py-3 text-sm text-emerald-200">
              ✓ Your wish has been saved! Thank you 🎁
            </div>
          )}

          {!showForm && (
            <button
              onClick={() => setShowForm(true)}
              className="btn btn-primary w-full py-3 mb-3"
            >
              ✍️ Leave a Birthday Wish
            </button>
          )}

          {showForm && (
            <form onSubmit={handleSubmit} className="text-left space-y-3 mb-4">
              <input
                type="text"
                value={name}
                onChange={(e) => setName(e.target.value)}
                placeholder="Your name"
                maxLength={50}
                className="w-full rounded-xl bg-white/[0.05] border border-white/10 px-4 py-3 text-ink placeholder:text-ink-muted focus:outline-none focus:border-primary/50"
                required
                disabled={loading}
              />
              <textarea
                value={message}
                onChange={(e) => setMessage(e.target.value)}
                placeholder="Write your birthday wish for Taha..."
                maxLength={300}
                rows={3}
                className="w-full rounded-xl bg-white/[0.05] border border-white/10 px-4 py-3 text-ink placeholder:text-ink-muted focus:outline-none focus:border-primary/50 resize-none"
                required
                disabled={loading}
              />
              <div className="flex gap-2">
                <button type="submit" className="btn btn-primary flex-1" disabled={loading}>
                  {loading ? 'Sending...' : 'Send Wish 🎁'}
                </button>
                <button
                  type="button"
                  onClick={() => setShowForm(false)}
                  className="btn btn-ghost px-5"
                  disabled={loading}
                >
                  Cancel
                </button>
              </div>
            </form>
          )}

          {wishes.length > 0 && (
            <div className="mt-6 pt-6 border-t border-white/10 text-left">
              <h3 className="text-sm font-semibold text-ink mb-3">
                Wishes ({wishes.length})
              </h3>
              <div className="max-h-40 overflow-y-auto space-y-2 pr-1">
                {wishes
                  .slice()
                  .reverse()
                  .map((w, i) => (
                    <div
                      key={i}
                      className="rounded-xl bg-white/[0.03] border border-white/5 p-3"
                    >
                      <div className="text-xs font-semibold text-primary">
                        {w.name}
                      </div>
                      <div className="text-sm text-ink-soft mt-1">{w.message}</div>
                    </div>
                  ))}
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}