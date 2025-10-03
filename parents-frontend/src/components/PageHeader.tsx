import React from 'react';
import { cn } from '../utils/cn';

export type IconType = React.ComponentType<React.SVGProps<SVGSVGElement>>;

interface PageHeaderProps {
  title: string;
  description?: string;
  icon?: IconType;
  actions?: React.ReactNode;
  className?: string;
}

const PageHeader: React.FC<PageHeaderProps> = ({ title, description, icon: Icon, actions, className }) => {
  return (
    <div className={cn('flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3', className)}>
      <div>
        <div className="flex items-center gap-3">
          {Icon && (
            <div className="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/20">
              <Icon className="w-5 h-5 text-primary-600 dark:text-primary-400" />
            </div>
          )}
          <h1 className="text-2xl font-bold text-gray-900 dark:text-white">{title}</h1>
        </div>
        {description && (
          <p className="text-gray-600 dark:text-gray-400 mt-1">{description}</p>
        )}
      </div>
      {actions && <div className="flex-shrink-0">{actions}</div>}
    </div>
  );
};

export default PageHeader;