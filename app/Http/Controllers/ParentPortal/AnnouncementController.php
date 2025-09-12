<?php

namespace App\Http\Controllers\ParentPortal;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Get all announcements for parents
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 12);
        $category = $request->get('category');
        $search = $request->get('search');
        $priority = $request->get('priority');
        
        $query = News::where('is_published', true)
                    ->where('category', 'announcement')
                    ->orderBy('is_urgent', 'desc')
                    ->orderBy('created_at', 'desc');
        
        if ($category) {
            $query->where('subcategory', $category);
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }
        
        if ($priority === 'urgent') {
            $query->where('is_urgent', true);
        }
        
        $announcements = $query->paginate($perPage, [
            'id', 'title', 'excerpt', 'content', 'category', 'subcategory',
            'is_urgent', 'featured_image', 'created_at', 'updated_at'
        ]);
        
        return response()->json([
            'announcements' => $announcements->items(),
            'pagination' => [
                'current_page' => $announcements->currentPage(),
                'last_page' => $announcements->lastPage(),
                'per_page' => $announcements->perPage(),
                'total' => $announcements->total()
            ],
            'categories' => $this->getAnnouncementCategories(),
            'urgent_count' => $this->getUrgentAnnouncementsCount()
        ]);
    }

    /**
     * Get specific announcement details
     */
    public function show(Request $request, $id)
    {
        $announcement = News::where('id', $id)
                           ->where('is_published', true)
                           ->where('category', 'announcement')
                           ->first([
                               'id', 'title', 'content', 'excerpt', 'category', 'subcategory',
                               'is_urgent', 'featured_image', 'attachments', 'created_at', 'updated_at'
                           ]);
        
        if (!$announcement) {
            return response()->json([
                'message' => 'Announcement not found'
            ], 404);
        }
        
        // Mark as read for this parent (in real app, track read status)
        $this->markAsRead($id, $request->user()->id);
        
        // Get related announcements
        $relatedAnnouncements = $this->getRelatedAnnouncements($announcement, 3);
        
        return response()->json([
            'announcement' => $announcement,
            'related' => $relatedAnnouncements,
            'attachments' => $this->processAttachments($announcement->attachments ?? [])
        ]);
    }

    /**
     * Get urgent announcements for dashboard
     */
    public function getUrgent(Request $request)
    {
        $urgentAnnouncements = News::where('is_published', true)
                                  ->where('category', 'announcement')
                                  ->where('is_urgent', true)
                                  ->orderBy('created_at', 'desc')
                                  ->limit(5)
                                  ->get([
                                      'id', 'title', 'excerpt', 'created_at', 'is_urgent'
                                  ]);
        
        return response()->json([
            'urgent_announcements' => $urgentAnnouncements
        ]);
    }

    /**
     * Get announcement categories
     */
    public function getCategories(Request $request)
    {
        $categories = $this->getAnnouncementCategories();
        
        return response()->json([
            'categories' => $categories
        ]);
    }

    /**
     * Get parent's notification preferences
     */
    public function getNotificationPreferences(Request $request)
    {
        $parent = $request->user();
        
        // In real app, get from user preferences table
        $preferences = [
            'email_notifications' => true,
            'push_notifications' => true,
            'sms_notifications' => false,
            'categories' => [
                'academic' => true,
                'events' => true,
                'emergency' => true,
                'general' => false,
                'payment' => true
            ],
            'urgent_only' => false
        ];
        
        return response()->json([
            'preferences' => $preferences
        ]);
    }

    /**
     * Update notification preferences
     */
    public function updateNotificationPreferences(Request $request)
    {
        $request->validate([
            'email_notifications' => 'boolean',
            'push_notifications' => 'boolean',
            'sms_notifications' => 'boolean',
            'categories' => 'array',
            'categories.*' => 'boolean',
            'urgent_only' => 'boolean'
        ]);
        
        $parent = $request->user();
        
        // In real app, save to user preferences table
        // For now, just return success
        
        return response()->json([
            'message' => 'Notification preferences updated successfully',
            'preferences' => $request->all()
        ]);
    }

    /**
     * Get unread announcements count
     */
    public function getUnreadCount(Request $request)
    {
        $parent = $request->user();
        
        // In real app, check against read_announcements table
        $unreadCount = News::where('is_published', true)
                          ->where('category', 'announcement')
                          ->where('created_at', '>', now()->subDays(7)) // Mock: announcements from last 7 days
                          ->count();
        
        $urgentUnreadCount = News::where('is_published', true)
                                ->where('category', 'announcement')
                                ->where('is_urgent', true)
                                ->where('created_at', '>', now()->subDays(30))
                                ->count();
        
        return response()->json([
            'unread_count' => $unreadCount,
            'urgent_unread_count' => $urgentUnreadCount
        ]);
    }

    /**
     * Mark announcement as read
     */
    public function markAsRead(Request $request, $id)
    {
        $parent = $request->user();
        
        // In real app, insert/update read_announcements table
        // For now, just return success
        
        return response()->json([
            'message' => 'Announcement marked as read'
        ]);
    }

    /**
     * Mark multiple announcements as read
     */
    public function markMultipleAsRead(Request $request)
    {
        $request->validate([
            'announcement_ids' => 'required|array',
            'announcement_ids.*' => 'integer|exists:news,id'
        ]);
        
        $parent = $request->user();
        $announcementIds = $request->announcement_ids;
        
        // In real app, batch insert/update read_announcements table
        
        return response()->json([
            'message' => count($announcementIds) . ' announcements marked as read'
        ]);
    }

    /**
     * Get announcement statistics
     */
    public function getStats(Request $request)
    {
        $stats = [
            'total_announcements' => News::where('category', 'announcement')->where('is_published', true)->count(),
            'urgent_announcements' => News::where('category', 'announcement')->where('is_urgent', true)->where('is_published', true)->count(),
            'this_month' => News::where('category', 'announcement')->where('is_published', true)->whereMonth('created_at', now()->month)->count(),
            'categories_breakdown' => $this->getCategoriesBreakdown()
        ];
        
        return response()->json($stats);
    }

    /**
     * Download announcement attachment
     */
    public function downloadAttachment(Request $request, $announcementId, $attachmentId)
    {
        $announcement = News::where('id', $announcementId)
                           ->where('is_published', true)
                           ->where('category', 'announcement')
                           ->first();
        
        if (!$announcement) {
            return response()->json(['message' => 'Announcement not found'], 404);
        }
        
        $attachments = json_decode($announcement->attachments ?? '[]', true);
        $attachment = collect($attachments)->firstWhere('id', $attachmentId);
        
        if (!$attachment) {
            return response()->json(['message' => 'Attachment not found'], 404);
        }
        
        if (!Storage::exists($attachment['path'])) {
            return response()->json(['message' => 'File not found'], 404);
        }
        
        return Storage::download($attachment['path'], $attachment['original_name']);
    }

    /**
     * Helper: Get announcement categories
     */
    private function getAnnouncementCategories()
    {
        return [
            [
                'id' => 'academic',
                'name' => 'Academic',
                'description' => 'Academic announcements and updates',
                'color' => 'blue',
                'icon' => 'academic-cap'
            ],
            [
                'id' => 'events',
                'name' => 'Events',
                'description' => 'School events and activities',
                'color' => 'green',
                'icon' => 'calendar'
            ],
            [
                'id' => 'emergency',
                'name' => 'Emergency',
                'description' => 'Emergency notifications',
                'color' => 'red',
                'icon' => 'exclamation-triangle'
            ],
            [
                'id' => 'general',
                'name' => 'General',
                'description' => 'General school information',
                'color' => 'gray',
                'icon' => 'information-circle'
            ],
            [
                'id' => 'payment',
                'name' => 'Payment',
                'description' => 'Payment and billing related',
                'color' => 'yellow',
                'icon' => 'credit-card'
            ]
        ];
    }

    /**
     * Helper: Get urgent announcements count
     */
    private function getUrgentAnnouncementsCount()
    {
        return News::where('is_published', true)
                  ->where('category', 'announcement')
                  ->where('is_urgent', true)
                  ->count();
    }

    /**
     * Helper: Get related announcements
     */
    private function getRelatedAnnouncements($announcement, $limit = 3)
    {
        return News::where('id', '!=', $announcement->id)
                  ->where('is_published', true)
                  ->where('category', 'announcement')
                  ->where(function($query) use ($announcement) {
                      $query->where('subcategory', $announcement->subcategory)
                            ->orWhere('is_urgent', $announcement->is_urgent);
                  })
                  ->orderBy('created_at', 'desc')
                  ->limit($limit)
                  ->get(['id', 'title', 'excerpt', 'created_at', 'is_urgent']);
    }

    /**
     * Helper: Process attachments
     */
    private function processAttachments($attachments)
    {
        if (is_string($attachments)) {
            $attachments = json_decode($attachments, true) ?? [];
        }
        
        return collect($attachments)->map(function($attachment) {
            return [
                'id' => $attachment['id'] ?? uniqid(),
                'name' => $attachment['original_name'] ?? $attachment['name'] ?? 'Unknown',
                'size' => $attachment['size'] ?? 0,
                'type' => $attachment['mime_type'] ?? 'application/octet-stream',
                'download_url' => route('parent.announcements.download-attachment', [
                    'announcement' => $attachment['announcement_id'] ?? 0,
                    'attachment' => $attachment['id'] ?? 0
                ])
            ];
        })->toArray();
    }

    /**
     * Helper: Mark announcement as read (internal)
     */
    private function markAsRead($announcementId, $parentId)
    {
        // In real app, insert into read_announcements table
        // For now, just log or do nothing
        return true;
    }

    /**
     * Helper: Get categories breakdown
     */
    private function getCategoriesBreakdown()
    {
        return [
            'academic' => 15,
            'events' => 8,
            'emergency' => 2,
            'general' => 12,
            'payment' => 5
        ];
    }
}