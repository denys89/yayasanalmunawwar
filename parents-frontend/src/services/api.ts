import axios from 'axios';

// API Configuration
const API_BASE_URL =
  import.meta.env.VITE_PARENT_API_URL ||
  import.meta.env.VITE_API_URL ||
  'http://127.0.0.1:8000/api/parent';

// Create axios instance
const api = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

// Request interceptor to add auth token
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('auth_token');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Response interceptor for error handling
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      // Token expired or invalid
      localStorage.removeItem('auth_token');
      localStorage.removeItem('user_data');
      window.location.href = '/login';
    }
    return Promise.reject(error);
  }
);

export default api;

// API Response Types
export interface ApiResponse<T = any> {
  success: boolean;
  message: string;
  data?: T;
  errors?: Record<string, string[]>;
}

// Auth API
export const authApi = {
  login: (credentials: { email: string; password: string }) =>
    api.post<ApiResponse<{ user: any; token: string }>>('/auth/login', credentials),
  
  logout: () => api.post<ApiResponse>('/auth/logout'),
  
  user: () => api.get<ApiResponse<any>>('/auth/user'),
  
  forgotPassword: (email: string) =>
    api.post<ApiResponse>('/auth/forgot-password', { email }),
  
  resetPassword: (data: { token: string; email: string; password: string; password_confirmation: string }) =>
    api.post<ApiResponse>('/auth/reset-password', data),
};

// Dashboard API
export const dashboardApi = {
  getDashboard: () => api.get<ApiResponse<any>>('/dashboard'),
  overview: () => api.get<ApiResponse<any>>('/dashboard/overview'),
  attendanceStats: () => api.get<ApiResponse<any>>('/dashboard/attendance-stats'),
  paymentOverview: () => api.get<ApiResponse<any>>('/dashboard/payment-overview'),
  announcements: () => api.get<ApiResponse<any>>('/dashboard/announcements'),
};

// Students API
export const studentsApi = {
  list: () => api.get<ApiResponse<any[]>>('/students'),
  show: (id: number) => api.get<ApiResponse<any>>(`/students/${id}`),
  attendance: (id: number, params?: { month?: string; year?: string }) =>
    api.get<ApiResponse<any>>(`/students/${id}/attendance`, { params }),
  grades: (id: number, params?: { semester?: string; year?: string }) =>
    api.get<ApiResponse<any>>(`/students/${id}/grades`, { params }),
  reportCard: (id: number, params: { semester: string; year: string }) =>
    api.get(`/students/${id}/report-card`, { params, responseType: 'blob' }),
  schedule: (id: number) => api.get<ApiResponse<any>>(`/students/${id}/schedule`),
};

// Payments API
export const paymentsApi = {
  overview: () => api.get<ApiResponse<any>>('/payments/overview'),
  getPayments: (params?: { page?: number; per_page?: number; status?: string; student_id?: number; payment_type?: string; date_from?: string; date_to?: string }) =>
    api.get<ApiResponse<any>>('/payments/history', { params }),
  show: (id: number) => api.get<ApiResponse<any>>(`/payments/${id}`),
  invoice: (id: number) => api.get(`/payments/${id}/invoice`, { responseType: 'blob' }),
  stats: () => api.get<ApiResponse<any>>('/payments/stats'),
  processPayment: (paymentId: number, payload?: { payment_method?: string; amount?: number }) =>
    api.post<ApiResponse<any>>('/payments/process', { payment_id: paymentId, payment_method: payload?.payment_method || 'bank_transfer', amount: payload?.amount ?? undefined }),
  uploadProof: (id: number, file: File) => {
    const formData = new FormData();
    formData.append('proof_url', file);
    return api.post<ApiResponse<{ proof_url: string; payment_status: string }>>(`/payments/${id}/upload-transfer-proof`, formData, {
      headers: { 'Content-Type': 'multipart/form-data' },
    });
  },
  viewProof: (id: number) => api.get(`/payments/${id}/view-transfer-proof`, { responseType: 'blob' }),
};

// Announcements API
export const announcementsApi = {
  list: (params?: { page?: number; per_page?: number; category?: string; urgent?: boolean }) =>
    api.get<ApiResponse<any>>('/announcements', { params }),
  show: (id: number) => api.get<ApiResponse<any>>(`/announcements/${id}`),
  urgent: () => api.get<ApiResponse<any[]>>('/announcements/urgent'),
  categories: () => api.get<ApiResponse<string[]>>('/announcements/categories'),
  unreadCount: () => api.get<ApiResponse<{ count: number }>>('/announcements/unread-count'),
  markAsRead: (id: number) => api.post<ApiResponse>(`/announcements/${id}/mark-read`),
  downloadAttachment: (id: number, attachmentId: number) =>
    api.get(`/announcements/${id}/attachments/${attachmentId}`, { responseType: 'blob' }),
};

// Settings API
export const settingsApi = {
  getSettings: () => api.get<ApiResponse<any>>('/settings/profile'),
  updateSettings: (data: any) => api.put<ApiResponse<any>>('/settings/profile', data),
  profile: () => api.get<ApiResponse<any>>('/settings/profile'),
  updateProfile: (data: any) => api.put<ApiResponse<any>>('/settings/profile', data),
  changePassword: (data: { current_password: string; password: string; password_confirmation: string }) =>
    api.put<ApiResponse>('/settings/change-password', data),
  notifications: () => api.get<ApiResponse<any>>('/settings/notifications'),
  updateNotifications: (data: any) => api.put<ApiResponse>('/settings/notifications', data),
  privacy: () => api.get<ApiResponse<any>>('/settings/privacy'),
  updatePrivacy: (data: any) => api.put<ApiResponse>('/settings/privacy', data),
  security: () => api.get<ApiResponse<any>>('/settings/security'),
  students: () => api.get<ApiResponse<any[]>>('/settings/students'),
  preferences: () => api.get<ApiResponse<any>>('/settings/preferences'),
  updatePreferences: (data: any) => api.put<ApiResponse>('/settings/preferences', data),
};