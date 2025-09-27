import React, { useState, useEffect } from 'react';
import { User, Calendar, BookOpen, Award, Clock, TrendingUp, AlertTriangle, Eye, Download } from 'lucide-react';
import { studentsApi } from '../services/api';
import type { Student, Attendance, Grade } from '../types';
import { cn } from '../utils/cn';
import { PageHeader } from '../components';

const StudentsPage: React.FC = () => {
  const [students, setStudents] = useState<Student[]>([]);
  const [selectedStudent, setSelectedStudent] = useState<Student | null>(null);
  const [activeTab, setActiveTab] = useState<'profile' | 'attendance' | 'grades'>('profile');
  const [attendanceData, setAttendanceData] = useState<Attendance[]>([]);
  const [gradesData, setGradesData] = useState<Grade[]>([]);
  const [isLoading, setIsLoading] = useState(true);
  const [isLoadingDetails, setIsLoadingDetails] = useState(false);
  const [error, setError] = useState<string>('');

  useEffect(() => {
    fetchStudents();
  }, []);

  useEffect(() => {
    if (selectedStudent) {
      fetchStudentDetails(selectedStudent.id);
    }
  }, [selectedStudent, activeTab]);

  const fetchStudents = async () => {
    try {
      setIsLoading(true);
      const response = await studentsApi.getStudents();
      
      if (response.data.success) {
        setStudents(response.data.data);
        if (response.data.data.length > 0) {
          setSelectedStudent(response.data.data[0]);
        }
      } else {
        setError('Failed to load students data');
      }
    } catch (error: any) {
      setError('Failed to load students data');
      console.error('Students error:', error);
    } finally {
      setIsLoading(false);
    }
  };

  const fetchStudentDetails = async (studentId: number) => {
    try {
      setIsLoadingDetails(true);
      
      if (activeTab === 'attendance') {
        const response = await studentsApi.getAttendance(studentId);
        if (response.data.success) {
          setAttendanceData(response.data.data);
        }
      } else if (activeTab === 'grades') {
        const response = await studentsApi.getGrades(studentId);
        if (response.data.success) {
          setGradesData(response.data.data);
        }
      }
    } catch (error: any) {
      console.error('Student details error:', error);
    } finally {
      setIsLoadingDetails(false);
    }
  };

  const formatDate = (dateString: string): string => {
    return new Date(dateString).toLocaleDateString('id-ID', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
    });
  };

  const getAttendanceStatusBadge = (status: string) => {
    const statusConfig = {
      present: { color: 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400', label: 'Present' },
      absent: { color: 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400', label: 'Absent' },
      late: { color: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400', label: 'Late' },
      excused: { color: 'bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400', label: 'Excused' },
    };

    const config = statusConfig[status as keyof typeof statusConfig] || statusConfig.absent;
    
    return (
      <span className={cn('inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium', config.color)}>
        {config.label}
      </span>
    );
  };

  const getGradeBadge = (score: number) => {
    let color = 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400';
    let grade = 'A';
    
    if (score < 60) {
      color = 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400';
      grade = 'D';
    } else if (score < 70) {
      color = 'bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-400';
      grade = 'C';
    } else if (score < 85) {
      color = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400';
      grade = 'B';
    }
    
    return (
      <span className={cn('inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium', color)}>
        {grade} ({score})
      </span>
    );
  };

  const tabs = [
    { id: 'profile', label: 'Profile', icon: User },
    { id: 'attendance', label: 'Attendance', icon: Calendar },
    { id: 'grades', label: 'Grades', icon: BookOpen },
  ] as const;

  if (isLoading) {
    return (
      <div className="space-y-6">
        <div className="animate-pulse">
          <div className="h-8 bg-gray-200 dark:bg-gray-700 rounded w-1/4 mb-6"></div>
          <div className="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <div className="lg:col-span-1">
              <div className="card p-4">
                {[...Array(3)].map((_, i) => (
                  <div key={i} className="h-16 bg-gray-200 dark:bg-gray-700 rounded mb-3"></div>
                ))}
              </div>
            </div>
            <div className="lg:col-span-3">
              <div className="card p-6">
                <div className="h-6 bg-gray-200 dark:bg-gray-700 rounded w-1/3 mb-4"></div>
                <div className="space-y-3">
                  {[...Array(5)].map((_, i) => (
                    <div key={i} className="h-4 bg-gray-200 dark:bg-gray-700 rounded"></div>
                  ))}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="flex items-center justify-center min-h-[400px]">
        <div className="text-center">
          <AlertTriangle className="h-12 w-12 text-red-500 mx-auto mb-4" />
          <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-2">Failed to Load Students</h3>
          <p className="text-gray-600 dark:text-gray-400 mb-4">{error}</p>
          <button
            onClick={fetchStudents}
            className="btn btn-primary"
          >
            Try Again
          </button>
        </div>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      {/* Header */}
      <PageHeader
        title="Students"
        description="Manage and view your children's academic information, attendance, and grades."
      />

      <div className="grid grid-cols-1 lg:grid-cols-4 gap-6">
        {/* Students List */}
        <div className="lg:col-span-1">
          <div className="card p-4">
            <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-4">
              Your Children
            </h3>
            <div className="space-y-2">
              {students.map((student) => (
                <button
                  key={student.id}
                  onClick={() => setSelectedStudent(student)}
                  className={cn(
                    'w-full text-left p-3 rounded-lg transition-colors',
                    selectedStudent?.id === student.id
                      ? 'bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800'
                      : 'hover:bg-gray-50 dark:hover:bg-gray-800'
                  )}
                >
                  <div className="flex items-center space-x-3">
                    <div className="flex-shrink-0">
                      <div className="h-10 w-10 rounded-full bg-primary-100 dark:bg-primary-900/20 flex items-center justify-center">
                        <span className="text-sm font-medium text-primary-600 dark:text-primary-400">
                          {student.name.charAt(0).toUpperCase()}
                        </span>
                      </div>
                    </div>
                    <div className="flex-1 min-w-0">
                      <p className="text-sm font-medium text-gray-900 dark:text-white truncate">
                        {student.name}
                      </p>
                      <p className="text-xs text-gray-500 dark:text-gray-400">
                        {student.class} • {student.student_id}
                      </p>
                    </div>
                  </div>
                </button>
              ))}
            </div>
          </div>
        </div>

        {/* Student Details */}
        <div className="lg:col-span-3">
          {selectedStudent && (
            <div className="card p-6">
              {/* Student Header */}
              <div className="flex items-center justify-between mb-6">
                <div className="flex items-center space-x-4">
                  <div className="h-16 w-16 rounded-full bg-primary-100 dark:bg-primary-900/20 flex items-center justify-center">
                    <span className="text-xl font-medium text-primary-600 dark:text-primary-400">
                      {selectedStudent.name.charAt(0).toUpperCase()}
                    </span>
                  </div>
                  <div>
                    <h2 className="text-xl font-bold text-gray-900 dark:text-white">
                      {selectedStudent.name}
                    </h2>
                    <p className="text-gray-600 dark:text-gray-400">
                      {selectedStudent.class} • Student ID: {selectedStudent.student_id}
                    </p>
                  </div>
                </div>
                <div className="flex items-center space-x-2">
                  <span className="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                    <Clock className="h-4 w-4 mr-1" />
                    {selectedStudent.attendance_percentage}% Attendance
                  </span>
                </div>
              </div>

              {/* Tabs */}
              <div className="border-b border-gray-200 dark:border-gray-700 mb-6">
                <nav className="-mb-px flex space-x-8">
                  {tabs.map((tab) => {
                    const Icon = tab.icon;
                    return (
                      <button
                        key={tab.id}
                        onClick={() => setActiveTab(tab.id)}
                        className={cn(
                          'flex items-center py-2 px-1 border-b-2 font-medium text-sm',
                          activeTab === tab.id
                            ? 'border-primary-500 text-primary-600 dark:text-primary-400'
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'
                        )}
                      >
                        <Icon className="h-4 w-4 mr-2" />
                        {tab.label}
                      </button>
                    );
                  })}
                </nav>
              </div>

              {/* Tab Content */}
              <div className="min-h-[400px]">
                {activeTab === 'profile' && (
                  <div className="space-y-6">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                      <div>
                        <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-4">
                          Personal Information
                        </h3>
                        <dl className="space-y-3">
                          <div>
                            <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</dt>
                            <dd className="text-sm text-gray-900 dark:text-white">{selectedStudent.name}</dd>
                          </div>
                          <div>
                            <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Student ID</dt>
                            <dd className="text-sm text-gray-900 dark:text-white">{selectedStudent.student_id}</dd>
                          </div>
                          <div>
                            <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Class</dt>
                            <dd className="text-sm text-gray-900 dark:text-white">{selectedStudent.class}</dd>
                          </div>
                          <div>
                            <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Date of Birth</dt>
                            <dd className="text-sm text-gray-900 dark:text-white">{formatDate(selectedStudent.date_of_birth)}</dd>
                          </div>
                          <div>
                            <dt className="text-sm font-medium text-gray-500 dark:text-gray-400">Gender</dt>
                            <dd className="text-sm text-gray-900 dark:text-white capitalize">{selectedStudent.gender}</dd>
                          </div>
                        </dl>
                      </div>
                      
                      <div>
                        <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-4">
                          Academic Summary
                        </h3>
                        <div className="space-y-4">
                          <div className="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                            <div className="flex items-center justify-between">
                              <span className="text-sm font-medium text-gray-600 dark:text-gray-400">Attendance Rate</span>
                              <span className="text-lg font-bold text-gray-900 dark:text-white">{selectedStudent.attendance_percentage}%</span>
                            </div>
                            <div className="mt-2 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                              <div 
                                className="bg-primary-600 h-2 rounded-full" 
                                style={{ width: `${selectedStudent.attendance_percentage}%` }}
                              ></div>
                            </div>
                          </div>
                          
                          <div className="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                            <div className="flex items-center justify-between">
                              <span className="text-sm font-medium text-gray-600 dark:text-gray-400">Average Grade</span>
                              <span className="text-lg font-bold text-gray-900 dark:text-white">{selectedStudent.average_grade || 'N/A'}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                )}

                {activeTab === 'attendance' && (
                  <div className="space-y-4">
                    <div className="flex items-center justify-between">
                      <h3 className="text-lg font-medium text-gray-900 dark:text-white">
                        Attendance Records
                      </h3>
                      <button className="btn btn-secondary btn-sm">
                        <Download className="h-4 w-4 mr-2" />
                        Export
                      </button>
                    </div>
                    
                    {isLoadingDetails ? (
                      <div className="space-y-3">
                        {[...Array(5)].map((_, i) => (
                          <div key={i} className="h-16 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        ))}
                      </div>
                    ) : (
                      <div className="space-y-3">
                        {attendanceData.map((record) => (
                          <div key={record.id} className="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div className="flex items-center space-x-4">
                              <Calendar className="h-5 w-5 text-gray-400" />
                              <div>
                                <p className="text-sm font-medium text-gray-900 dark:text-white">
                                  {formatDate(record.date)}
                                </p>
                                <p className="text-xs text-gray-500 dark:text-gray-400">
                                  {record.subject || 'General'}
                                </p>
                              </div>
                            </div>
                            <div className="flex items-center space-x-3">
                              {record.check_in_time && (
                                <span className="text-xs text-gray-500 dark:text-gray-400">
                                  In: {record.check_in_time}
                                </span>
                              )}
                              {getAttendanceStatusBadge(record.status)}
                            </div>
                          </div>
                        ))}
                      </div>
                    )}
                  </div>
                )}

                {activeTab === 'grades' && (
                  <div className="space-y-4">
                    <div className="flex items-center justify-between">
                      <h3 className="text-lg font-medium text-gray-900 dark:text-white">
                        Grade Reports
                      </h3>
                      <button className="btn btn-secondary btn-sm">
                        <Download className="h-4 w-4 mr-2" />
                        Download Report
                      </button>
                    </div>
                    
                    {isLoadingDetails ? (
                      <div className="space-y-3">
                        {[...Array(5)].map((_, i) => (
                          <div key={i} className="h-16 bg-gray-200 dark:bg-gray-700 rounded animate-pulse"></div>
                        ))}
                      </div>
                    ) : (
                      <div className="space-y-3">
                        {gradesData.map((grade) => (
                          <div key={grade.id} className="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                            <div className="flex items-center space-x-4">
                              <BookOpen className="h-5 w-5 text-gray-400" />
                              <div>
                                <p className="text-sm font-medium text-gray-900 dark:text-white">
                                  {grade.subject}
                                </p>
                                <p className="text-xs text-gray-500 dark:text-gray-400">
                                  {grade.exam_type} • {formatDate(grade.date)}
                                </p>
                              </div>
                            </div>
                            <div className="flex items-center space-x-3">
                              <span className="text-sm font-medium text-gray-900 dark:text-white">
                                {grade.score}/100
                              </span>
                              {getGradeBadge(grade.score)}
                            </div>
                          </div>
                        ))}
                      </div>
                    )}
                  </div>
                )}
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default StudentsPage;