<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('last_seen', 'desc')->get();

        return view('users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email:dns|unique:users',
            'contact' => 'nullable|string|regex:/^[\d\s()+]+$/',
            'roles' => 'required',
        ]);

        $user = User::create($validatedData);

        $user->assignRole($request->roles);

        return redirect('/users')->with('success', 'Added user successfully.');
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
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function editContact(User $user)
    {
        $user = Auth::user();

        return view('users.edit-contact', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email:dns|unique:users,email,' . $user->id,
            'contact' => 'nullable|string|regex:/^[\d\s()+]+$/',
            'roles' => 'required',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Only update password if provided
        if ($request->filled('password')) {
            $validatedData['password'] = \Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        $user->syncRoles($request->roles);

        return redirect('/users')->with('success', 'Updated user successfully.');
    }

    public function updateContact(Request $request, string $id)
    {
        $request->validate([
            'contact' => [
                'required',
                'string',
                'unique:users',
                'regex:/^[\d\s()+]+$/',
            ],
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'contact' => $request->input('contact'),
        ]);

        return redirect('/')->with('success', 'Contact updated successfully.');
    }

    /**
     * Show the form for editing the user's password.
     */
    public function editPassword(User $user)
    {
        return view('users.edit-password', compact('user'));
    }

    /**
     * Update the user's password in storage.
     */
    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!\Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.']);
        }

        $user->update([
            'password' => \Hash::make($request->password),
        ]);

        return redirect('/users')->with('success', 'Password berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);

        return redirect('/users')->with('success', "Delete {$user->name} successfully.");
    }

    public function getUser(Request $request)
    {
        $apiUrl = env('GERBANG_API_URL');
        $apiToken = env('GERBANG_TOKEN');

        $keyword = $request->input('keyword', '');

        try {
            $response = Http::withToken($apiToken)
                ->timeout(10)
                ->get($apiUrl . "/pegawai/search", [
                    'keyword' => $keyword,
                ]);

            Log::info('Search User API', [
                'url' => $apiUrl,
                'keyword' => $keyword,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json([
                'message' => 'Failed to fetch data',
                'status' => $response->status(),
                'response' => $response->json(),
            ], $response->status());

        } catch (\Throwable $e) {
            Log::error('Search User API Error', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Error connecting to API',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
