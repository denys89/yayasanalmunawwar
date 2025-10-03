import React, { ReactNode, useState } from 'react';
import { Link, useLocation } from 'react-router-dom';
import {
  Home,
  Users,
  CreditCard,
  Bell,
  Settings,
  Menu,
  X,
  Sun,
  Moon,
  LogOut,
  GraduationCap,
  ChevronDown,
} from 'lucide-react';
import { useAuth } from '../hooks/useAuth';
import { useTheme } from '../hooks/useTheme';
import { cn } from '../utils/cn';
import type { NavItem } from '../types';

interface MainLayoutProps {
  children: ReactNode;
}

const navigation: NavItem[] = [
  {
    name: 'Dashboard',
    href: '/dashboard',
    icon: Home,
  },
  {
    name: 'Students',
    href: '/students',
    icon: Users,
  },
  {
    name: 'Payments',
    href: '/payments',
    icon: CreditCard,
  },
  {
    name: 'Announcements',
    href: '/announcements',
    icon: Bell,
  },
  {
    name: 'Settings',
    href: '/settings',
    icon: Settings,
  },
];

const MainLayout: React.FC<MainLayoutProps> = ({ children }) => {
  const [sidebarOpen, setSidebarOpen] = useState(false);
  const [userMenuOpen, setUserMenuOpen] = useState(false);
  const location = useLocation();
  const { user, logout } = useAuth();
  const { theme, toggleTheme } = useTheme();

  // Unified display name and initial to avoid duplication across UI
  const displayName = user?.name?.trim() ? user.name.trim() : 'User';
  const displayInitial = displayName.charAt(0).toUpperCase();

  const handleLogout = () => {
    // Immediately close any open UI elements for a clean exit
    setUserMenuOpen(false);
    setSidebarOpen(false);
    logout();
  };

  return (
    <div className="min-h-screen bg-white">
      {/* Mobile sidebar overlay */}
      {sidebarOpen && (
        <div
          className="fixed inset-0 z-40 lg:hidden"
          onClick={() => setSidebarOpen(false)}
        >
          <div className="fixed inset-0 bg-gray-600 bg-opacity-75" />
        </div>
      )}

      {/* Sidebar */}
      <div
        className={cn(
          'fixed inset-y-0 left-0 z-50 w-64 h-screen bg-white border-r border-gray-200 shadow-sm transform transition-transform duration-300 ease-in-out lg:translate-x-0',
          sidebarOpen ? 'translate-x-0' : '-translate-x-full'
        )}
      >
        {/* Logo Section */}
        <div className="flex items-center justify-between h-16 px-4 border-b border-gray-200">
          <div className="flex items-center">
            <div className="flex items-center justify-center w-10 h-10 bg-green-600 rounded-lg shadow-md">
              <span className="text-white font-bold text-lg">YA</span>
            </div>
            <div className="ml-3">
              <p className="text-sm font-semibold text-gray-900">Yayasan</p>
              <p className="text-xs text-gray-500">Al-Munawwar</p>
            </div>
          </div>
          <button
            onClick={() => setSidebarOpen(false)}
            className="lg:hidden p-1 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100"
          >
            <X className="w-5 h-5" />
          </button>
        </div>

        {/* Navigation */}
        <nav className="flex-1 px-4 py-6">
          <div className="space-y-1">
            {navigation.map((item) => {
              const isActive = location.pathname === item.href || 
                (item.href !== '/dashboard' && location.pathname.startsWith(item.href));
              
              return (
                <Link
                  key={item.name}
                  to={item.href}
                  className={cn(
                    'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-all duration-200',
                    isActive
                      ? 'bg-green-100 text-green-700 border-l-4 border-green-600'
                      : 'text-gray-700 hover:bg-green-50 hover:text-green-700'
                  )}
                  onClick={() => setSidebarOpen(false)}
                >
                  <item.icon
                    className={cn(
                      'mr-3 flex-shrink-0 h-5 w-5',
                      isActive
                        ? 'text-green-600'
                        : 'text-gray-400 group-hover:text-green-600'
                    )}
                  />
                  {item.name}
                  {item.badge && (
                    <span className="ml-auto inline-block py-0.5 px-2 text-xs font-medium rounded-full bg-green-100 text-green-800">
                      {item.badge}
                    </span>
                  )}
                </Link>
              );
            })}
          </div>
        </nav>

      </div>

      {/* Main content */}
      <div className="lg:ml-64 flex flex-col flex-1">
        {/* Top navigation */}
        <div className="fixed top-0 lg:left-64 left-0 right-0 z-10 flex-shrink-0 flex h-16 bg-white shadow border-b border-gray-200 px-6">
          <button
            onClick={() => setSidebarOpen(true)}
            className="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500/50 lg:hidden"
          >
            <Menu className="h-6 w-6" />
          </button>

          <div className="flex-1 flex justify-between items-center">
            <div className="flex-1">
              <h1 className="text-lg font-semibold text-gray-900">
                Yayasan Al-Munawwar
              </h1>
            </div>

            <div className="ml-4 flex items-center md:ml-6 space-x-3">
              {/* Notifications */}
              <button className="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500/50 relative">
                <Bell className="h-5 w-5" />
                <span className="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-white"></span>
              </button>

              {/* Profile dropdown */}
              <div className="relative">
                <button
                  onClick={() => setUserMenuOpen(!userMenuOpen)}
                  className="max-w-xs bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500/50 lg:p-2 lg:rounded-md lg:hover:bg-gray-50"
                >
                  <div className="h-8 w-8 rounded-full bg-green-600 flex items-center justify-center">
                    <span className="text-sm font-medium text-white">
                      {displayInitial}
                    </span>
                  </div>
                  <span className="hidden ml-3 text-gray-700 text-sm font-medium lg:block">
                    {displayName}
                  </span>
                  <ChevronDown className="hidden flex-shrink-0 ml-1 h-4 w-4 text-gray-400 lg:block" />
                </button>

                {userMenuOpen && (
                  <div className="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <Link
                      to="/settings"
                      className="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                      onClick={() => setUserMenuOpen(false)}
                    >
                      Settings
                    </Link>
                    <button
                      onClick={handleLogout}
                      className="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                    >
                      <LogOut className="inline w-4 h-4 mr-2" />
                      Sign out
                    </button>
                  </div>
                )}
              </div>
            </div>
          </div>
        </div>

        {/* Page content */}
        <main className="flex-1 pt-16 lg:px-8 px-6 pb-12">
          <div className="py-6">
            <div className="max-w-7xl mx-auto">
              {children}
            </div>
          </div>
        </main>
      </div>

      {/* Click outside to close user menu */}
      {userMenuOpen && (
        <div
          className="fixed inset-0 z-30"
          onClick={() => setUserMenuOpen(false)}
        />
      )}
    </div>
  );
};

export default MainLayout;