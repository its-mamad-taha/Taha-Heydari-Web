import { useState, useEffect } from 'react';
import { X } from 'lucide-react';

export default function BirthdayPopup() {
  const [isOpen, setIsOpen] = useState(false);

  useEffect(() => {
    // پاپ آپ بعد از ۲ ثانیه باز میشه
    const timer = setTimeout(() => {
      setIsOpen(true);
    }, 2000);
    return () => clearTimeout(timer);
  }, []);

  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/70 backdrop-blur-md">
      <div className="relative max-w-md w-full glass p-6 sm:p-8 rounded-3xl animate-fade-in-up border border-primary/30 shadow-[0_0_50px_rgba(91,140,255,0.3)] text-center">
        <button
          onClick={() => setIsOpen(false)}
          className="absolute top-4 right-4 z-10 grid h-10 w-10 place-items-center rounded-full bg-white/10 text-white hover:bg-white/20 transition-colors"
          aria-label="Close"
        >
          <X size={20} />
        </button>
        
        <h2 className="text-2xl sm:text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-primary to-accent mb-4">
          🎉 Happy Birthday Taha! 🎉
        </h2>
        
        <img
          src="assets/img/HBD.png"
          alt="Happy Birthday"
          className="w-full h-auto rounded-xl mb-4"
          onError={(e) => (e.currentTarget.style.display = 'none')}
        />
        
        <p className="text-ink-soft text-sm leading-relaxed">
          Thanks for visiting my portfolio! Enjoy the special day with me. 🎈
        </p>
      </div>
    </div>
  );
}