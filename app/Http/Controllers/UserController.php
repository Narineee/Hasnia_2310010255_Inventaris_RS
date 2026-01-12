<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Pengguna::latest()->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:penggunas,username',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,petugas',
        ]);

        Pengguna::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('user.index')
                         ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Pengguna::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Pengguna::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:penggunas,username,' . $user->id,
            'role'     => 'required|in:admin,petugas',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'username' => $request->username,
            'role'     => $request->role,
        ];

        // kalau password diisi → update
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')
                         ->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = Pengguna::findOrFail($id);

        // proteksi admin utama
        if ($user->username === 'admin') {
            return back()->with('error', 'Admin utama tidak boleh dihapus');
        }

        $user->delete();

        return redirect()->route('user.index')
                         ->with('success', 'User berhasil dihapus');
    }
}
