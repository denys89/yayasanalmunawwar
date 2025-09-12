// Authentication Types
export interface User {
  id: number;
  name: string;
  email: string;
  role: string;
  is_active: boolean;
  email_verified_at?: string;
  created_at: string;
  updated_at: string;
}

export interface AuthState {
  user: User | null;
  token: string | null;
  isAuthenticated: boolean;
  isLoading: boolean;
}

// Re-export for compatibility
export { AuthState as default };
export type { AuthState, User };

// Form Types
export interface LoginForm {
  email: string;
  password: string;
  remember?: boolean;
}

export interface ForgotPasswordForm {
  email: string;
}

export interface ResetPasswordForm {
  token: string;
  email: string;
  password: string;
  password_confirmation: string;
}

export interface ChangePasswordForm {
  current_password: string;
  password: string;
  password_confirmation: string;
}