import type { Achievement } from '../types';

export const achievements: Achievement[] = [
  {
    id: 'fira-2024',
    rank: '#1',
    rankLabel: 'First Place',
    title: 'Fira Competition 2024',
    location: 'Turkey',
    description:
      'Ranked #1 among all participants in this international competition.',
    image: 'assets/img/First.png',
    variant: 'gold',
  },
  {
    id: 'talent-2024',
    rank: '#1',
    rankLabel: 'First Place',
    title: 'Talent Show 2024',
    location: 'Yasan Academy',
    description: 'Selected top 20 out of 2000+ participants, ranked #1.',
    image: 'assets/img/First.png',
    variant: 'gold',
  },
  {
    id: 'minecraft-python',
    rank: '#4',
    rankLabel: 'Fourth Place',
    title: 'Minecraft Python Competition',
    location: 'Yasan Academy',
    description:
      'Ranked #4 in the Python Minecraft challenge among many talented developers.',
    image: 'assets/img/Fifth.png',
    variant: 'silver',
  },
  {
    id: 'kolak-2022',
    rankLabel: 'Participant',
    title: 'Kolak 2022',
    location: 'Tehran, Book Garden',
    description:
      'Participated in the event — gained valuable experience and insights.',
    variant: 'muted',
  },
];