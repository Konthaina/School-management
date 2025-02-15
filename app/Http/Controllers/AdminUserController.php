<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Display a listing of the resource (admins only can see non-super-admin users)
    public function index()
    {
        // Only fetch users who are not Super Admin
        $users = User::where('role_id', '!=', 1)->get(); // assuming role_id 1 is Super Admin
        return view('admin.users.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        // Exclude Super Admin role in user creation
        $roles = Role::where('name', '!=', 'super_admin')->get();
        return view('admin.users.create', compact('roles'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id|not_in:1', // cannot create Super Admin
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $validated['role_id'],
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Display the specified resource
    public function show($id)
    {
        $user = User::with('profile')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::where('name', '!=', 'super_admin')->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|exists:roles,id|not_in:1', // cannot update to Super Admin
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
        ]);

        // Update password if provided
        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // Prevent deletion of Super Admin
        if ($user->role->name === 'super_admin') {
            return redirect()->route('admin.users.index')->with('error', 'Cannot delete Super Admin user.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}

?>
