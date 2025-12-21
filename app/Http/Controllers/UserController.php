<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%");
        }

        if ($request->email_domain) {
            $query->where('email', 'like', "%@{$request->email_domain}");
        }

        $perPage = $request->input('per_page', 10);
        $users   = $query->paginate($perPage)->appends($request->all());

        return view('pages.user.index', compact('users'));
    }

    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:100',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|min:8|confirmed',
            'role'            => 'required|in:admin,staff,user',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data             = $request->except('profile_picture');
        $data['password'] = Hash::make($request->password);

        if ($request->hasFile('profile_picture')) {
            $filename = time() . '_' . $request->file('profile_picture')->getClientOriginalName();
            $request->file('profile_picture')
                ->storeAs('uploads/profile', $filename, 'public');
            $data['profile_picture'] = $filename;
        }

        $user = User::create($data);

        return redirect()->route('users.index')->with('success', 'Data user berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'            => 'required|string|max:100',
            'email'           => 'required|email|unique:users,email,' . $user->id,
            'password'        => 'nullable|min:8|confirmed',
            'role'            => 'required|in:admin,staff,user',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('password', 'profile_picture');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {

            if ($user->profile_picture &&
                Storage::disk('public')->exists('uploads/profile/' . $user->profile_picture)) {
                Storage::disk('public')->delete('uploads/profile/' . $user->profile_picture);
            }

            $filename = time() . '_' . $request->file('profile_picture')->getClientOriginalName();

            $request->file('profile_picture')->storeAs(
                'uploads/profile',
                $filename,
                'public'
            );

            $data['profile_picture'] = $filename;
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->profile_picture &&
            Storage::disk('public')->exists('uploads/profile/' . $user->profile_picture)) {
            Storage::disk('public')->delete('uploads/profile/' . $user->profile_picture);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus!');
    }

}
