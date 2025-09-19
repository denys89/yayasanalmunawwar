<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('cms.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,editor,user',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['email_verified_at'] = now();

        User::create($validated);

        return redirect()->route('cms.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('cms.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('cms.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,editor,user',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('cms.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting the current user
        if ($user->id === auth()->id()) {
            return redirect()->route('cms.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('cms.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Activate a user account.
     */
    public function activate(User $user)
    {
        // Prevent activating if already active
        if ($user->is_active ?? false) {
            return redirect()->route('cms.users.index')
                ->with('info', 'User is already active.');
        }

        $user->is_active = true;
        $user->save();

        return redirect()->route('cms.users.index')
            ->with('success', 'User activated successfully.');
    }

    /**
     * Deactivate a user account.
     */
    public function deactivate(User $user)
    {
        // Prevent deactivating self
        if ($user->id === auth()->id()) {
            return redirect()->route('cms.users.index')
                ->with('error', 'You cannot deactivate your own account.');
        }

        // Prevent deactivating admins by non-admins (extra safety, though admin middleware protects routes)
        if (auth()->user() && !auth()->user()->isAdmin() && $user->isAdmin()) {
            return redirect()->route('cms.users.index')
                ->with('error', 'You are not authorized to deactivate an admin user.');
        }

        // If already inactive
        if (!($user->is_active ?? false)) {
            return redirect()->route('cms.users.index')
                ->with('info', 'User is already inactive.');
        }

        $user->is_active = false;
        $user->save();

        return redirect()->route('cms.users.index')
            ->with('success', 'User deactivated successfully.');
    }

    public function bulk(Request $request)
    {
        $validated = $request->validate([
            'action' => ['required', 'string', 'in:activate,deactivate,change_role,delete'],
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:users,id'],
            'role' => ['nullable', 'string'],
        ]);

        $ids = collect($validated['ids'])->map(fn($id) => (int) $id)->unique()->values()->all();
        $action = $validated['action'];

        // Handle role change
        if ($action === 'change_role') {
            // Only roles that exist in the current DB enum to avoid SQL errors
            $allowedRoles = ['admin', 'editor'];
            $newRole = $request->input('role');

            if (!in_array($newRole, $allowedRoles, true)) {
                return redirect()->route('cms.users.index')->with('error', 'Invalid role selected. Only admin or editor are supported currently.');
            }

            $affected = User::whereIn('id', $ids)->update(['role' => $newRole]);
            return redirect()->route('cms.users.index')->with('success', "Updated role to {$newRole} for {$affected} users.");
        }

        // Handle delete
        if ($action === 'delete') {
            $currentUserId = Auth::id();
            $idsToDelete = array_values(array_diff($ids, [$currentUserId]));

            if (empty($idsToDelete)) {
                return redirect()->route('cms.users.index')->with('info', 'No users deleted (you cannot delete your own account).');
            }

            $affected = User::whereIn('id', $idsToDelete)->delete();
            return redirect()->route('cms.users.index')->with('success', "Deleted {$affected} users.");
        }

        // Handle activate/deactivate
        if (in_array($action, ['activate', 'deactivate'], true)) {
            if (!Schema::hasColumn('users', 'is_active')) {
                return redirect()->route('cms.users.index')->with('error', 'Activation feature is not available yet. Missing users.is_active column. Please add the migration to enable this.');
            }

            $flag = $action === 'activate';
            $currentUserId = Auth::id();
            // Prevent deactivating yourself
            $idsToUpdate = $flag ? $ids : array_values(array_diff($ids, [$currentUserId]));

            if (empty($idsToUpdate)) {
                return redirect()->route('cms.users.index')->with('info', 'No users updated.');
            }

            $affected = User::whereIn('id', $idsToUpdate)->update(['is_active' => $flag]);
            $word = $flag ? 'activated' : 'deactivated';
            return redirect()->route('cms.users.index')->with('success', ucfirst($word) . " {$affected} users.");
        }

        return redirect()->route('cms.users.index')->with('error', 'Unknown action.');
    }

    /**
     * Change user password
     */
    public function changePassword(Request $request, User $user)
    {
        $rules = [
            'new_password' => 'required|string|min:8|confirmed',
        ];

        // If changing own password, require current password
        if ($user->id === auth()->id()) {
            $rules['current_password'] = 'required|string';
        }

        $validated = $request->validate($rules);

        // Verify current password if changing own password
        if ($user->id === auth()->id()) {
            if (!Hash::check($validated['current_password'], $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
        }

        // Update password
        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        $message = $user->id === auth()->id() 
            ? 'Your password has been changed successfully.' 
            : "Password for {$user->name} has been changed successfully.";

        return back()->with('success', $message);
    }
    public function loginAs(Request $request, User $user)
    {
        // Only admins can impersonate and cannot impersonate themselves
        if (!auth()->user() || auth()->user()->role !== 'admin' || auth()->id() === $user->id) {
            return back()->with('error', 'You are not authorized to perform this action.');
        }

        // Store the original admin ID in session to allow return later
        session(['impersonator_id' => auth()->id()]);

        // Log in as the target user
        Auth::login($user);

        return redirect('/')->with('success', 'You are now logged in as ' . $user->name . '.');
    }
}
