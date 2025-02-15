<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LecturerUserController extends Controller
{
    public function __construct()
    {
        // Ensure only lecturers can access this controller
        $this->middleware('role:lecturer');
    }

    // Display a listing of the resource (Students created by the lecturer)
    public function index()
    {
        $students = User::where('role_id', Role::where('name', 'Student')->first()->id)->get();
        return view('lecturer.users.index', compact('students'));
    }

    // Show the form for creating a new student
    public function create()
    {
        return view('lecturer.users.create');
    }

    // Store a newly created student in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Get the role_id for "Student"
        $studentRole = Role::where('name', 'Student')->firstOrFail();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $studentRole->id, // Assign "Student" role
        ]);

        return redirect()->route('lecturer.users.index')->with('success', 'Student created successfully.');
    }

    // Display the specified resource
    public function show($id)
    {
        $student = User::where('role_id', Role::where('name', 'Student')->first()->id)->findOrFail($id);
        return view('lecturer.users.show', compact('student'));
    }

    // Show the form for editing the specified student
    public function edit($id)
    {
        $student = User::where('role_id', Role::where('name', 'Student')->first()->id)->findOrFail($id);
        return view('lecturer.users.edit', compact('student'));
    }

    // Update the specified student in storage
    public function update(Request $request, $id)
    {
        $student = User::where('role_id', Role::where('name', 'Student')->first()->id)->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->id,
            'password' => 'nullable|string|min:8',
        ]);

        $student->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Update password if provided
        if ($request->filled('password')) {
            $student->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('lecturer.users.index')->with('success', 'Student updated successfully.');
    }

    // Remove the specified student from storage
    public function destroy($id)
    {
        $student = User::where('role_id', Role::where('name', 'Student')->first()->id)->findOrFail($id);
        $student->delete();

        return redirect()->route('lecturer.users.index')->with('success', 'Student deleted successfully.');
    }
}
