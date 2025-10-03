import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { Eye, EyeOff, Mail, Lock, AlertCircle, Home } from 'lucide-react';
import { useAuth } from '../hooks/useAuth';
import type { LoginForm } from '../types';
import { cn } from '../utils/cn';

const LoginPage: React.FC = () => {
  const [formData, setFormData] = useState<LoginForm>({
    email: '',
    password: '',
    remember: false,
  });
  const [showPassword, setShowPassword] = useState(false);
  const [errors, setErrors] = useState<Partial<LoginForm>>({});
  const [isLoading, setIsLoading] = useState(false);
  const [apiError, setApiError] = useState<string>('');
  
  const { login } = useAuth();
  const navigate = useNavigate();

  const validateForm = (): boolean => {
    const newErrors: Partial<LoginForm> = {};

    if (!formData.email) {
      newErrors.email = 'Email is required';
    } else if (!/\S+@\S+\.\S+/.test(formData.email)) {
      newErrors.email = 'Email is invalid';
    }

    if (!formData.password) {
      newErrors.password = 'Password is required';
    } else if (formData.password.length < 6) {
      newErrors.password = 'Password must be at least 6 characters';
    }

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setApiError('');

    if (!validateForm()) {
      return;
    }

    setIsLoading(true);

    try {
      await login(formData.email, formData.password);
      navigate('/dashboard');
    } catch (error: any) {
      setApiError(error.message || 'Login failed. Please try again.');
    } finally {
      setIsLoading(false);
    }
  };

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value, type, checked } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: type === 'checkbox' ? checked : value,
    }));
    
    // Clear error when user starts typing
    if (errors[name as keyof LoginForm]) {
      setErrors(prev => ({ ...prev, [name]: undefined }));
    }
    
    // Clear API error
    if (apiError) {
      setApiError('');
    }
  };

  return (
    <div className="w-full">
      {/* Header Section */}
      <div className="text-center mb-8">
        <h1 className="text-2xl md:text-3xl font-bold text-[#333333] mb-4 leading-tight">
          Parent Login
        </h1>
        <p className="text-base text-[#6c757d] leading-relaxed">
          Access your account using email and password
        </p>
      </div>

      {/* API Error Alert */}
      {apiError && (
        <div className="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start shadow-sm">
          <AlertCircle className="h-5 w-5 text-red-500 mr-3 mt-0.5 flex-shrink-0" />
          <p className="text-sm text-red-700 font-medium">{apiError}</p>
        </div>
      )}

      {/* Login Form */}
      <form onSubmit={handleSubmit} className="space-y-6">
        {/* Email Field */}
        <div className="space-y-2">
          <label htmlFor="email" className="block text-sm font-semibold text-[#333333]">
            Email Address
          </label>
          <div className="relative">
            <div className="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <Mail className="h-5 w-5 text-[#6c757d]" />
            </div>
            <input
              id="email"
              name="email"
              type="email"
              autoComplete="email"
              value={formData.email}
              onChange={handleInputChange}
              className={cn(
                'w-full pl-12 pr-4 py-3 border border-[#dee2e6] rounded-xl focus:ring-2 focus:ring-[#28a745] focus:border-[#28a745] transition-all duration-200',
                'placeholder-[#6c757d] text-[#333333] bg-[#f8f9fa] font-medium',
                'shadow-sm hover:shadow-md focus:shadow-md',
                errors.email && 'border-red-300 focus:border-red-500 focus:ring-red-500/20 bg-red-50'
              )}
              placeholder="Enter your email address"
            />
          </div>
          {errors.email && (
            <p className="text-sm text-red-600 flex items-center font-medium">
              <AlertCircle className="h-4 w-4 mr-1" />
              {errors.email}
            </p>
          )}
        </div>

        {/* Password Field */}
        <div className="space-y-2">
          <label htmlFor="password" className="block text-sm font-semibold text-[#333333]">
            Password
          </label>
          <div className="relative">
            <div className="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
              <Lock className="h-5 w-5 text-[#6c757d]" />
            </div>
            <input
              id="password"
              name="password"
              type={showPassword ? 'text' : 'password'}
              autoComplete="current-password"
              value={formData.password}
              onChange={handleInputChange}
              className={cn(
                'w-full pl-12 pr-12 py-3 border border-[#dee2e6] rounded-xl focus:ring-2 focus:ring-[#28a745] focus:border-[#28a745] transition-all duration-200',
                'placeholder-[#6c757d] text-[#333333] bg-[#f8f9fa] font-medium',
                'shadow-sm hover:shadow-md focus:shadow-md',
                errors.password && 'border-red-300 focus:border-red-500 focus:ring-red-500/20 bg-red-50'
              )}
              placeholder="Enter your password"
            />
            <button
              type="button"
              onClick={() => setShowPassword(!showPassword)}
              className="absolute inset-y-0 right-0 pr-4 flex items-center hover:text-[#28a745] transition-colors duration-200"
            >
              {showPassword ? (
                <EyeOff className="h-5 w-5 text-[#6c757d]" />
              ) : (
                <Eye className="h-5 w-5 text-[#6c757d]" />
              )}
            </button>
          </div>
          {errors.password && (
            <p className="text-sm text-red-600 flex items-center font-medium">
              <AlertCircle className="h-4 w-4 mr-1" />
              {errors.password}
            </p>
          )}
        </div>

        {/* Remember Me Checkbox */}
        <div className="flex items-center">
          <input
            id="remember"
            name="remember"
            type="checkbox"
            checked={formData.remember}
            onChange={handleInputChange}
            className="h-4 w-4 text-[#28a745] focus:ring-[#28a745] border-[#dee2e6] rounded"
          />
          <label htmlFor="remember" className="ml-3 block text-sm text-[#333333] font-medium">
            Remember me
          </label>
        </div>

        {/* Action Buttons */}
        <div className="space-y-4 pt-2">
          {/* Login Button */}
          <button
            type="submit"
            disabled={isLoading}
            className={cn(
              'w-full flex justify-center items-center py-3 px-6 border border-transparent rounded-xl shadow-lg text-base font-semibold text-white',
              'bg-[#28a745] hover:bg-[#218838] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#28a745]',
              'transition-all duration-200 hover:shadow-xl transform hover:-translate-y-0.5',
              isLoading && 'opacity-50 cursor-not-allowed transform-none'
            )}
          >
            {isLoading ? (
              <div className="flex items-center">
                <div className="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-2"></div>
                Signing in...
              </div>
            ) : (
              'Login'
            )}
          </button>

          {/* Register Button */}
          <Link
            to="/register"
            className="w-full flex justify-center items-center py-3 px-6 border border-[#dee2e6] rounded-xl shadow-sm text-base font-semibold text-[#333333] bg-white hover:bg-[#f8f9fa] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#6c757d] transition-all duration-200 hover:shadow-md transform hover:-translate-y-0.5"
          >
            Register
          </Link>
        </div>
      </form>

      {/* Navigation Links */}
      <div className="mt-8 flex items-center justify-between text-sm">
        <Link
          to="/"
          className="flex items-center text-[#6c757d] hover:text-[#28a745] transition-colors duration-200 font-medium"
        >
          <Home className="h-4 w-4 mr-1" />
          Back to Home
        </Link>
        
        <Link
          to="/forgot-password"
          className="text-[#6c757d] hover:text-[#28a745] transition-colors duration-200 font-medium"
        >
          Forgot Password?
        </Link>
      </div>

      

      {/* Footer */}
      <div className="text-center mt-6">
        <p className="text-sm text-[#6c757d]">
          Need help? Contact{' '}
          <a 
            href="mailto:admin@almunawwar.sch.id" 
            className="text-[#28a745] hover:text-[#218838] transition-colors duration-200 font-medium"
          >
            school administration
          </a>
        </p>
      </div>
    </div>
  );
};

export default LoginPage;