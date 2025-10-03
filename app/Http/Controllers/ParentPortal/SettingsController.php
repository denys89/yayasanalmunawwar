<?php

namespace App\Http\Controllers\ParentPortal;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller
{
    /**
     * Get parent profile information
     */
    public function getProfile(Request $request)
    {
        $parent = $request->user();
        
        $profile = [
            'id' => $parent->id,
            'name' => $parent->name,
            'email' => $parent->email,
            'phone' => $parent->phone ?? '',
            'address' => $parent->address ?? '',
            'emergency_contact' => $parent->emergency_contact ?? '',
            'profile_photo' => $parent->profile_photo ?? null,
            'notification_preferences' => $this->getNotificationPreferencesData($parent->id),
            'students' => $this->getParentStudents($parent->id),
            'account_info' => [
                'created_at' => $parent->created_at,
                'last_login' => $parent->last_login_at ?? null,
                'email_verified_at' => $parent->email_verified_at,
                'is_active' => $parent->is_active
            ]
        ];
        
        return response()->json([
            'profile' => $profile
        ]);
    }

    /**
     * Update parent profile
     */
    public function updateProfile(Request $request)
    {
        $parent = $request->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'emergency_contact' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $updateData = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'emergency_contact' => $request->emergency_contact
        ];
        
        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($parent->profile_photo) {
                Storage::delete($parent->profile_photo);
            }
            
            $photoPath = $request->file('profile_photo')->store('profile-photos', 'public');
            $updateData['profile_photo'] = $photoPath;
        }
        
        $parent->update($updateData);
        
        return response()->json([
            'message' => 'Profile updated successfully',
            'profile' => $parent->fresh()
        ]);
    }

    /**
     * Change password
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        
        $parent = $request->user();
        
        if (!Hash::check($request->current_password, $parent->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }
        
        $parent->update([
            'password' => Hash::make($request->password)
        ]);
        
        return response()->json([
            'message' => 'Password changed successfully'
        ]);
    }

    /**
     * Get notification preferences
     */
    public function getNotificationPreferences(Request $request)
    {
        $parent = $request->user();
        $preferences = $this->getNotificationPreferencesData($parent->id);
        
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
            'sms_notifications' => 'boolean',
            'push_notifications' => 'boolean',
            'announcement_notifications' => 'boolean',
            'payment_reminders' => 'boolean',
            'attendance_alerts' => 'boolean',
            'grade_updates' => 'boolean',
            'emergency_alerts' => 'boolean'
        ]);
        
        $parent = $request->user();
        
        // In real app, save to user_notification_preferences table
        // For now, simulate saving
        
        return response()->json([
            'message' => 'Notification preferences updated successfully',
            'preferences' => $request->all()
        ]);
    }

    /**
     * Get privacy settings
     */
    public function getPrivacySettings(Request $request)
    {
        $parent = $request->user();
        
        $privacySettings = [
            'profile_visibility' => 'private', // private, limited, public
            'allow_teacher_contact' => true,
            'allow_school_marketing' => false,
            'data_sharing_consent' => true,
            'activity_tracking' => true,
            'third_party_integrations' => false
        ];
        
        return response()->json([
            'privacy_settings' => $privacySettings
        ]);
    }

    /**
     * Update privacy settings
     */
    public function updatePrivacySettings(Request $request)
    {
        $request->validate([
            'profile_visibility' => 'required|in:private,limited,public',
            'allow_teacher_contact' => 'boolean',
            'allow_school_marketing' => 'boolean',
            'data_sharing_consent' => 'boolean',
            'activity_tracking' => 'boolean',
            'third_party_integrations' => 'boolean'
        ]);
        
        $parent = $request->user();
        
        // In real app, save to user_privacy_settings table
        
        return response()->json([
            'message' => 'Privacy settings updated successfully',
            'privacy_settings' => $request->all()
        ]);
    }

    /**
     * Get account security information
     */
    public function getSecurityInfo(Request $request)
    {
        $parent = $request->user();
        
        $securityInfo = [
            'two_factor_enabled' => false,
            'last_password_change' => $parent->password_changed_at ?? $parent->created_at,
            'active_sessions' => $this->getActiveSessions($parent->id),
            'login_history' => $this->getLoginHistory($parent->id),
            'security_questions_set' => false
        ];
        
        return response()->json([
            'security_info' => $securityInfo
        ]);
    }

    /**
     * Enable/disable two-factor authentication
     */
    public function toggleTwoFactor(Request $request)
    {
        $request->validate([
            'enable' => 'required|boolean',
            'phone_number' => 'required_if:enable,true|string|max:20'
        ]);
        
        $parent = $request->user();
        
        if ($request->enable) {
            // In real app, implement 2FA setup
            $verificationCode = rand(100000, 999999);
            
            // Send SMS with verification code
            // Save 2FA settings
            
            return response()->json([
                'message' => 'Two-factor authentication setup initiated. Please verify your phone number.',
                'verification_required' => true,
                'phone_number' => $request->phone_number
            ]);
        } else {
            // Disable 2FA
            return response()->json([
                'message' => 'Two-factor authentication disabled successfully'
            ]);
        }
    }

    /**
     * Get connected students
     */
    public function getConnectedStudents(Request $request)
    {
        $parent = $request->user();
        $students = $this->getParentStudents($parent->id);
        
        return response()->json([
            'students' => $students
        ]);
    }

    /**
     * Request to add a new student
     */
    public function requestAddStudent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|string',
            'student_name' => 'required|string|max:255',
            'relationship' => 'required|string|in:father,mother,guardian',
            'verification_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);
        
        $parent = $request->user();
        
        // Store verification document
        $documentPath = $request->file('verification_document')->store('student-verification', 'private');
        
        // In real app, create a student_connection_request record
        
        return response()->json([
            'message' => 'Student connection request submitted successfully. It will be reviewed by school administration.',
            'request_id' => 'REQ' . time(),
            'status' => 'pending'
        ]);
    }

    /**
     * Get app preferences
     */
    public function getAppPreferences(Request $request)
    {
        $parent = $request->user();
        
        $preferences = [
            'theme' => 'light', // light, dark, auto
            'language' => 'en',
            'timezone' => 'Asia/Jakarta',
            'date_format' => 'Y-m-d',
            'currency' => 'IDR',
            'dashboard_layout' => 'grid', // grid, list
            'auto_refresh' => true,
            'compact_mode' => false
        ];
        
        return response()->json([
            'preferences' => $preferences
        ]);
    }

    /**
     * Update app preferences
     */
    public function updateAppPreferences(Request $request)
    {
        $request->validate([
            'theme' => 'in:light,dark,auto',
            'language' => 'in:en,id',
            'timezone' => 'string',
            'date_format' => 'string',
            'currency' => 'in:IDR,USD',
            'dashboard_layout' => 'in:grid,list',
            'auto_refresh' => 'boolean',
            'compact_mode' => 'boolean'
        ]);
        
        $parent = $request->user();
        
        // In real app, save to user_preferences table
        
        return response()->json([
            'message' => 'App preferences updated successfully',
            'preferences' => $request->all()
        ]);
    }

    /**
     * Delete account (deactivate)
     */
    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'confirmation' => 'required|in:DELETE_MY_ACCOUNT'
        ]);
        
        $parent = $request->user();
        
        if (!Hash::check($request->password, $parent->password)) {
            throw ValidationException::withMessages([
                'password' => ['The password is incorrect.'],
            ]);
        }
        
        // In real app, soft delete or deactivate account
        $parent->update([
            'is_active' => false,
            'deactivated_at' => now()
        ]);
        
        // Revoke all tokens
        $parent->tokens()->delete();
        
        return response()->json([
            'message' => 'Account deactivated successfully'
        ]);
    }

    /**
     * Export personal data
     */
    public function exportData(Request $request)
    {
        $parent = $request->user();
        
        $data = [
            'profile' => $parent->toArray(),
            'students' => $this->getParentStudents($parent->id),
            'notification_preferences' => $this->getNotificationPreferencesData($parent->id),
            'login_history' => $this->getLoginHistory($parent->id),
            'export_date' => now()->toISOString()
        ];
        
        $filename = 'parent_data_' . $parent->id . '_' . now()->format('Y_m_d') . '.json';
        
        return response()->json($data)
                        ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Helper: Get notification preferences data
     */
    private function getNotificationPreferencesData($parentId)
    {
        // In real app, get from user_notification_preferences table
        return [
            'email_notifications' => true,
            'sms_notifications' => false,
            'push_notifications' => true,
            'announcement_notifications' => true,
            'payment_reminders' => true,
            'attendance_alerts' => true,
            'grade_updates' => true,
            'emergency_alerts' => true
        ];
    }

    /**
     * Helper: Get parent's students
     */
    private function getParentStudents($parentId)
    {
        return [
            [
                'id' => 1,
                'name' => 'Ahmad Rizki',
                'student_id' => 'STD001',
                'class' => 'Grade 5A',
                'status' => 'active',
                'connection_date' => '2020-07-01'
            ],
            [
                'id' => 2,
                'name' => 'Siti Nurhaliza',
                'student_id' => 'STD002',
                'class' => 'Grade 3B',
                'status' => 'active',
                'connection_date' => '2022-07-01'
            ]
        ];
    }

    /**
     * Helper: Get active sessions
     */
    private function getActiveSessions($parentId)
    {
        return [
            [
                'id' => 1,
                'device' => 'Chrome on Windows',
                'ip_address' => '192.168.1.100',
                'location' => 'Jakarta, Indonesia',
                'last_activity' => now()->subMinutes(5),
                'is_current' => true
            ]
        ];
    }

    /**
     * Helper: Get login history
     */
    private function getLoginHistory($parentId)
    {
        return [
            [
                'login_at' => now()->subHours(2),
                'ip_address' => '192.168.1.100',
                'device' => 'Chrome on Windows',
                'location' => 'Jakarta, Indonesia',
                'status' => 'success'
            ],
            [
                'login_at' => now()->subDays(1),
                'ip_address' => '192.168.1.100',
                'device' => 'Safari on iPhone',
                'location' => 'Jakarta, Indonesia',
                'status' => 'success'
            ]
        ];
    }
}