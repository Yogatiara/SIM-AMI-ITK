<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoleManagementController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manage roles');

        $roles = Role::with('permissions', 'users')->get();
        $permissions = Permission::with('roles')->get();

        return view('roles-management.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('manage roles');

        $permissions = Permission::all();
        return view('roles-management.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manage roles');

        $validated = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create(['name' => $validated['name']]);

        if (isset($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return redirect()->route('roles-management.index')->with('success', 'Role berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('manage roles');

        $role = Role::with('permissions', 'users')->findOrFail($id);
        return view('roles-management.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $this->authorize('manage roles');

        $permissions = Permission::all();
        return view('roles-management.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('manage roles');

        $validated = $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()->route('roles-management.index')->with('success', 'Role berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->authorize('manage roles');

        // Prevent deletion of core roles
        if (in_array($role->name, ['Admin', 'PJM', 'Auditor', 'Auditee'])) {
            return redirect()->route('roles-management.index')->with('error', 'Role inti tidak dapat dihapus.');
        }

        $role->delete();

        return redirect()->route('roles-management.index')->with('success', 'Role berhasil dihapus.');
    }

    /**
     * Switch user role (for non-admin users)
     */
    public function switchRole(Request $request)
    {
        $role = $request->input('role');

        $validated = $request->validate([
            'role' => ['required', 'string'],
        ]);

        $role = $validated['role'];

        Cache::put('user_role_' . Auth::id(), $role, 60 * 60);
        return redirect('/');
    }
}
