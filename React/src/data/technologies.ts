import type { Tech } from '../types';

export const technologies: Tech[] = [
  // CORE / LANGUAGES
  { name: 'Java', category: 'core', image: '/assets/img/Java.png', sub: 'Language' },
  { name: 'Rust', category: 'core', image: '/assets/img/rsut.png', sub: 'Language' },
  { name: 'C#', category: 'core', image: '/assets/img/Csharp.png', sub: 'Language' },
  { name: 'Python', category: 'core', image: '/assets/img/python.png', sub: 'Language' },
  { name: 'JavaScript', category: 'web', image: '/assets/img/js.png', sub: 'Language' },
  { name: 'PHP', category: 'web', image: '/assets/img/php.png', sub: 'Language' },
  { name: 'HTML', category: 'web', image: '/assets/img/html.png', sub: 'Markup' },
  { name: 'CSS', category: 'web', image: '/assets/img/css.png', sub: 'Styling' },

  // WEB & APP
  { name: 'Node.js', category: 'web', image: '/assets/img/nodejs.png', sub: 'Runtime' },
  { name: 'Electron', category: 'web', image: '/assets/img/electron.png', sub: 'Desktop' },

  // SYSTEMS & TOOLS
  { name: 'LWJGL', category: 'systems', sub: 'OpenGL' },
  { name: 'JNI', category: 'systems', sub: 'Native' },
  { name: 'Git', category: 'systems', image: '/assets/img/Git.png' },
  { name: 'GitHub', category: 'systems', image: '/assets/img/github.png' },
  { name: 'Ubuntu', category: 'systems', image: '/assets/img/ubuntu.png' },
  { name: 'IoT', category: 'systems', image: '/assets/img/Iot.png' },
  { name: 'Raspberry Pi', category: 'systems', image: '/assets/img/Rasber pi.png' },
  { name: 'Unity', category: 'systems', image: '/assets/img/unity.png' },
];

export const techCategories = [
  { id: 'all', label: 'All' },
  { id: 'core', label: 'Languages' },
  { id: 'web', label: 'Web & App' },
  { id: 'systems', label: 'Systems & Tools' },
] as const;