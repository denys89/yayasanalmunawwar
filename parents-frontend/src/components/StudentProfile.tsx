import React from 'react';
import { User, Phone, Mail, MapPin, Calendar, GraduationCap, Edit, MessageCircle } from 'lucide-react';

interface StudentData {
  name: string;
  studentId: string;
  class: string;
  level: string;
  program: string;
  email: string;
  phone: string;
  address: string;
  enrollmentDate: string;
  avatar?: string;
}

const StudentProfile: React.FC = () => {
  // Mock data - in real app this would come from props or API
  const student: StudentData = {
    name: 'Den Bagus',
    studentId: 'S5778017',
    class: 'Kelas 7 - Regular',
    level: 'INSAN CENDEKIA MADANI MIDDLE SCHOOL PROGRAM',
    program: 'Regular Program',
    email: 'den.bagus@example.com',
    phone: '+62 812-3456-7890',
    address: 'Jakarta, Indonesia',
    enrollmentDate: '2024-01-15'
  };

  return (
    <div className="bg-white dark:bg-gray-900 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 sm:p-6">
      <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h2 className="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">
          {student.name}
        </h2>
        <div className="flex items-center gap-2">
          <button className="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200 dark:hover:bg-blue-900/20 dark:hover:text-blue-400">
            <MessageCircle className="h-4 w-4" />
          </button>
          <button className="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200 dark:hover:bg-blue-900/20 dark:hover:text-blue-400">
            <Edit className="h-4 w-4" />
          </button>
        </div>
      </div>

      {/* Avatar and Basic Info */}
      <div className="flex flex-col sm:flex-row items-center sm:items-start gap-4 mb-6">
        <div className="flex-shrink-0">
          <div className="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
            <span className="text-xl sm:text-2xl font-bold text-white">
              {student.name.split(' ').map(n => n[0]).join('')}
            </span>
          </div>
        </div>
        <div className="flex-1 text-center sm:text-left">
          <h3 className="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">
            {student.name}
          </h3>
          <p className="text-sm text-blue-600 dark:text-blue-400 font-medium">
            {student.studentId}
          </p>
          <p className="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">
            {student.class}
          </p>
        </div>
      </div>

      {/* Student Details */}
      <div className="space-y-4">
        <div className="bg-gray-50 dark:bg-gray-800 rounded-lg p-3 sm:p-4">
          <h4 className="text-sm font-medium text-gray-900 dark:text-white mb-3">
            Informasi Program
          </h4>
          <div className="space-y-2">
            <div className="flex items-start gap-3">
              <GraduationCap className="h-4 w-4 text-gray-400 mt-0.5 flex-shrink-0" />
              <div className="flex-1 min-w-0">
                <p className="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Level</p>
                <p className="text-xs sm:text-sm font-medium text-gray-900 dark:text-white break-words">
                  {student.level}
                </p>
              </div>
            </div>
          </div>
        </div>

        <div className="bg-gray-50 dark:bg-gray-800 rounded-lg p-3 sm:p-4">
          <h4 className="text-sm font-medium text-gray-900 dark:text-white mb-3">
            Kontak Informasi
          </h4>
          <div className="space-y-3">
            <div className="flex items-center gap-3">
              <Mail className="h-4 w-4 text-gray-400 flex-shrink-0" />
              <div className="flex-1 min-w-0">
                <p className="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Email</p>
                <p className="text-xs sm:text-sm font-medium text-gray-900 dark:text-white truncate">
                  {student.email}
                </p>
              </div>
            </div>
            
            <div className="flex items-center gap-3">
              <Phone className="h-4 w-4 text-gray-400 flex-shrink-0" />
              <div className="flex-1 min-w-0">
                <p className="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Nomor Handphone</p>
                <p className="text-xs sm:text-sm font-medium text-gray-900 dark:text-white">
                  {student.phone}
                </p>
              </div>
            </div>
            
            <div className="flex items-start gap-3">
              <MapPin className="h-4 w-4 text-gray-400 mt-0.5 flex-shrink-0" />
              <div className="flex-1 min-w-0">
                <p className="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Alamat</p>
                <p className="text-xs sm:text-sm font-medium text-gray-900 dark:text-white">
                  {student.address}
                </p>
              </div>
            </div>
          </div>
        </div>

        <div className="bg-gray-50 dark:bg-gray-800 rounded-lg p-3 sm:p-4">
          <h4 className="text-sm font-medium text-gray-900 dark:text-white mb-3">
            Informasi Tambahan
          </h4>
          <div className="flex items-center gap-3">
            <Calendar className="h-4 w-4 text-gray-400 flex-shrink-0" />
            <div className="flex-1 min-w-0">
              <p className="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Tanggal Pendaftaran</p>
              <p className="text-xs sm:text-sm font-medium text-gray-900 dark:text-white">
                {new Date(student.enrollmentDate).toLocaleDateString('id-ID', {
                  year: 'numeric',
                  month: 'long',
                  day: 'numeric'
                })}
              </p>
            </div>
          </div>
        </div>
      </div>

      {/* Action Buttons */}
      <div className="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
        <div className="flex flex-col sm:flex-row gap-2 sm:gap-3">
          <button className="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2 text-sm">
            <Edit className="h-4 w-4" />
            Edit Profile
          </button>
          <button className="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-300 px-4 py-2.5 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2 text-sm">
            <MessageCircle className="h-4 w-4" />
            Contact
          </button>
        </div>
      </div>
    </div>
  );
};

export default StudentProfile;