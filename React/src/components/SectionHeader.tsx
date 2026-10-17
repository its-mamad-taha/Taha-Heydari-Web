interface Props {
  index: string;
  label: string;
  title: string;
  description?: string;
  align?: 'left' | 'center';
}

export default function SectionHeader({
  index,
  label,
  title,
  description,
  align = 'left',
}: Props) {
  const centered = align === 'center';
  return (
    <header className={`mb-12 md:mb-16 ${centered ? 'text-center' : ''}`}>
      <div
        className={`flex items-center gap-3 ${
          centered ? 'justify-center' : ''
        } mb-4`}
      >
        <span className="label-mono">{index}</span>
        <span className="h-px w-8 bg-white/15" />
        <span className="label-mono">{label}</span>
      </div>
      <h2 className="text-3xl sm:text-4xl md:text-5xl font-bold tracking-tight text-ink">
        {title}
      </h2>
      {description && (
        <p
          className={`mt-4 max-w-2xl text-ink-soft leading-relaxed ${
            centered ? 'mx-auto' : ''
          }`}
        >
          {description}
        </p>
      )}
    </header>
  );
}