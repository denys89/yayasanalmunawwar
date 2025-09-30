import React, { ReactNode } from 'react';
import { GraduationCap } from 'lucide-react';

interface AuthLayoutProps {
  children: ReactNode;
}

const AuthLayout: React.FC<AuthLayoutProps> = ({ children }) => {
  return (
    <div className="min-h-screen bg-gradient-to-br from-green-50 to-green-100 flex items-center justify-center p-4 sm:p-6 lg:p-8">
      <div className="w-full max-w-sm sm:max-w-md lg:max-w-lg xl:max-w-md">
        {/* Logo and School Name */}
        <div className="text-center mb-8">
          <div className="inline-flex items-center justify-center w-16 h-16 bg-[#28a745] rounded-full mb-4 shadow-lg">
            <GraduationCap className="w-8 h-8 text-white" />
          </div>
          <h1 className="text-2xl font-bold text-gray-900 mb-2">
            Yayasan Al Munawwar
          </h1>
          <p className="text-gray-600">
            Parent Portal
          </p>
        </div>

        {/* Auth Form Container */}
        <div className="bg-white rounded-xl shadow-xl border border-gray-200 p-6 sm:p-8">
          {children}
        </div>

        {/* Footer */}
        <div className="text-center mt-6">
          <p className="text-sm text-gray-500">
            © 2025 Yayasan Al Munawwar. All rights reserved.
          </p>
        </div>
      </div>

      {/* Background Decoration */}
      <div className="fixed inset-0 -z-10 overflow-hidden">
        <div className="absolute -top-40 -right-32 w-80 h-80 bg-green-200 rounded-full opacity-20 blur-3xl"></div>
        <div className="absolute -bottom-40 -left-32 w-80 h-80 bg-green-300 rounded-full opacity-20 blur-3xl"></div>
      </div>
    </div>
  );
};

export default AuthLayout;