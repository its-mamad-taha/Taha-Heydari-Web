export type TechCategory = 'core' | 'web' | 'systems';

export interface Tech {
  name: string;
  category: TechCategory;
  image?: string;
  sub?: string;
}

export type ProjectPreview =
  | { type: 'video'; src: string }
  | { type: 'iframe'; src: string; title: string }
  | { type: 'image'; src: string }
  | { type: 'placeholder'; label: string; hint?: string };

export interface Project {
  id: string;
  title: string;
  tagline: string;
  description?: string;
  tech?: string[];
  status?: string;
  link?: string;
  preview?: ProjectPreview;
  byWolf?: boolean;
}

export interface TimelineEntry {
  year: string;
  title: string;
  description: string;
  now?: boolean;
}

export interface SetupItem {
  label: string;
  value: string;
  description: string;
  icon: 'laptop' | 'cpu' | 'gpu' | 'storage' | 'ram';
  images: string[];
}

export interface Achievement {
  id: string;
  rank?: string;
  rankLabel?: string;
  title: string;
  location?: string;
  description: string;
  image?: string;
  variant?: 'gold' | 'silver' | 'muted' | 'info';
}