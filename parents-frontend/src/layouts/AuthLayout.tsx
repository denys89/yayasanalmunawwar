import React, { ReactNode } from 'react';
import { GraduationCap } from 'lucide-react';

interface AuthLayoutProps {
  children: ReactNode;
}

const AuthLayout: React.FC<AuthLayoutProps> = ({ children }) => {
  return (
    <div className="min-h-screen bg-gradient-to-br from-primary-50 to-primary-100 dark:from-gray-900 dark:to-gray-800 flex items-center justify-center p-4">
      <div className="w-full max-w-md">
        {/* Logo and School Name */}
        <div className="text-center mb-8">
          <div className="inline-flex items-center justify-center w-16 h-16 bg-primary-600 rounded-full mb-4">
            <GraduationCap className="w-8 h-8 text-white" />
          </div>
          <h1 className="text-2xl font-bold text-gray-900 dark:text-white mb-2">
            Yayasan Al Munawwar
          </h1>
          <p className="text-gray-600 dark:text-gray-400">
            Parent Portal
          </p>
        </div>

        {/* Auth Form Container */}
        <div className="card p-6 shadow-lg">
          {children}
        </div>

        {/* Footer */}
        <div className="text-center mt-6">
          <p className="text-sm text-gray-500 dark:text-gray-400">
            © 2025 Yayasan Al Munawwar. All rights reserved.
          </p>
        </div>
      </div>

      {/* Background Decoration */}
      <div className="fixed inset-0 -z-10 overflow-hidden">
        <div className="absolute -top-40 -right-32 w-80 h-80 bg-primary-200 dark:bg-primary-900 rounded-full opacity-20 blur-3xl"></div>
        <div className="absolute -bottom-40 -left-32 w-80 h-80 bg-primary-300 dark:bg-primary-800 rounded-full opacity-20 blur-3xl"></div>
      </div>
    </div>
  );
};

export default AuthLayout;