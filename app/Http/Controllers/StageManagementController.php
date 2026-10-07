<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class StageManagementController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manage stages');

        $stages = Stage::orderBy('order', 'asc')->get();
        return view('stages-management.index', compact('stages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('manage stages');

        return view('stages-management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manage stages');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // If order is not set, put it at the end
        $order = $validated['order'] ?? 0;
        if ($order === 0) {
            $maxOrder = Stage::max('order') ?? 0;
            $order = $maxOrder + 1;
        }

        Stage::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'order' => $order,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        return redirect()->route('stages-management.index')->with('success', 'Tahapan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stage $stage)
    {
        $this->authorize('manage stages');

        return view('stages-management.edit', compact('stage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stage $stage)
    {
        $this->authorize('manage stages');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $stage->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'is_active' => $validated['is_active'] ?? false,
        ]);

        return redirect()->route('stages-management.index')->with('success', 'Tahapan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stage $stage)
    {
        $this->authorize('manage stages');

        $stage->delete();

        // Reorder remaining stages
        $this->reorderStages();

        return redirect()->route('stages-management.index')->with('success', 'Tahapan berhasil dihapus.');
    }

    /**
     * Move stage up in order.
     */
    public function moveUp(Stage $stage)
    {
        $this->authorize('manage stages');


        // dump($stage->id);

        $stages = Stage::orderBy('order', 'asc')->get();
        $currentIndex = $stages->search(function ($item) use ($stage) {
            // dump($item->id === $stage->id);

            return $item->id === $stage->id;
        });





        if ($currentIndex > 0) {
            $previousStage = $stages[$currentIndex - 1];

            // Swap orders
            $currentOrder = $stage->order;
            $stage->update(['order' => $previousStage->order]);
            $previousStage->update(['order' => $currentOrder]);
        }

        return redirect()->route('stages-management.index')->with('success', 'Urutan Tahapan berhasil diubah.');
    }

    /**
     * Move stage down in order.
     */
    public function moveDown(Stage $stage)
    {
        $this->authorize('manage stages');

        $stages = Stage::orderBy('order', 'asc')->get();
        $currentIndex = $stages->search(function ($item) use ($stage) {
            return $item->id === $stage->id;
        });

        if ($currentIndex < $stages->count() - 1) {
            $nextStage = $stages[$currentIndex + 1];

            // Swap orders
            $currentOrder = $stage->order;
            $stage->update(['order' => $nextStage->order]);
            $nextStage->update(['order' => $currentOrder]);
        }

        return redirect()->route('stages-management.index')->with('success', 'Urutan Tahapan berhasil diubah.');
    }

    /**
     * Toggle stage active status.
     */
    public function toggleActive(Stage $stage)
    {
        $this->authorize('manage stages');

        $stage->update([
            'is_active' => !$stage->is_active,
        ]);

        $status = $stage->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('stages-management.index')->with('success', "Stage {$stage->name} berhasil {$status}.");
    }

    /**
     * Reorder all stages sequentially.
     */
    private function reorderStages()
    {
        $stages = Stage::orderBy('order', 'asc')->get();
        $order = 1;

        foreach ($stages as $stage) {
            $stage->update(['order' => $order++]);
        }
    }
}
