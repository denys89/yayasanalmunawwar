import React from 'react';
import { Loader2 } from 'lucide-react';
import { cn } from '../utils/cn';

interface LoadingSpinnerProps {
  size?: 'sm' | 'md' | 'lg';
  className?: string;
  text?: string;
}

const LoadingSpinner: React.FC<LoadingSpinnerProps> = ({
  size = 'md',
  className,
  text,
}) => {
  const sizeClasses = {
    sm: 'h-4 w-4',
    md: 'h-6 w-6',
    lg: 'h-8 w-8',
  };

  const textSizeClasses = {
    sm: 'text-sm',
    md: 'text-base',
    lg: 'text-lg',
  };

  return (
    <div className={cn('flex items-center justify-center', className)}>
      <div className="flex flex-col items-center space-y-2">
        <Loader2 
          className={cn(
            'animate-spin text-primary-600 dark:text-primary-400',
            sizeClasses[size]
          )} 
        />
        {text && (
          <p className={cn(
            'text-gray-600 dark:text-gray-400',
            textSizeClasses[size]
          )}>
            {text}
          </p>
        )}
      </div>
    </div>
  );
};

export default LoadingSpinner;