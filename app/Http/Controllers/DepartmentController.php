<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::get();

        return view('departments.index', [
            'departments' => $departments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create', [
            'header' => "Tambah Departemen Baru",
            'route' => route('departments.store'),
            'submit' => "Simpan"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:departments'],
            'code' => ['required', 'string', 'max:10', 'unique:departments']
        ]);

        $department = Department::create([
            'name' => $request->name,
            'code' => $request->code
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
        return view('departments.edit', [
            'header' => "Edit Departemen",
            'route' => route('departments.update', $department),
            'submit' => "Simpan Perubahan",
            'department' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:departments,name,' . $department->id],
            'code' => ['required', 'string', 'max:10', 'unique:departments,code,' . $department->id]
        ]);

        $department->update([
            'name' => $request->name,
            'code' => $request->code
        ]);

        return redirect('/departments')
            ->with("status", "$department->code updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        Department::destroy($department->id);

        return redirect('/departments')->with('status', 'Delete successfully');
    }
}
