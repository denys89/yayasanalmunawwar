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
import type { DashboardData, Student, Payment, Announcement } from '../types';
import { cn } from '../utils/cn';

interface AnnouncementItem {
  id: number;
  title: string;
  description: string;
  date: string;
  priority: 'high' | 'medium' | 'low';
}

const DashboardPage: React.FC = () => {
  const { user, logout } = useAuth();
  const [dashboardData, setDashboardData] = useState<any>(null);
  const [loading, setLoading] = useState(true);

  // Mock data - in real app this would come from API
  const studentInfo = {
    name: 'Ahmad Rizki Pratama',
    studentId: 'S2024001',
    school: 'Yayasan Al-Munawwar',
    grade: 'Kelas 7',
    class: '7A',
    status: 'Active',
    registrationStatus: 'Completed'
  };

  const announcements: AnnouncementItem[] = [
    {
      id: 1,
      title: 'Pengumuman Libur Semester',
      description: 'Libur semester akan dimulai pada tanggal 15 Desember 2024 hingga 2 Januari 2025.',
      date: '2024-12-01',
      priority: 'high'
    },
    {
      id: 2,
      title: 'Pembayaran SPP Bulan Januari',
      description: 'Reminder pembayaran SPP untuk bulan Januari 2025 paling lambat tanggal 10 Januari.',
      date: '2024-11-28',
      priority: 'medium'
    },
    {
      id: 3,
      title: 'Kegiatan Ekstrakurikuler',
      description: 'Pendaftaran ekstrakurikuler semester genap dibuka mulai 5 Januari 2025.',
      date: '2024-11-25',
      priority: 'low'
    },
    {
      id: 4,
      title: 'Rapat Orang Tua',
      description: 'Rapat orang tua akan diadakan pada tanggal 20 Januari 2025 di aula sekolah.',
      date: '2024-11-20',
      priority: 'medium'
    }
  ];

  useEffect(() => {
    // Simulate API call
    const fetchDashboardData = async () => {
      try {
        setLoading(true);
        // In real app: const response = await dashboardApi.getDashboard();
        // setDashboardData(response.data);
        setTimeout(() => {
          setLoading(false);
        }, 1000);
      } catch (error) {
        console.error('Error fetching dashboard data:', error);
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
      case 'low': return 'text-blue-700 bg-blue-50 border-blue-200';
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
        return 'bg-blue-100 text-blue-700';
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

  if (loading) {
    return (
      <div className="min-h-screen bg-gray-50 flex items-center justify-center">
        <div className="text-center">
          <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-green-600 mx-auto mb-4"></div>
          <p className="text-gray-600 font-medium">Loading dashboard...</p>
        </div>
      </div>
    );
  }

  return (
    <div className="ml-64 pt-16 px-6 pb-10 bg-gray-50 min-h-screen">
      {/* Welcome Section */}
      <div className="bg-white shadow rounded-xl p-6 border border-gray-200 mb-6">
        <div className="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
          <div className="flex-1">
            <h1 className="text-xl font-bold text-gray-800 mb-2">
              Welcome back, Budi Santoso
            </h1>
            <p className="text-sm text-gray-500 mb-4 leading-relaxed">
              Here's an overview of your child's academic progress and important updates from Yayasan Al-Munawwar.
            </p>
            <div className="flex flex-wrap gap-4 text-sm">
              <div className="flex items-center text-gray-600">
                <User className="w-4 h-4 mr-2 text-green-600" />
                <span><strong>Child:</strong> {studentInfo.name}</span>
              </div>
              <div className="flex items-center text-gray-600">
                <GraduationCap className="w-4 h-4 mr-2 text-green-600" />
                <span><strong>Grade:</strong> {studentInfo.grade}</span>
              </div>
              <div className="flex items-center text-gray-600">
                <AlertCircle className="w-4 h-4 mr-2 text-green-600" />
                <span><strong>Status:</strong> {studentInfo.registrationStatus}</span>
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
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        {/* Left Column */}
        <div className="space-y-6">
          
          {/* Student Information Card */}
          <div className="bg-white shadow rounded-xl p-6 border border-gray-200">
            <div className="flex items-center justify-between mb-4">
              <h2 className="text-lg font-semibold text-gray-800 flex items-center">
                <User className="w-5 h-5 mr-2 text-green-600" />
                Student Information
              </h2>
              <button className="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded transition-colors duration-200 flex items-center text-sm">
                <Eye className="w-4 h-4 mr-2" />
                View Full Details
              </button>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div className="space-y-3">
                <div>
                  <label className="font-medium text-gray-600 text-sm">Full Name</label>
                  <p className="text-gray-800 text-sm">{studentInfo.name}</p>
                </div>
                <div>
                  <label className="font-medium text-gray-600 text-sm">Student ID</label>
                  <p className="text-gray-800 text-sm font-mono">{studentInfo.studentId}</p>
                </div>
                <div>
                  <label className="font-medium text-gray-600 text-sm">School</label>
                  <p className="text-gray-800 text-sm">{studentInfo.school}</p>
                </div>
              </div>
              <div className="space-y-3">
                <div>
                  <label className="font-medium text-gray-600 text-sm">Grade</label>
                  <p className="text-gray-800 text-sm">{studentInfo.grade}</p>
                </div>
                <div>
                  <label className="font-medium text-gray-600 text-sm">Class</label>
                  <p className="text-gray-800 text-sm">{studentInfo.class}</p>
                </div>
                <div>
                  <label className="font-medium text-gray-600 text-sm">Status</label>
                  <span className="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    {studentInfo.status}
                  </span>
                </div>
              </div>
            </div>
          </div>

          {/* Quick Actions Card */}
          <div className="bg-white shadow rounded-xl p-6 border border-gray-200">
            <h2 className="text-lg font-semibold text-gray-800 mb-4 flex items-center">
              <FileText className="w-5 h-5 mr-2 text-green-600" />
              Quick Actions
            </h2>
            <div className="grid grid-cols-2 gap-4">
              <Link
                to="/students"
                className="bg-green-50 border border-green-200 rounded-lg p-4 text-center hover:bg-green-100 transition-colors duration-200 group"
              >
                <div className="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-green-700 transition-colors duration-200">
                  <User className="w-5 h-5 text-white" />
                </div>
                <h3 className="font-semibold text-gray-900 text-sm mb-1">View Student Data</h3>
                <p className="text-xs text-gray-600">Academic records</p>
              </Link>

              <Link
                to="/payments"
                className="bg-green-50 border border-green-200 rounded-lg p-4 text-center hover:bg-green-100 transition-colors duration-200 group"
              >
                <div className="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-green-700 transition-colors duration-200">
                  <CreditCard className="w-5 h-5 text-white" />
                </div>
                <h3 className="font-semibold text-gray-900 text-sm mb-1">Payment History</h3>
                <p className="text-xs text-gray-600">View bills</p>
              </Link>

              <Link
                to="/announcements"
                className="bg-green-50 border border-green-200 rounded-lg p-4 text-center hover:bg-green-100 transition-colors duration-200 group"
              >
                <div className="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-green-700 transition-colors duration-200">
                  <MessageCircle className="w-5 h-5 text-white" />
                </div>
                <h3 className="font-semibold text-gray-900 text-sm mb-1">Messages</h3>
                <p className="text-xs text-gray-600">School communication</p>
              </Link>

              <button
                onClick={handleLogout}
                className="bg-green-50 border border-green-200 rounded-lg p-4 text-center hover:bg-green-100 transition-colors duration-200 group"
              >
                <div className="w-10 h-10 bg-gray-500 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-gray-600 transition-colors duration-200">
                  <LogOut className="w-5 h-5 text-white" />
                </div>
                <h3 className="font-semibold text-gray-900 text-sm mb-1">Logout</h3>
                <p className="text-xs text-gray-600">Sign out</p>
              </button>
            </div>
          </div>

        </div>

        {/* Right Column */}
        <div className="space-y-6">
          
          {/* Announcements & Notices Card */}
          <div className="bg-white shadow rounded-xl p-6 border border-gray-200">
            <h2 className="text-lg font-semibold text-gray-800 mb-4 flex items-center">
              <Bell className="w-5 h-5 mr-2 text-green-600" />
              Announcements & Notices
            </h2>
            <div className="space-y-3 max-h-96 overflow-y-auto">
              {announcements.map((announcement) => (
                <div 
                  key={announcement.id} 
                  className={cn(
                    'p-3 rounded-lg border',
                    announcement.priority === 'high' ? 'bg-red-50 border-red-200' :
                    announcement.priority === 'medium' ? 'bg-yellow-50 border-yellow-200' :
                    'bg-blue-50 border-blue-200'
                  )}
                >
                  <div className="flex items-start justify-between gap-2 mb-2">
                    <span className={cn(
                      'inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium',
                      announcement.priority === 'high' ? 'bg-red-100 text-red-700' :
                      announcement.priority === 'medium' ? 'bg-yellow-100 text-yellow-700' :
                      'bg-blue-100 text-blue-700'
                    )}>
                      {getPriorityLabel(announcement.priority)}
                    </span>
                    <div className="flex items-center text-xs text-gray-500">
                      <Clock className="w-3 h-3 mr-1" />
                      {new Date(announcement.date).toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric'
                      })}
                    </div>
                  </div>
                  <h3 className="text-sm font-semibold text-gray-700 mb-1">{announcement.title}</h3>
                  <p className="text-xs text-gray-500 leading-relaxed">{announcement.description}</p>
                </div>
              ))}
            </div>
            <div className="mt-4 pt-4 border-t border-gray-200">
              <Link
                to="/announcements"
                className="block w-full text-center bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-colors duration-200 text-sm"
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