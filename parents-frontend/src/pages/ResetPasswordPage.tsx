import React, { useState, useEffect } from 'react';
import { Link, useSearchParams, useNavigate } from 'react-router-dom';
import { Lock, Eye, EyeOff, CheckCircle, AlertCircle, ArrowLeft } from 'lucide-react';
import { authApi } from '../services/api';
import type { ResetPasswordForm } from '../types';
import { cn } from '../utils/cn';

const ResetPasswordPage: React.FC = () => {
  const [searchParams] = useSearchParams();
  const navigate = useNavigate();
  const token = searchParams.get('token');
  const email = searchParams.get('email');

  const [formData, setFormData] = useState<ResetPasswordForm>({
    email: email || '',
    password: '',
    password_confirmation: '',
    token: token || '',
  });
  const [errors, setErrors] = useState<Partial<ResetPasswordForm>>({});
  const [isLoading, setIsLoading] = useState(false);
  const [isSuccess, setIsSuccess] = useState(false);
  const [apiError, setApiError] = useState<string>('');
  const [showPassword, setShowPassword] = useState(false);
  const [showConfirmPassword, setShowConfirmPassword] = useState(false);

  useEffect(() => {
    // Redirect if token or email is missing
    if (!token || !email) {
      navigate('/login');
    }
  }, [token, email, navigate]);

  const validateForm = (): boolean => {
    const newErrors: Partial<ResetPasswordForm> = {};

    if (!formData.email) {
      newErrors.email = 'Email is required';
    } else if (!/\S+@\S+\.\S+/.test(formData.email)) {
      newErrors.email = 'Email is invalid';
    }

    if (!formData.password) {
      newErrors.password = 'Password is required';
    } else if (formData.password.length < 8) {
      newErrors.password = 'Password must be at least 8 characters';
    }

    if (!formData.password_confirmation) {
      newErrors.password_confirmation = 'Password confirmation is required';
    } else if (formData.password !== formData.password_confirmation) {
      newErrors.password_confirmation = 'Passwords do not match';
    }

    if (!formData.token) {
      newErrors.token = 'Reset token is required';
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
      const response = await authApi.resetPassword(formData);
      
      if (response.data.success) {
        setIsSuccess(true);
        // Redirect to login after 3 seconds
        setTimeout(() => {
          navigate('/login');
        }, 3000);
      } else {
        setApiError(response.data.message || 'Failed to reset password');
      }
    } catch (error: any) {
      if (error.response?.data?.message) {
        setApiError(error.response.data.message);
      } else if (error.response?.data?.errors) {
        // Handle validation errors from Laravel
        const validationErrors = error.response.data.errors;
        const newErrors: Partial<ResetPasswordForm> = {};
        
        Object.keys(validationErrors).forEach(key => {
          if (validationErrors[key] && validationErrors[key].length > 0) {
            newErrors[key as keyof ResetPasswordForm] = validationErrors[key][0];
          }
        });
        
        setErrors(newErrors);
      } else {
        setApiError('Failed to reset password. Please try again.');
      }
    } finally {
      setIsLoading(false);
    }
  };

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
    
    // Clear error when user starts typing
    if (errors[name as keyof ResetPasswordForm]) {
      setErrors(prev => ({ ...prev, [name]: undefined }));
    }
    
    // Clear API error
    if (apiError) {
      setApiError('');
    }
  };

  if (isSuccess) {
    return (
      <div className="space-y-6">
        <div className="text-center">
          <div className="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-900/20">
            <CheckCircle className="h-6 w-6 text-green-600 dark:text-green-400" />
          </div>
          <h2 className="mt-4 text-2xl font-bold text-gray-900 dark:text-white">
            Password Reset Successful!
          </h2>
          <p className="mt-2 text-sm text-gray-600 dark:text-gray-400">
            Your password has been successfully reset. You can now sign in with your new password.
          </p>
        </div>

        <div className="rounded-md bg-green-50 dark:bg-green-900/20 p-4">
          <div className="text-sm text-green-800 dark:text-green-200">
            <p className="font-medium">Redirecting to sign in page in 3 seconds...</p>
          </div>
        </div>

        <Link
          to="/login"
          className="btn btn-primary w-full text-center"
        >
          Continue to Sign In
        </Link>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      <div className="text-center">
        <h2 className="text-2xl font-bold text-gray-900 dark:text-white">
          Reset Your Password
        </h2>
        <p className="mt-2 text-sm text-gray-600 dark:text-gray-400">
          Enter your new password below
        </p>
      </div>

      {/* API Error Alert */}
      {apiError && (
        <div className="rounded-md bg-red-50 dark:bg-red-900/20 p-4">
          <div className="flex">
            <AlertCircle className="h-5 w-5 text-red-400" />
            <div className="ml-3">
              <p className="text-sm text-red-800 dark:text-red-200">
                {apiError}
              </p>
            </div>
          </div>
        </div>
      )}

      <form onSubmit={handleSubmit} className="space-y-6">
        {/* Email Field (readonly) */}
        <div>
          <label htmlFor="email" className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Email Address
          </label>
          <input
            id="email"
            name="email"
            type="email"
            value={formData.email}
            readOnly
            className="input bg-gray-50 dark:bg-gray-800 cursor-not-allowed"
          />
        </div>

        {/* Password Field */}
        <div>
          <label htmlFor="password" className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            New Password
          </label>
          <div className="relative">
            <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <Lock className="h-5 w-5 text-gray-400" />
            </div>
            <input
              id="password"
              name="password"
              type={showPassword ? 'text' : 'password'}
              autoComplete="new-password"
              value={formData.password}
              onChange={handleInputChange}
              className={cn(
                'input pl-10 pr-10',
                errors.password && 'border-red-300 dark:border-red-600 focus-visible:ring-red-500'
              )}
              placeholder="Enter your new password"
            />
            <button
              type="button"
              className="absolute inset-y-0 right-0 pr-3 flex items-center"
              onClick={() => setShowPassword(!showPassword)}
            >
              {showPassword ? (
                <EyeOff className="h-5 w-5 text-gray-400 hover:text-gray-600" />
              ) : (
                <Eye className="h-5 w-5 text-gray-400 hover:text-gray-600" />
              )}
            </button>
          </div>
          {errors.password && (
            <p className="mt-1 text-sm text-red-600 dark:text-red-400">
              {errors.password}
            </p>
          )}
        </div>

        {/* Confirm Password Field */}
        <div>
          <label htmlFor="password_confirmation" className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Confirm New Password
          </label>
          <div className="relative">
            <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <Lock className="h-5 w-5 text-gray-400" />
            </div>
            <input
              id="password_confirmation"
              name="password_confirmation"
              type={showConfirmPassword ? 'text' : 'password'}
              autoComplete="new-password"
              value={formData.password_confirmation}
              onChange={handleInputChange}
              className={cn(
                'input pl-10 pr-10',
                errors.password_confirmation && 'border-red-300 dark:border-red-600 focus-visible:ring-red-500'
              )}
              placeholder="Confirm your new password"
            />
            <button
              type="button"
              className="absolute inset-y-0 right-0 pr-3 flex items-center"
              onClick={() => setShowConfirmPassword(!showConfirmPassword)}
            >
              {showConfirmPassword ? (
                <EyeOff className="h-5 w-5 text-gray-400 hover:text-gray-600" />
              ) : (
                <Eye className="h-5 w-5 text-gray-400 hover:text-gray-600" />
              )}
            </button>
          </div>
          {errors.password_confirmation && (
            <p className="mt-1 text-sm text-red-600 dark:text-red-400">
              {errors.password_confirmation}
            </p>
          )}
        </div>

        {/* Password Requirements */}
        <div className="rounded-md bg-blue-50 dark:bg-blue-900/20 p-4">
          <div className="text-sm text-blue-800 dark:text-blue-200">
            <p className="font-medium mb-2">Password Requirements:</p>
            <ul className="list-disc list-inside space-y-1">
              <li>At least 8 characters long</li>
              <li>Mix of uppercase and lowercase letters recommended</li>
              <li>Include numbers and special characters for better security</li>
            </ul>
          </div>
        </div>

        {/* Submit Button */}
        <button
          type="submit"
          disabled={isLoading}
          className={cn(
            'btn btn-primary w-full py-3 text-base font-medium',
            isLoading && 'opacity-50 cursor-not-allowed'
          )}
        >
          {isLoading ? (
            <div className="flex items-center justify-center">
              <div className="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-2"></div>
              Resetting Password...
            </div>
          ) : (
            'Reset Password'
          )}
        </button>
      </form>

      {/* Back to Login */}
      <div className="text-center">
        <Link
          to="/login"
          className="inline-flex items-center text-sm text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300"
        >
          <ArrowLeft className="w-4 h-4 mr-1" />
          Back to Sign In
        </Link>
      </div>
    </div>
  );
};

export default ResetPasswordPage;