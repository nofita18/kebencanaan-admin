<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search (nama atau email)
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%");
        }

        // Filter email domain (opsional)
        if ($request->email_domain) {
            $query->where('email', 'like', "%@{$request->email_domain}");
        }

        // Dropdown pagination
        $perPage = $request->input('per_page', 10);

        // Pagination + simpan query ketika pindah halaman
        $users = $query->paginate($perPage)->appends($request->all());

        return view('pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:admin,staff,user'
        ]);

        //Enkripsi password
        $data             = $request->all();
        $data['password'] = Hash::make($request->password);

        //Simpan ke database
        $user = User::create($data);

        session([
            'logged_in'  => true,
            'user_id'    => $user->id,
            'user_name'  => $user->name,
            'user_email' => $user->email,
        ]);

        //Redirect dg pesan sukses
        return redirect()->route('users.index')->with('success', 'Data user berhasil di tambahkan!');
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
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validasi
        $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:admin,staff,user',
        ]);

        $data = $request->all();

        // Kalau password diisi, baru update
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }
}
