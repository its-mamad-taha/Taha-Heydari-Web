import type { Project } from '../types';

export const wolfFeatured: Project[] = [
  {
    id: 'wolf-client',
    title: 'Wolf Client',
    tagline: 'Core Application & Engine Framework',
    description:
      'The flagship Minecraft client — native engine powered by Rust + JNI bridges, tuned for low-latency gameplay.',
    tech: ['Java', 'Rust', 'LWJGL'],
    status: 'Active',
    byWolf: true,
    link: 'https://wolfclient.ir',
    preview: { type: 'video', src: 'assets/media/Wolfclient.mp4' },
  },
  {
    id: 'wolf-launcher',
    title: 'Wolf Launcher',
    tagline: 'Custom Game Launcher & Performance Hub',
    description:
      'A custom launcher built around performance tuning, clean UX, and full control over the game runtime.',
    tech: ['Java', 'Electron'],
    status: 'Active',
    byWolf: true,
    link: 'https://wolfclient.ir',
    preview: { type: 'video', src: 'assets/media/WolfLancuher.mp4' },
  },
  {
    id: 'wolf-website',
    title: 'Wolf Client Website',
    tagline: 'Official Web Platform & Ecosystem',
    description:
      'The official home for the Wolf ecosystem — client, launcher, and community entry point.',
    tech: ['Web'],
    status: 'Live',
    byWolf: true,
    link: 'https://wolfclient.ir',
    preview: {
      type: 'iframe',
      src: 'https://wolfclient.ir',
      title: 'Wolf Client Website',
    },
  },
];

export const otherProjects: Project[] = [
  {
    id: 'slade',
    title: 'Slade.ir',
    tagline: 'Personal Platform',
    description: 'Parsa Slade — content creator & consultant.',
    status: 'Live',
    link: 'https://slade.ir',
    preview: {
      type: 'iframe',
      src: 'https://slade.ir',
      title: 'Slade.ir',
    },
  },
  {
    id: 'tahaxs',
    title: 'Tahaxs',
    tagline: 'Interactive Web Experience',
    description: 'Taha Xs — content creator & streamer.',
    status: 'Live',
    link: 'assets/Tahaxs/index.html',
    preview: {
      type: 'iframe',
      src: 'assets/Tahaxs/index.html',
      title: 'Tahaxs',
    },
  },
  {
    id: 'univers-game',
    title: 'Univers Game',
    tagline: 'Game Development',
    description: 'A custom HTML / CSS / JS game project.',
    status: 'Live',
    link: 'assets/UniversGame/index.html',
    preview: {
      type: 'iframe',
      src: 'assets/UniversGame/index.html',
      title: 'Univers Game',
    },
  },
];