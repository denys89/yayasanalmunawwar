<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all permissions grouped by module
        $permissions = [
            // Dashboard
            'view-dashboard' => 'View CMS Dashboard',
            
            // Website Content
            'edit-homepage' => 'Edit Homepage Content',
            'manage-banners' => 'Manage Banners',
            'manage-pages' => 'Manage Pages',
            'manage-media' => 'Manage Media Files',
            
            // About Section
            'manage-history' => 'Manage History Content',
            'manage-vision-mission' => 'Manage Vision & Mission',
            'manage-organizational-structure' => 'Manage Organizational Structure',
            
            // Programs & Content
            'manage-programs' => 'Manage Programs',
            'manage-explores' => 'Manage Explores',
            'create-news' => 'Create News Articles',
            'edit-news' => 'Edit News Articles',
            'delete-news' => 'Delete News Articles',
            'manage-events' => 'Manage Events',
            
            // Admissions
            'manage-admission-waves' => 'Manage Admission Waves',
            'view-registrations' => 'View Student Registrations',
            'edit-registrations' => 'Edit Student Registrations',
            'approve-registrations' => 'Approve/Reject Registrations',
            'view-students' => 'View Students',
            'edit-students' => 'Edit Students',
            'manage-discounts' => 'Manage Discounts',
            'manage-payments' => 'Manage Monthly Payments',
            
            // Support
            'manage-faqs' => 'Manage FAQs',
            'view-contact-us' => 'View Contact Us Submissions',
            
            // Administration
            'manage-users' => 'Manage Users',
            'manage-roles' => 'Manage Roles & Permissions',
            'manage-settings' => 'Manage Site Settings',
            'export-data' => 'Export Data',
            'view-activity-log' => 'View Activity Log',
        ];

        // Create all permissions
        foreach ($permissions as $slug => $description) {
            Permission::firstOrCreate(
                ['name' => $slug, 'guard_name' => 'web'],
                ['name' => $slug, 'guard_name' => 'web']
            );
        }

        // Create roles and assign permissions
        
        // Super Admin - has all permissions
        $superAdmin = Role::firstOrCreate(
            ['name' => 'super-admin', 'guard_name' => 'web']
        );
        $superAdmin->givePermissionTo(Permission::all());

        // Admin - has most permissions except role/permission management
        $admin = Role::firstOrCreate(
            ['name' => 'admin', 'guard_name' => 'web']
        );
        $adminPermissions = array_keys($permissions);
        // Remove sensitive permissions from admin
        $adminPermissions = array_diff($adminPermissions, ['manage-roles']);
        $admin->syncPermissions($adminPermissions);

        // Editor - content management only
        $editor = Role::firstOrCreate(
            ['name' => 'editor', 'guard_name' => 'web']
        );
        $editor->syncPermissions([
            'view-dashboard',
            'edit-homepage',
            'manage-banners',
            'manage-pages',
            'manage-media',
            'manage-history',
            'manage-vision-mission',
            'manage-programs',
            'manage-explores',
            'create-news',
            'edit-news',
            'manage-events',
            'manage-faqs',
        ]);

        // Registrar - student management only
        $registrar = Role::firstOrCreate(
            ['name' => 'registrar', 'guard_name' => 'web']
        );
        $registrar->syncPermissions([
            'view-dashboard',
            'manage-admission-waves',
            'view-registrations',
            'edit-registrations',
            'approve-registrations',
            'view-students',
            'edit-students',
            'manage-discounts',
        ]);

        // Accountant - payment management only
        $accountant = Role::firstOrCreate(
            ['name' => 'accountant', 'guard_name' => 'web']
        );
        $accountant->syncPermissions([
            'view-dashboard',
            'view-registrations',
            'view-students',
            'manage-payments',
            'export-data',
        ]);

        // Viewer - read-only access
        $viewer = Role::firstOrCreate(
            ['name' => 'viewer', 'guard_name' => 'web']
        );
        $viewer->syncPermissions([
            'view-dashboard',
            'view-registrations',
            'view-students',
            'view-contact-us',
        ]);

        // Assign roles to existing users based on their current role field
        $this->migrateExistingUsers();
    }

    /**
     * Migrate existing users from role enum to Spatie roles
     */
    private function migrateExistingUsers(): void
    {
        // Get all users with the old role field
        $users = User::whereNotNull('role')->get();

        foreach ($users as $user) {
            $oldRole = $user->role;
            
            // Skip if user already has roles assigned
            if ($user->roles()->count() > 0) {
                continue;
            }

            // Map old roles to new roles
            switch ($oldRole) {
                case 'admin':
                    $user->assignRole('admin');
                    break;
                case 'editor':
                    $user->assignRole('editor');
                    break;
                case 'parent':
                    // Parents don't get CMS access, skip
                    break;
                default:
                    // Assign viewer role as default
                    $user->assignRole('viewer');
                    break;
            }
        }
    }
}
