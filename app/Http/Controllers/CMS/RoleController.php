<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     */
    public function index()
    {
        $roles = Role::with('permissions')
            ->withCount('users')
            ->where('guard_name', 'web')
            ->orderBy('name')
            ->paginate(10);

        return view('cms.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create()
    {
        $permissions = Permission::where('guard_name', 'web')
            ->orderBy('name')
            ->get()
            ->groupBy(function ($permission) {
                return $this->getPermissionGroup($permission->name);
            });

        return view('cms.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:spatie_permissions,id',
        ]);

        // Convert name to slug format
        $slug = strtolower(str_replace(' ', '-', $validated['name']));

        $role = Role::create([
            'name' => $slug,
            'guard_name' => 'web',
        ]);

        if (!empty($validated['permissions'])) {
            $permissions = Permission::whereIn('id', $validated['permissions'])->get();
            $role->syncPermissions($permissions);
        }

        return redirect()->route('cms.roles.index')
            ->with('success', "Role '{$role->name}' created successfully.");
    }

    /**
     * Display the specified role.
     */
    public function show(Role $role)
    {
        $role->load('permissions', 'users');
        
        $allPermissions = Permission::where('guard_name', 'web')
            ->orderBy('name')
            ->get()
            ->groupBy(function ($permission) {
                return $this->getPermissionGroup($permission->name);
            });

        return view('cms.roles.show', compact('role', 'allPermissions'));
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::where('guard_name', 'web')
            ->orderBy('name')
            ->get()
            ->groupBy(function ($permission) {
                return $this->getPermissionGroup($permission->name);
            });

        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('cms.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, Role $role)
    {
        // Prevent editing system roles
        if (in_array($role->name, ['super-admin'])) {
            return redirect()->route('cms.roles.index')
                ->with('error', 'Cannot modify the super-admin role.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:spatie_permissions,id',
        ]);

        // Convert name to slug format
        $slug = strtolower(str_replace(' ', '-', $validated['name']));

        $role->update(['name' => $slug]);

        $permissions = [];
        if (!empty($validated['permissions'])) {
            $permissions = Permission::whereIn('id', $validated['permissions'])->get();
        }
        $role->syncPermissions($permissions);

        return redirect()->route('cms.roles.index')
            ->with('success', "Role '{$role->name}' updated successfully.");
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Role $role)
    {
        // Prevent deleting system roles
        if (in_array($role->name, ['super-admin', 'admin', 'editor'])) {
            return redirect()->route('cms.roles.index')
                ->with('error', 'Cannot delete system roles.');
        }

        // Check if role has users assigned
        if ($role->users()->count() > 0) {
            return redirect()->route('cms.roles.index')
                ->with('error', "Cannot delete role '{$role->name}' because it has users assigned.");
        }

        $role->delete();

        return redirect()->route('cms.roles.index')
            ->with('success', "Role '{$role->name}' deleted successfully.");
    }

    /**
     * Get the permission group name based on permission name.
     */
    private function getPermissionGroup(string $permissionName): string
    {
        $groups = [
            'Dashboard' => ['view-dashboard'],
            'Website Content' => ['edit-homepage', 'manage-banners', 'manage-pages', 'manage-media'],
            'About Section' => ['manage-history', 'manage-vision-mission', 'manage-organizational-structure'],
            'Programs & Content' => ['manage-programs', 'manage-explores', 'create-news', 'edit-news', 'delete-news', 'manage-events'],
            'Admissions' => ['manage-admission-waves', 'view-registrations', 'edit-registrations', 'approve-registrations', 'view-students', 'edit-students', 'manage-discounts', 'manage-payments'],
            'Support' => ['manage-faqs', 'view-contact-us'],
            'Administration' => ['manage-users', 'manage-roles', 'manage-settings', 'export-data', 'view-activity-log'],
        ];

        foreach ($groups as $group => $permissions) {
            if (in_array($permissionName, $permissions)) {
                return $group;
            }
        }

        return 'Other';
    }
}
