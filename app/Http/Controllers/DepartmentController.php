<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::with(['faculty', 'units'])->get();

        return view('departments.index', [
            'departments' => $departments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $faculties = Faculty::all();
        return view('departments.create', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:departments'],
            'code' => ['required', 'string', 'max:10', 'unique:departments'],
            'faculty_id' => ['required', 'exists:faculties,id'],
        ]);

        $department = Department::create([
            'name' => $request->name,
            'code' => $request->code,
            'faculty_id' => $request->faculty_id,
        ]);

        return redirect('/departments')
            ->with("status", "$department->code added successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $faculties = Faculty::all();
        return view('departments.edit', compact('department', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:departments,name,' . $department->id],
            'code' => ['required', 'string', 'max:10', 'unique:departments,code,' . $department->id],
            'faculty_id' => ['required', 'exists:faculties,id'],
        ]);

        $department->update([
            'name' => $request->name,
            'code' => $request->code,
            'faculty_id' => $request->faculty_id,
        ]);

        return redirect('/departments')
            ->with("status", "$department->code updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        // Check if department has units
        if ($department->units()->count() > 0) {
            return redirect('/departments')->with('error', 'Departemen tidak dapat dihapus karena memiliki program studi.');
        }

        Department::destroy($department->id);

        return redirect('/departments')->with('status', 'Delete successfully');
    }
}
