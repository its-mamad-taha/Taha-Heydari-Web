/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{ts,tsx}'],
  theme: {
    extend: {
      colors: {
        bg: { DEFAULT: '#05060A', soft: '#0A0D14' },
        glass: '#101522',
        primary: '#5B8CFF',
        primaryDeep: '#2E6BFF',
        primaryBright: '#93C5FD',
        accent: '#22D3EE',
        ink: { DEFAULT: '#F8FAFC', soft: '#94A3B8', muted: '#64748B' },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
        mono: ['JetBrains Mono', 'ui-monospace', 'monospace'],
      },
      keyframes: {
        floatSlow: {
          '0%, 100%': { transform: 'translate3d(0,0,0)' },
          '50%': { transform: 'translate3d(0,-20px,0)' },
        },
        pulseSoft: {
          '0%, 100%': { opacity: '0.6' },
          '50%': { opacity: '1' },
        },
        blink: {
          '0%, 49%': { opacity: '1' },
          '50%, 100%': { opacity: '0' },
        },
      },
      animation: {
        'float-slow': 'floatSlow 12s ease-in-out infinite',
        'pulse-soft': 'pulseSoft 3s ease-in-out infinite',
        blink: 'blink 1s steps(1) infinite',
      },
    },
  },
  plugins: [],
};