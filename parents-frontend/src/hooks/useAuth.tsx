import React, { createContext, useContext, useEffect, useState, ReactNode } from 'react';
import type { User, AuthState } from '../types';
import { authApi } from '../services/api';

interface AuthContextType extends AuthState {
  login: (email: string, password: string) => Promise<void>;
  logout: () => void;
  refreshUser: () => Promise<void>;
}

const AuthContext = createContext<AuthContextType | undefined>(undefined);

interface AuthProviderProps {
  children: ReactNode;
}

export function AuthProvider({ children }: AuthProviderProps) {
  const [state, setState] = useState<AuthState>({
    user: null,
    token: localStorage.getItem('auth_token'),
    isAuthenticated: false,
    isLoading: true,
  });

  // Initialize auth state on mount
  useEffect(() => {
    const initAuth = async () => {
      const token = localStorage.getItem('auth_token');
      const userData = localStorage.getItem('user_data');
      
      if (token && userData) {
        try {
          const user = JSON.parse(userData);
          setState(prev => ({
            ...prev,
            user,
            token,
            isAuthenticated: true,
            isLoading: false,
          }));
          
          // Verify token is still valid
          await refreshUser();
        } catch (error) {
          console.error('Failed to parse user data:', error);
          logout();
        }
      } else {
        setState(prev => ({ ...prev, isLoading: false }));
      }
    };

    initAuth();
  }, []);

  const login = async (email: string, password: string): Promise<void> => {
    try {
      setState(prev => ({ ...prev, isLoading: true }));
      
      const response = await authApi.login({ email, password });
      
      if (response.data.success && response.data.data) {
        const { user, token } = response.data.data;
        
        // Store in localStorage
        localStorage.setItem('auth_token', token);
        localStorage.setItem('user_data', JSON.stringify(user));
        
        setState({
          user,
          token,
          isAuthenticated: true,
          isLoading: false,
        });
      } else {
        throw new Error(response.data.message || 'Login failed');
      }
    } catch (error: any) {
      setState(prev => ({ ...prev, isLoading: false }));
      
      if (error.response?.data?.message) {
        throw new Error(error.response.data.message);
      } else if (error.message) {
        throw new Error(error.message);
      } else {
        throw new Error('Login failed. Please try again.');
      }
    }
  };

  const logout = () => {
    // Call logout API (don't wait for response)
    authApi.logout().catch(console.error);
    
    // Clear local storage
    localStorage.removeItem('auth_token');
    localStorage.removeItem('user_data');
    
    // Reset state
    setState({
      user: null,
      token: null,
      isAuthenticated: false,
      isLoading: false,
    });
  };

  const refreshUser = async (): Promise<void> => {
    try {
      const response = await authApi.user();
      
      if (response.data.success && response.data.data) {
        const user = response.data.data;
        
        // Update localStorage
        localStorage.setItem('user_data', JSON.stringify(user));
        
        setState(prev => ({
          ...prev,
          user,
          isAuthenticated: true,
        }));
      }
    } catch (error) {
      console.error('Failed to refresh user:', error);
      logout();
    }
  };

  const value: AuthContextType = {
    ...state,
    login,
    logout,
    refreshUser,
  };

  return (
    <AuthContext.Provider value={value}>
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth(): AuthContextType {
  const context = useContext(AuthContext);
  if (context === undefined) {
    throw new Error('useAuth must be used within an AuthProvider');
  }
  return context;
}

// Protected Route Component
interface ProtectedRouteProps {
  children: ReactNode;
}

export function ProtectedRoute({ children }: ProtectedRouteProps) {
  const { isAuthenticated, isLoading } = useAuth();

  if (isLoading) {
    return (
      <div className="min-h-screen flex items-center justify-center">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-primary-600"></div>
      </div>
    );
  }

  if (!isAuthenticated) {
    window.location.href = '/login';
    return null;
  }

  return <>{children}</>;
}