import React, { useState, useEffect } from 'react';
import { Bell, Calendar, Search, Filter, Eye, AlertTriangle, Clock, Star, MessageCircle } from 'lucide-react';
import { announcementsApi } from '../services/api';
import type { Announcement } from '../types';
import { cn } from '../utils/cn';
import { PageHeader } from '../components';

const AnnouncementsPage: React.FC = () => {
  const [announcements, setAnnouncements] = useState<Announcement[]>([]);
  const [filteredAnnouncements, setFilteredAnnouncements] = useState<Announcement[]>([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState<string>('');
  const [searchTerm, setSearchTerm] = useState('');
  const [priorityFilter, setPriorityFilter] = useState<string>('all');
  const [selectedAnnouncement, setSelectedAnnouncement] = useState<Announcement | null>(null);
  const [showAnnouncementModal, setShowAnnouncementModal] = useState(false);

  useEffect(() => {
    fetchAnnouncements();
  }, []);

  useEffect(() => {
    filterAnnouncements();
  }, [announcements, searchTerm, priorityFilter]);

  const fetchAnnouncements = async () => {
    try {
      setIsLoading(true);
      const response = await announcementsApi.getAnnouncements();
      
      if (response.data.success) {
        setAnnouncements(response.data.data);
      } else {
        setError('Failed to load announcements');
      }
    } catch (error: any) {
      setError('Failed to load announcements');
      console.error('Announcements error:', error);
    } finally {
      setIsLoading(false);
    }
  };

  const filterAnnouncements = () => {
    let filtered = announcements;

    // Filter by search term
    if (searchTerm) {
      filtered = filtered.filter(announcement => 
        announcement.title.toLowerCase().includes(searchTerm.toLowerCase()) ||
        announcement.content.toLowerCase().includes(searchTerm.toLowerCase())
      );
    }

    // Filter by priority
    if (priorityFilter !== 'all') {
      filtered = filtered.filter(announcement => announcement.priority === priorityFilter);
    }

    // Sort by date (newest first)
    filtered.sort((a, b) => new Date(b.created_at).getTime() - new Date(a.created_at).getTime());

    setFilteredAnnouncements(filtered);
  };

  const formatDate = (dateString: string): string => {
    const date = new Date(dateString);
    const now = new Date();
    const diffInHours = (now.getTime() - date.getTime()) / (1000 * 60 * 60);

    if (diffInHours < 1) {
      const diffInMinutes = Math.floor(diffInHours * 60);
      return `${diffInMinutes} minutes ago`;
    } else if (diffInHours < 24) {
      return `${Math.floor(diffInHours)} hours ago`;
    } else if (diffInHours < 48) {
      return 'Yesterday';
    } else {
      return date.toLocaleDateString('id-ID', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
      });
    }
  };

  const getPriorityBadge = (priority: string) => {
    const priorityConfig = {
      high: { 
        color: 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400', 
        label: 'High Priority',
        icon: AlertTriangle
      },
      medium: { 
        color: 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400', 
        label: 'Medium Priority',
        icon: Clock
      },
      low: { 
        color: 'bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400', 
        label: 'Low Priority',
        icon: Bell
      },
    };

    const config = priorityConfig[priority as keyof typeof priorityConfig] || priorityConfig.medium;
    const Icon = config.icon;
    
    return (
      <span className={cn('inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium', config.color)}>
        <Icon className="h-3 w-3 mr-1" />
        {config.label}
      </span>
    );
  };

  const getAnnouncementStats = () => {
    const stats = {
      total: announcements.length,
      high: announcements.filter(a => a.priority === 'high').length,
      medium: announcements.filter(a => a.priority === 'medium').length,
      low: announcements.filter(a => a.priority === 'low').length,
      unread: announcements.filter(a => !a.read_at).length,
    };
    return stats;
  };

  const handleAnnouncementClick = async (announcement: Announcement) => {
    setSelectedAnnouncement(announcement);
    setShowAnnouncementModal(true);

    // Mark as read if not already read
    if (!announcement.read_at) {
      try {
        await announcementsApi.markAsRead(announcement.id);
        // Update local state
        setAnnouncements(prev => 
          prev.map(a => 
            a.id === announcement.id 
              ? { ...a, read_at: new Date().toISOString() }
              : a
          )
        );
      } catch (error) {
        console.error('Failed to mark announcement as read:', error);
      }
    }
  };

  const stats = getAnnouncementStats();

  if (isLoading) {
    return (
      <div className="space-y-6">
        <div className="animate-pulse">
          <div className="h-8 bg-gray-200 dark:bg-gray-700 rounded w-1/4 mb-6"></div>
          <div className="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            {[...Array(4)].map((_, i) => (
              <div key={i} className="card p-6">
                <div className="h-4 bg-gray-200 dark:bg-gray-700 rounded w-3/4 mb-2"></div>
                <div className="h-8 bg-gray-200 dark:bg-gray-700 rounded w-1/2 mb-4"></div>
                <div className="h-3 bg-gray-200 dark:bg-gray-700 rounded w-full"></div>
              </div>
            ))}
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
          <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-2">Failed to Load Announcements</h3>
          <p className="text-gray-600 dark:text-gray-400 mb-4">{error}</p>
          <button
            onClick={fetchAnnouncements}
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
        title="Announcements"
        description="Stay updated with the latest information from the school."
      />

      {/* Stats Cards */}
      <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div className="card p-6">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <Bell className="h-8 w-8 text-blue-600 dark:text-blue-400" />
            </div>
            <div className="ml-4">
              <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                Total Announcements
              </p>
              <p className="text-2xl font-bold text-gray-900 dark:text-white">
                {stats.total}
              </p>
            </div>
          </div>
        </div>

        <div className="card p-6">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <AlertTriangle className="h-8 w-8 text-red-600 dark:text-red-400" />
            </div>
            <div className="ml-4">
              <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                High Priority
              </p>
              <p className="text-2xl font-bold text-gray-900 dark:text-white">
                {stats.high}
              </p>
            </div>
          </div>
        </div>

        <div className="card p-6">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <Clock className="h-8 w-8 text-yellow-600 dark:text-yellow-400" />
            </div>
            <div className="ml-4">
              <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                Medium Priority
              </p>
              <p className="text-2xl font-bold text-gray-900 dark:text-white">
                {stats.medium}
              </p>
            </div>
          </div>
        </div>

        <div className="card p-6">
          <div className="flex items-center">
            <div className="flex-shrink-0">
              <Star className="h-8 w-8 text-green-600 dark:text-green-400" />
            </div>
            <div className="ml-4">
              <p className="text-sm font-medium text-gray-600 dark:text-gray-400">
                Unread
              </p>
              <p className="text-2xl font-bold text-gray-900 dark:text-white">
                {stats.unread}
              </p>
            </div>
          </div>
        </div>
      </div>

      {/* Filters and Search */}
      <div className="card p-6">
        <div className="flex flex-col sm:flex-row gap-4">
          <div className="flex-1">
            <div className="relative">
              <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400" />
              <input
                type="text"
                placeholder="Search announcements..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="input pl-10"
              />
            </div>
          </div>
          <div className="flex gap-2">
            <select
              value={priorityFilter}
              onChange={(e) => setPriorityFilter(e.target.value)}
              className="input"
            >
              <option value="all">All Priorities</option>
              <option value="high">High Priority</option>
              <option value="medium">Medium Priority</option>
              <option value="low">Low Priority</option>
            </select>
          </div>
        </div>
      </div>

      {/* Announcements List */}
      <div className="space-y-4">
        {filteredAnnouncements.length === 0 ? (
          <div className="card p-8">
            <div className="text-center">
              <Bell className="h-12 w-12 text-gray-400 mx-auto mb-4" />
              <h3 className="text-lg font-medium text-gray-900 dark:text-white mb-2">No Announcements Found</h3>
              <p className="text-gray-600 dark:text-gray-400">
                {searchTerm || priorityFilter !== 'all' 
                  ? 'Try adjusting your search or filter criteria.'
                  : 'No announcements available at the moment.'}
              </p>
            </div>
          </div>
        ) : (
          filteredAnnouncements.map((announcement) => (
            <div 
              key={announcement.id} 
              className={cn(
                'card p-6 cursor-pointer hover:shadow-md transition-shadow',
                !announcement.read_at && 'border-l-4 border-primary-500 bg-primary-50/50 dark:bg-primary-900/10'
              )}
              onClick={() => handleAnnouncementClick(announcement)}
            >
              <div className="flex items-start justify-between">
                <div className="flex-1">
                  <div className="flex items-center space-x-3 mb-2">
                    <h3 className={cn(
                      'text-lg font-medium',
                      !announcement.read_at 
                        ? 'text-gray-900 dark:text-white font-semibold' 
                        : 'text-gray-700 dark:text-gray-300'
                    )}>
                      {announcement.title}
                    </h3>
                    {!announcement.read_at && (
                      <span className="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800 dark:bg-primary-900/20 dark:text-primary-400">
                        New
                      </span>
                    )}
                  </div>
                  
                  <p className="text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                    {announcement.content}
                  </p>
                  
                  <div className="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                    <div className="flex items-center">
                      <Calendar className="h-4 w-4 mr-1" />
                      {formatDate(announcement.created_at)}
                    </div>
                    {announcement.author && (
                      <div className="flex items-center">
                        <MessageCircle className="h-4 w-4 mr-1" />
                        By {announcement.author}
                      </div>
                    )}
                  </div>
                </div>
                
                <div className="flex flex-col items-end space-y-2 ml-4">
                  {getPriorityBadge(announcement.priority)}
                  <button className="btn btn-secondary btn-sm">
                    <Eye className="h-4 w-4 mr-1" />
                    Read More
                  </button>
                </div>
              </div>
            </div>
          ))
        )}
      </div>

      {/* Announcement Detail Modal */}
      {showAnnouncementModal && selectedAnnouncement && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
          <div className="bg-white dark:bg-gray-800 rounded-lg max-w-2xl w-full max-h-[80vh] overflow-y-auto">
            <div className="p-6">
              <div className="flex items-start justify-between mb-4">
                <div className="flex-1">
                  <h2 className="text-xl font-bold text-gray-900 dark:text-white mb-2">
                    {selectedAnnouncement.title}
                  </h2>
                  <div className="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400 mb-4">
                    <div className="flex items-center">
                      <Calendar className="h-4 w-4 mr-1" />
                      {formatDate(selectedAnnouncement.created_at)}
                    </div>
                    {selectedAnnouncement.author && (
                      <div className="flex items-center">
                        <MessageCircle className="h-4 w-4 mr-1" />
                        By {selectedAnnouncement.author}
                      </div>
                    )}
                  </div>
                  {getPriorityBadge(selectedAnnouncement.priority)}
                </div>
                <button
                  onClick={() => setShowAnnouncementModal(false)}
                  className="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 ml-4"
                >
                  <svg className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
              
              <div className="prose dark:prose-invert max-w-none">
                <div className="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">
                  {selectedAnnouncement.content}
                </div>
              </div>
              
              {selectedAnnouncement.attachments && selectedAnnouncement.attachments.length > 0 && (
                <div className="mt-6">
                  <h4 className="text-sm font-medium text-gray-900 dark:text-white mb-2">Attachments</h4>
                  <div className="space-y-2">
                    {selectedAnnouncement.attachments.map((attachment, index) => (
                      <a
                        key={index}
                        href={attachment.url}
                        target="_blank"
                        rel="noopener noreferrer"
                        className="flex items-center p-2 bg-gray-50 dark:bg-gray-700 rounded hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors"
                      >
                        <svg className="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                        <span className="text-sm text-gray-700 dark:text-gray-300">{attachment.name}</span>
                      </a>
                    ))}
                  </div>
                </div>
              )}
              
              <div className="flex justify-end mt-6">
                <button
                  onClick={() => setShowAnnouncementModal(false)}
                  className="btn btn-primary"
                >
                  Close
                </button>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default AnnouncementsPage;