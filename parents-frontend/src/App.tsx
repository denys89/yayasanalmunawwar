import React from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { AuthProvider, ProtectedRoute } from './hooks/useAuth';
import { ThemeProvider } from './hooks/useTheme';

// Layouts
import AuthLayout from './layouts/AuthLayout';
import MainLayout from './layouts/MainLayout';

// Pages
import LoginPage from './pages/LoginPage';
import ForgotPasswordPage from './pages/ForgotPasswordPage';
import ResetPasswordPage from './pages/ResetPasswordPage';
import DashboardPage from './pages/DashboardPage';
import StudentsPage from './pages/StudentsPage';
import PaymentsPage from './pages/PaymentsPage';
import AnnouncementsPage from './pages/AnnouncementsPage';
import SettingsPage from './pages/SettingsPage';

function App() {
  return (
    <ThemeProvider>
      <AuthProvider>
        <Router>
          <Routes>
            {/* Public Routes */}
            <Route path="/login" element={
              <AuthLayout>
                <LoginPage />
              </AuthLayout>
            } />
            <Route path="/forgot-password" element={
              <AuthLayout>
                <ForgotPasswordPage />
              </AuthLayout>
            } />
            <Route path="/reset-password" element={
              <AuthLayout>
                <ResetPasswordPage />
              </AuthLayout>
            } />
            
            {/* Protected Routes */}
            <Route path="/" element={
              <ProtectedRoute>
                <MainLayout>
                  <DashboardPage />
                </MainLayout>
              </ProtectedRoute>
            } />
            <Route path="/dashboard" element={
              <ProtectedRoute>
                <MainLayout>
                  <DashboardPage />
                </MainLayout>
              </ProtectedRoute>
            } />
            <Route path="/students" element={
              <ProtectedRoute>
                <MainLayout>
                  <StudentsPage />
                </MainLayout>
              </ProtectedRoute>
            } />

            <Route path="/payments" element={
              <ProtectedRoute>
                <MainLayout>
                  <PaymentsPage />
                </MainLayout>
              </ProtectedRoute>
            } />
            <Route path="/announcements" element={
              <ProtectedRoute>
                <MainLayout>
                  <AnnouncementsPage />
                </MainLayout>
              </ProtectedRoute>
            } />

            <Route path="/settings" element={
              <ProtectedRoute>
                <MainLayout>
                  <SettingsPage />
                </MainLayout>
              </ProtectedRoute>
            } />
            
            {/* Redirect unknown routes to dashboard */}
            <Route path="*" element={<Navigate to="/dashboard" replace />} />
          </Routes>
        </Router>
      </AuthProvider>
    </ThemeProvider>
  );
}

export default App;
