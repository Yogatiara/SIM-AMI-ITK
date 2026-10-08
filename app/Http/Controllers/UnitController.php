<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::with(['department.faculty'])
            ->latest()
            ->get();

        foreach ($units as $unit) {
            $unit->can_be_deleted = $unit->forms_count == 0;
        }

        return view('units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::with('faculty')->get();
        return view('units.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:units'],
            'code' => ['required', 'string', 'max:10', 'unique:units'],
            'department_id' => ['required', 'exists:departments,id'],
        ]);

        $unit = Unit::create([
            'name' => $request->name,
            'code' => $request->code,
            'department_id' => $request->department_id,
        ]);

        return redirect('/units')
            ->with("status", "$unit->name added successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        $departments = Department::with('faculty')->get();
        return view('units.edit', compact('unit', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
        ]);

        $unit->update([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'department_id' => $validatedData['department_id'],
        ]);

        return redirect()->route('units.index')
            ->with('success', "Data $unit->name berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        Unit::destroy($unit->id);

        return redirect('/units')->with('status', 'Delete successfully');
    }
}
