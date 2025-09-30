// User and Authentication Types
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

// Student Types
export interface Student {
  id: number;
  name: string;
  student_id: string;
  class: string;
  grade_level: number;
  parent_id: number;
  photo?: string;
  date_of_birth?: string;
  gender?: 'male' | 'female';
  address?: string;
  phone?: string;
  emergency_contact?: string;
  created_at: string;
  updated_at: string;
}

// Attendance Types
export interface AttendanceRecord {
  id: number;
  student_id: number;
  date: string;
  status: 'present' | 'absent' | 'late' | 'excused';
  notes?: string;
  created_at: string;
}

export interface AttendanceStats {
  total_days: number;
  present_days: number;
  absent_days: number;
  late_days: number;
  excused_days: number;
  attendance_percentage: number;
  monthly_stats: {
    month: string;
    present: number;
    absent: number;
    late: number;
    excused: number;
  }[];
}

// Grade Types
export interface Grade {
  id: number;
  student_id: number;
  subject: string;
  assignment_type: 'quiz' | 'exam' | 'homework' | 'project' | 'participation';
  assignment_name: string;
  score: number;
  max_score: number;
  percentage: number;
  grade_letter: string;
  semester: string;
  date_recorded: string;
  teacher_notes?: string;
}

export interface GradeSummary {
  subject: string;
  average_score: number;
  grade_letter: string;
  total_assignments: number;
  semester: string;
}

// Payment Types
export interface Payment {
  id: number;
  student_id: number;
  type: 'tuition' | 'registration' | 'activity' | 'transport' | 'meal' | 'other';
  description: string;
  amount: number;
  due_date: string;
  paid_date?: string;
  status: 'pending' | 'paid' | 'overdue' | 'cancelled';
  payment_method?: 'cash' | 'transfer' | 'card' | 'online';
  reference_number?: string;
  notes?: string;
  created_at: string;
  updated_at: string;
}

export interface PaymentSummary {
  total_amount: number;
  paid_amount: number;
  pending_amount: number;
  overdue_amount: number;
  next_due_date?: string;
  payment_history: Payment[];
}

// Announcement Types
export interface Announcement {
  id: number;
  title: string;
  content: string;
  category: 'general' | 'academic' | 'event' | 'urgent' | 'holiday' | 'maintenance';
  is_urgent: boolean;
  target_audience: 'all' | 'parents' | 'students' | 'teachers';
  published_at: string;
  expires_at?: string;
  attachments?: AnnouncementAttachment[];
  read_at?: string;
  created_at: string;
  updated_at: string;
}

export interface AnnouncementAttachment {
  id: number;
  announcement_id: number;
  filename: string;
  original_name: string;
  file_size: number;
  mime_type: string;
  download_url: string;
}

// Dashboard Types
export interface DashboardOverview {
  students_count: number;
  total_attendance_percentage: number;
  pending_payments: number;
  unread_announcements: number;
  recent_grades: Grade[];
  upcoming_events: {
    id: number;
    title: string;
    date: string;
    type: string;
  }[];
}

// Settings Types
export interface NotificationSettings {
  email_announcements: boolean;
  email_grades: boolean;
  email_attendance: boolean;
  email_payments: boolean;
  sms_urgent: boolean;
  sms_payments: boolean;
  push_notifications: boolean;
}

export interface PrivacySettings {
  profile_visibility: 'private' | 'school_only' | 'public';
  allow_contact_from_teachers: boolean;
  allow_contact_from_admin: boolean;
  share_emergency_contact: boolean;
}

export interface AppPreferences {
  theme: 'light' | 'dark' | 'system';
  language: 'en' | 'id';
  timezone: string;
  date_format: 'DD/MM/YYYY' | 'MM/DD/YYYY' | 'YYYY-MM-DD';
  currency: 'IDR' | 'USD';
}

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

export interface PasswordChangeForm {
  current_password: string;
  new_password: string;
  new_password_confirmation: string;
}

export interface Settings {
  phone?: string;
  address?: string;
  email_notifications: boolean;
  sms_notifications: boolean;
  payment_reminders: boolean;
  attendance_alerts: boolean;
  language: string;
  timezone: string;
  password_changed_at?: string;
}

export interface ProfileUpdateForm {
  name: string;
  email: string;
  phone?: string;
  address?: string;
  emergency_contact?: string;
}

// API Response Types
export interface PaginatedResponse<T> {
  data: T[];
  current_page: number;
  last_page: number;
  per_page: number;
  total: number;
  from: number;
  to: number;
}

export interface ApiError {
  message: string;
  errors?: Record<string, string[]>;
  status?: number;
}

// Chart Data Types
export interface ChartDataPoint {
  name: string;
  value: number;
  color?: string;
}

export interface AttendanceChartData {
  month: string;
  present: number;
  absent: number;
  late: number;
}

export interface PaymentChartData {
  month: string;
  paid: number;
  pending: number;
  overdue: number;
}

// Navigation Types
export interface NavItem {
  name: string;
  href: string;
  icon: React.ComponentType<{ className?: string }>;
  badge?: number;
  children?: NavItem[];
}

// Theme Types
export interface ThemeContextType {
  theme: 'light' | 'dark';
  toggleTheme: () => void;
}