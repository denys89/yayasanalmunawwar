import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { Mail, ArrowLeft, CheckCircle, AlertCircle } from 'lucide-react';
import { authApi } from '../services/api';
import type { ForgotPasswordForm } from '../types';
import { cn } from '../utils/cn';

const ForgotPasswordPage: React.FC = () => {
  const [formData, setFormData] = useState<ForgotPasswordForm>({
    email: '',
  });
  const [errors, setErrors] = useState<Partial<ForgotPasswordForm>>({});
  const [isLoading, setIsLoading] = useState(false);
  const [isSuccess, setIsSuccess] = useState(false);
  const [apiError, setApiError] = useState<string>('');

  const validateForm = (): boolean => {
    const newErrors: Partial<ForgotPasswordForm> = {};

    if (!formData.email) {
      newErrors.email = 'Email is required';
    } else if (!/\S+@\S+\.\S+/.test(formData.email)) {
      newErrors.email = 'Email is invalid';
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
      const response = await authApi.forgotPassword(formData.email);
      
      if (response.data.success) {
        setIsSuccess(true);
      } else {
        setApiError(response.data.message || 'Failed to send reset email');
      }
    } catch (error: any) {
      if (error.response?.data?.message) {
        setApiError(error.response.data.message);
      } else {
        setApiError('Failed to send reset email. Please try again.');
      }
    } finally {
      setIsLoading(false);
    }
  };

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
    
    // Clear error when user starts typing
    if (errors[name as keyof ForgotPasswordForm]) {
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
            Check Your Email
          </h2>
          <p className="mt-2 text-sm text-gray-600 dark:text-gray-400">
            We've sent a password reset link to <strong>{formData.email}</strong>
          </p>
        </div>

        <div className="rounded-md bg-blue-50 dark:bg-blue-900/20 p-4">
          <div className="text-sm text-blue-800 dark:text-blue-200">
            <p className="font-medium mb-2">What's next?</p>
            <ul className="list-disc list-inside space-y-1">
              <li>Check your email inbox (and spam folder)</li>
              <li>Click the reset link in the email</li>
              <li>Create a new password</li>
              <li>Sign in with your new password</li>
            </ul>
          </div>
        </div>

        <div className="flex flex-col space-y-3">
          <button
            onClick={() => {
              setIsSuccess(false);
              setFormData({ email: '' });
            }}
            className="btn btn-primary w-full"
          >
            Send Another Email
          </button>
          
          <Link
            to="/login"
            className="btn btn-secondary w-full text-center"
          >
            <ArrowLeft className="w-4 h-4 mr-2" />
            Back to Sign In
          </Link>
        </div>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      <div className="text-center">
        <h2 className="text-2xl font-bold text-gray-900 dark:text-white">
          Forgot Password?
        </h2>
        <p className="mt-2 text-sm text-gray-600 dark:text-gray-400">
          Enter your email address and we'll send you a link to reset your password
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
        {/* Email Field */}
        <div>
          <label htmlFor="email" className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Email Address
          </label>
          <div className="relative">
            <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <Mail className="h-5 w-5 text-gray-400" />
            </div>
            <input
              id="email"
              name="email"
              type="email"
              autoComplete="email"
              value={formData.email}
              onChange={handleInputChange}
              className={cn(
                'input pl-10',
                errors.email && 'border-red-300 dark:border-red-600 focus-visible:ring-red-500'
              )}
              placeholder="Enter your email address"
            />
          </div>
          {errors.email && (
            <p className="mt-1 text-sm text-red-600 dark:text-red-400">
              {errors.email}
            </p>
          )}
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
              Sending Reset Link...
            </div>
          ) : (
            'Send Reset Link'
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

export default ForgotPasswordPage;