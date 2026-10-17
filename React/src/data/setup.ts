import type { SetupItem } from '../types';

export const setupItems: SetupItem[] = [
  {
    label: 'Laptop',
    value: 'HP Laptop 15',
    description: 'My daily driver — reliable and powerful enough for development.',
    icon: 'laptop',
    images: ['/assets/img/Lap_top.png'],
  },
  {
    label: 'CPU',
    value: 'Intel Core i7-1255U',
    description: '12th Gen · 10 cores · up to 4.7 GHz · great for compilation.',
    icon: 'cpu',
    images: ['/assets/img/Cpu.png', '/assets/img/intel.png'],
  },
  {
    label: 'GPU',
    value: 'NVIDIA GeForce MX550',
    description: 'Dedicated graphics for coding, light rendering, and gaming.',
    icon: 'gpu',
    images: ['/assets/img/gpu.png', '/assets/img/nvidia.png'],
  },
  {
    label: 'Storage',
    value: '256 GB SSD + 1 TB HDD',
    description: 'Fast SSD for OS and projects, HDD for backups and large files.',
    icon: 'storage',
    images: ['/assets/img/ssd.png'],
  },
  {
    label: 'Memory',
    value: '16 GB DDR4 3200 MHz',
    description: 'Plenty of memory for heavy IDEs, virtual machines, and multitasking.',
    icon: 'ram',
    images: ['/assets/img/ram.png'],
  },
];