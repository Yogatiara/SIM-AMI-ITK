<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FacultyController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manage faculties');

        $faculties = Faculty::with(['departments.units'])->get();
        return view('faculties.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('manage faculties');

        return view('faculties.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty)
    {
        $this->authorize('manage faculties');

        $faculty->load(['departments.units']);
        return view('faculties.show', compact('faculty'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manage faculties');

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faculties',
            'code' => 'required|string|max:10|unique:faculties',
        ]);

        Faculty::create($validated);

        return redirect()->route('faculties.index')->with('success', 'Fakultas berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faculty $faculty)
    {
        $this->authorize('manage faculties');

        return view('faculties.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty $faculty)
    {
        $this->authorize('manage faculties');

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:faculties,name,' . $faculty->id,
            'code' => 'required|string|max:10|unique:faculties,code,' . $faculty->id,
        ]);

        $faculty->update($validated);

        return redirect()->route('faculties.index')->with('success', 'Fakultas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty)
    {
        $this->authorize('manage faculties');

        // Check if faculty has departments
        if ($faculty->departments()->count() > 0) {
            return redirect()->route('faculties.index')->with('error', 'Fakultas tidak dapat dihapus karena memiliki departemen.');
        }

        $faculty->delete();

        return redirect()->route('faculties.index')->with('success', 'Fakultas berhasil dihapus.');
    }
}
