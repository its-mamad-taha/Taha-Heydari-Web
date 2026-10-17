export const profile = {
  name: 'Mohammad Taha',
  handle: '@its_mamad_taha',
  role: 'Founder & Owner of Wolf Client',
  tagline: 'Developer · Builder · Creator',
  intro:
    'Founder and lead developer of Wolf Client. Building high-performance Minecraft clients and system-level software with a focus on native performance, clean architecture, and the Wolf ecosystem.',
  avatar: 'assets/img/pfp.jpg',
  wolfLogo: 'assets/img/logo.png',
  skills: ['Rust', 'Java', 'C#', 'Python', 'JavaScript', 'Minecraft'],
  links: {
    github: 'https://github.com/its-mamad-taha',
    telegram: 'https://t.me/its_mamad_taha',
    wolf: 'https://wolfclient.ir',
  },
} as const;

export const navSections = [
  { id: 'home', label: 'Home' },
  { id: 'wolf', label: 'Wolf' },
  { id: 'stack', label: 'Stack' },
  { id: 'journey', label: 'Journey' },
  { id: 'setup', label: 'Setup' },
  { id: 'achievements', label: 'Achievements' },
] as const;