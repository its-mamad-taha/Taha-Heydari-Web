import { forwardRef, HTMLAttributes } from 'react';

type Props = HTMLAttributes<HTMLDivElement> & {
  variant?: 'default' | 'soft';
  hover?: boolean;
  rounded?: string;
};

const GlassCard = forwardRef<HTMLDivElement, Props>(function GlassCard(
  { variant = 'default', hover = true, rounded = 'rounded-3xl', className = '', children, ...rest },
  ref
) {
  const base = variant === 'soft' ? 'glass-soft' : 'glass';
  return (
    <div
      ref={ref}
      className={`${base} ${rounded} ${hover ? 'glass-hover' : ''} ${className}`}
      {...rest}
    >
      {children}
    </div>
  );
});

export default GlassCard;