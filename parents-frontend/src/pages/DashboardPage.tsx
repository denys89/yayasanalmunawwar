import React, { useState, useEffect } from 'react';
import { 
  User, 
  GraduationCap, 
  CreditCard, 
  Bell, 
  Calendar, 
  MessageCircle,
  FileText,
  LogOut,
  ChevronDown,
  Eye,
  Phone,
  Mail,
  MapPin,
  Clock,
  AlertCircle
} from 'lucide-react';
import { Link } from 'react-router-dom';
import { dashboardApi } from '../services/api';
import { useAuth } from '../hooks/useAuth';
import type { Announcement, Student } from '../types';
import { cn } from '../utils/cn';

interface AnnouncementItem {
  id: number;
  title: string;
  content: string;
  created_at: string;
  category?: string;
  priority?: 'high' | 'medium' | 'low';
}

const DashboardPage: React.FC = () => {
  const { user, logout } = useAuth();
  const [overview, setOverview] = useState<any>(null);
  const [students, setStudents] = useState<Student[]>([]);
  const [announcements, setAnnouncements] = useState<AnnouncementItem[]>([]);
  const [paymentOverview, setPaymentOverview] = useState<any>(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchDashboardData = async () => {
      try {
        setLoading(true);
        setError(null);

        const dashboardRes = await dashboardApi.getDashboard();
        const payload = dashboardRes.data;
        setOverview(payload?.data?.overview || null);
        setStudents(payload?.data?.students || []);

        const paymentRes = await dashboardApi.paymentOverview();
        setPaymentOverview(paymentRes.data?.data || null);

        const annRes = await dashboardApi.announcements();
        const anns = (annRes.data?.data?.announcements || annRes.data?.data || []) as any[];
        const normalized: AnnouncementItem[] = anns.map((a: any) => ({
          id: a.id,
          title: a.title,
          content: a.content || a.excerpt || '',
          created_at: a.created_at || a.published_at,
          category: a.category || a.subcategory || 'general',
          priority: a.is_urgent ? 'high' : (a.category === 'event' || a.category === 'academic' ? 'medium' : 'low')
        }));
        setAnnouncements(normalized);
      } catch (err: any) {
        console.error('Error fetching dashboard data:', err);
        setError(err?.response?.data?.message || 'Failed to load dashboard data');
      } finally {
        setLoading(false);
      }
    };

    fetchDashboardData();
  }, []);

  const handleLogout = () => {
    logout();
  };

  const getPriorityColor = (priority: string) => {
    switch (priority) {
      case 'high': return 'text-red-700 bg-red-50 border-red-200';
      case 'medium': return 'text-yellow-700 bg-yellow-50 border-yellow-200';
      case 'low': return 'text-gray-700 bg-gray-50 border-gray-200';
      default: return 'text-gray-700 bg-gray-50 border-gray-200';
    }
  };

  const getBadgeVariant = (priority: string) => {
    switch (priority) {
      case 'high':
        return 'bg-red-100 text-red-700';
      case 'medium':
        return 'bg-yellow-100 text-yellow-700';
      case 'low':
        return 'bg-gray-100 text-gray-700';
      default:
        return 'bg-gray-100 text-gray-700';
    }
  };

  const getPriorityLabel = (priority: string) => {
    switch (priority) {
      case 'high':
        return 'Urgent';
      case 'medium':
        return 'Reminder';
      case 'low':
        return 'Info';
      default:
        return 'Notice';
    }
  };

  const primaryStudent = students?.[0];

  const getRegStatusBadgeClass = (status?: string) => {
    switch (status) {
      case 'passed':
        return 'bg-green-100 text-green-800';
      case 'failed':
        return 'bg-red-100 text-red-800';
      case 'pending':
      default:
        return 'bg-yellow-100 text-yellow-800';
    }
  };

  if (loading) {
    return (
      <div className="min-h-screen bg-white flex items-center justify-center">
        <div className="text-center">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-green-600 mx-auto mb-4"></div>
          <p className="text-gray-600 font-medium">Loading dashboard...</p>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="min-h-screen bg-white flex items-center justify-center">
        <div className="text-center">
          <p className="text-red-600 font-medium mb-2">{error}</p>
          <p className="text-gray-600">Please try refreshing the page.</p>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-white">
      {/* Welcome Section */}
      <div className="bg-white shadow-sm rounded-lg p-6 border border-gray-200 mb-8">
        <div className="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
          <div className="flex-1">
            <h1 className="text-xl font-bold text-gray-800 mb-2">
              Welcome back, {user?.name || 'Parent'}
            </h1>
            <p className="text-sm text-gray-500 mb-4 leading-relaxed">
              Here's an overview of your child's academic progress and important updates from Yayasan Al-Munawwar.
            </p>
            <div className="flex flex-wrap gap-4 text-sm">
              <div className="flex items-center text-gray-600">
                <User className="w-4 h-4 mr-2 text-green-600" />
                <span><strong>Child:</strong> {primaryStudent?.name || 'N/A'}</span>
              </div>
              <div className="flex items-center text-gray-600">
                <GraduationCap className="w-4 h-4 mr-2 text-green-600" />
                <span><strong>Class:</strong> {primaryStudent?.class || 'N/A'}</span>
              </div>
              <div className="flex items-center text-gray-600">
                <AlertCircle className="w-4 h-4 mr-2 text-green-600" />
                <span><strong>Status:</strong> {overview?.payment_summary?.status || 'Current'}</span>
              </div>
            </div>
          </div>
          <div className="flex-shrink-0">
            <div className="w-20 h-20 bg-gradient-to-br from-green-600 to-green-700 rounded-full flex items-center justify-center shadow-lg">
              <GraduationCap className="w-10 h-10 text-white" />
            </div>
          </div>
        </div>
      </div>

      {/* Main Content Grid - 2 Column Responsive Layout */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        {/* Left Column */}
        <div className="space-y-8">
          
          {/* Student Information Card */}
          <div className="bg-white shadow-sm rounded-lg p-6 border border-gray-200">
            <div className="flex items-center justify-between mb-4">
              <h2 className="text-lg font-semibold text-gray-800 flex items-center">
                <User className="w-5 h-5 mr-2 text-green-600" />
                Student Information
              </h2>
              <button className="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition-colors duration-200 flex items-center text-sm">
                <Eye className="w-4 h-4 mr-2" />
                View Full Details
              </button>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div className="space-y-3">
                <div>
                  <label className="font-medium text-gray-600 text-sm">Full Name</label>
                  <p className="text-gray-800 text-sm">{primaryStudent?.name || 'N/A'}</p>
                </div>
                <div>
                  <label className="font-medium text-gray-600 text-sm">Teacher</label>
                  <p className="text-gray-800 text-sm">{(primaryStudent as any)?.teacher || 'N/A'}</p>
                </div>
                <div>
                  <label className="font-medium text-gray-600 text-sm">School</label>
                  <p className="text-gray-800 text-sm">Yayasan Al-Munawwar</p>
                </div>
                <div>
                  <label className="font-medium text-gray-600 text-sm">Registration Step</label>
                  <p className="text-gray-800 text-sm">{overview?.registration?.step_label || overview?.registration?.step || 'N/A'}</p>
                </div>
              </div>
              <div className="space-y-3">
                <div>
                  <label className="font-medium text-gray-600 text-sm">Grade</label>
                  <p className="text-gray-800 text-sm">{primaryStudent?.class || 'N/A'}</p>
                </div>
                <div>
                  <label className="font-medium text-gray-600 text-sm">Class</label>
                  <p className="text-gray-800 text-sm">{primaryStudent?.class || 'N/A'}</p>
                </div>
                <div>
                  <label className="font-medium text-gray-600 text-sm">Status</label>
                  <span className={cn('inline-flex items-center px-2 py-1 rounded-full text-xs font-medium', getRegStatusBadgeClass(overview?.registration?.status))}>
                    {overview?.registration?.status_label || overview?.registration?.status || 'Pending'}
                  </span>
                </div>
              </div>
            </div>
          </div>

          {/* Payments Overview Card */}
          <div className="bg-white shadow-sm rounded-lg p-6 border border-gray-200">
            <div className="flex items-center justify-between mb-4">
              <h2 className="text-lg font-semibold text-gray-800 flex items-center">
                <CreditCard className="w-5 h-5 mr-2 text-green-600" />
                Payments Overview
              </h2>
              <Link to="/payments" className="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition-colors duration-200 text-sm">
                View Payments
              </Link>
            </div>
            <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div className="p-4 rounded-lg border border-gray-200">
                <div className="text-xs text-gray-500">Total Due</div>
                <div className="text-lg font-semibold text-gray-900">{paymentOverview?.summary?.total_due ?? paymentOverview?.total_due ?? 'Rp 0'}</div>
              </div>
              <div className="p-4 rounded-lg border border-gray-200">
                <div className="text-xs text-gray-500">Overdue Count</div>
                <div className="text-lg font-semibold text-gray-900">{paymentOverview?.summary?.overdue_count ?? paymentOverview?.overdue_count ?? 0}</div>
              </div>
              <div className="p-4 rounded-lg border border-gray-200">
                <div className="text-xs text-gray-500">Next Payment</div>
                <div className="text-lg font-semibold text-gray-900">{paymentOverview?.summary?.next_payment?.amount ?? paymentOverview?.next_payment?.amount ?? 'Rp 0'}</div>
                <div className="text-xs text-gray-500">{(paymentOverview?.summary?.next_payment?.due_date || paymentOverview?.next_payment?.due_date) ? new Date(paymentOverview?.summary?.next_payment?.due_date || paymentOverview?.next_payment?.due_date).toLocaleDateString('id-ID') : '-'}</div>
              </div>
            </div>
          </div>

          {/* Quick Actions Card */}
          <div className="bg-white shadow-sm rounded-lg p-6 border border-gray-200">
            <h2 className="text-lg font-semibold text-gray-800 mb-4 flex items-center">
              <FileText className="w-5 h-5 mr-2 text-green-600" />
              Quick Actions
            </h2>
            <div className="grid grid-cols-2 gap-6">
              <Link
                to="/students"
                className="bg-white border border-gray-200 rounded-lg p-5 text-center hover:bg-gray-50 transition-colors duration-200 group"
              >
                <div className="w-10 h-10 bg-green-600 rounded-md flex items-center justify-center mx-auto mb-3 group-hover:bg-green-700 transition-colors duration-200">
                  <User className="w-5 h-5 text-white" />
                </div>
                <h3 className="font-semibold text-gray-900 text-sm mb-1">View Student Data</h3>
                <p className="text-xs text-gray-600">Academic records</p>
              </Link>

              <Link
                to="/payments"
                className="bg-white border border-gray-200 rounded-lg p-5 text-center hover:bg-gray-50 transition-colors duration-200 group"
              >
                <div className="w-10 h-10 bg-green-600 rounded-md flex items-center justify-center mx-auto mb-3 group-hover:bg-green-700 transition-colors duration-200">
                  <CreditCard className="w-5 h-5 text-white" />
                </div>
                <h3 className="font-semibold text-gray-900 text-sm mb-1">Payment History</h3>
                <p className="text-xs text-gray-600">View bills</p>
              </Link>

              <Link
                to="/announcements"
                className="bg-white border border-gray-200 rounded-lg p-5 text-center hover:bg-gray-50 transition-colors duration-200 group"
              >
                <div className="w-10 h-10 bg-green-600 rounded-md flex items-center justify-center mx-auto mb-3 group-hover:bg-green-700 transition-colors duration-200">
                  <MessageCircle className="w-5 h-5 text-white" />
                </div>
                <h3 className="font-semibold text-gray-900 text-sm mb-1">Messages</h3>
                <p className="text-xs text-gray-600">School communication</p>
              </Link>

              <button
                onClick={handleLogout}
                className="bg-white border border-gray-200 rounded-lg p-5 text-center hover:bg-gray-50 transition-colors duration-200 group"
              >
                <div className="w-10 h-10 bg-gray-500 rounded-md flex items-center justify-center mx-auto mb-3 group-hover:bg-gray-600 transition-colors duration-200">
                  <LogOut className="w-5 h-5 text-white" />
                </div>
                <h3 className="font-semibold text-gray-900 text-sm mb-1">Logout</h3>
                <p className="text-xs text-gray-600">Sign out</p>
              </button>
            </div>
          </div>

        </div>

        {/* Right Column */}
        <div className="space-y-8">
          
          {/* Announcements & Notices Card */}
          <div className="bg-white shadow-sm rounded-lg p-6 border border-gray-200">
            <h2 className="text-lg font-semibold text-gray-800 mb-4 flex items-center">
              <Bell className="w-5 h-5 mr-2 text-green-600" />
              Announcements & Notices
            </h2>
            <div className="space-y-4 max-h-96 overflow-y-auto">
              {announcements.map((announcement) => (
                <div 
                  key={announcement.id} 
                  className={cn(
                    'p-4 rounded-lg border bg-white',
                    announcement.priority === 'high' ? 'border-red-200' :
                    announcement.priority === 'medium' ? 'border-yellow-200' :
                    'border-gray-200'
                  )}
                >
                  <div className="flex items-start justify-between gap-2 mb-2">
                    <span className={cn(
                      'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border',
                      announcement.priority === 'high' ? 'border-red-200 text-red-700' :
                      announcement.priority === 'medium' ? 'border-yellow-200 text-yellow-700' :
                      'border-gray-200 text-gray-700'
                    )}>
                      {getPriorityLabel(announcement.priority || 'low')}
                    </span>
                    <div className="flex items-center text-xs text-gray-500">
                      <Clock className="w-3 h-3 mr-1" />
                      {new Date(announcement.created_at).toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric'
                      })}
                    </div>
                  </div>
                  <h3 className="text-sm font-semibold text-gray-800 mb-1">{announcement.title}</h3>
                  <p className="text-xs text-gray-600 leading-relaxed">{announcement.content}</p>
                </div>
              ))}
            </div>
            <div className="mt-4 pt-4 border-t border-gray-200">
              <Link
                to="/announcements"
                className="block w-full text-center bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors duration-200 text-sm"
              >
                View All Announcements
              </Link>
            </div>
          </div>

        </div>

      </div>
    </div>
  );
};

export default DashboardPage;