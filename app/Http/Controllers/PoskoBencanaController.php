<?php
namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PoskoBencanaController extends Controller
{
    public function index(Request $request)
    {
        $query = PoskoBencana::with('kejadian');

        // --- SEARCH (nama posko + alamat + penanggung jawab) ---
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', "%{$request->search}%")
                    ->orWhere('alamat', 'like', "%{$request->search}%")
                    ->orWhere('penanggung_jawab', 'like', "%{$request->search}%");
            });
        }

        // --- FILTER berdasarkan kejadian bencana ---
        if ($request->kejadian_id) {
            $query->where('kejadian_id', $request->kejadian_id);
        }

        // PAGINATION (10 data per halaman)
        $posko = $query->paginate(10)->withQueryString();

        // data kejadian untuk dropdown filter
        $kejadian = KejadianBencana::all();

        return view('pages.posko-bencana.index', compact('posko', 'kejadian'));
    }

    public function create()
    {
        $kejadian = \App\Models\KejadianBencana::all();
        return view('pages.posko-bencana.create', compact('kejadian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kejadian_id'      => 'required|exists:kejadian_bencana,kejadian_id',
            'nama'             => 'required|string|max:100',
            'alamat'           => 'required|string|max:255',
            'kontak'           => 'nullable|string|max:20',
            'penanggung_jawab' => 'nullable|string|max:100',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoName = null;

        if ($request->hasFile('foto')) {
            // simpan foto di folder public/uploads/posko
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads/posko'), $fotoName);
        }

        PoskoBencana::create([
            'nama'             => $request->nama,
            'alamat'           => $request->alamat,
            'kontak'           => $request->kontak,
            'penanggung_jawab' => $request->penanggung_jawab,
            'kejadian_id'      => $request->kejadian_id,
            'foto'             => $fotoName, // langsung pakai variabel yang udah didefinisikan
        ]);

        return redirect()->route('posko-bencana.index')->with('success', 'Data posko berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $posko    = PoskoBencana::findOrFail($id);
        $kejadian = KejadianBencana::all();
        return view('pages.posko-bencana.edit', compact('posko', 'kejadian'));
    }

    public function update(Request $request, $id)
    {
        $posko = PoskoBencana::findOrFail($id);

        $request->validate([
            'kejadian_id'      => 'required|exists:kejadian_bencana,kejadian_id',
            'nama'             => 'required|string|max:100',
            'alamat'           => 'required|string|max:255',
            'kontak'           => 'nullable|string|max:20',
            'penanggung_jawab' => 'nullable|string|max:100',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $foto = $posko->foto;

        // 🟪 kalau upload foto baru → hapus lama
        if ($request->hasFile('foto')) {
            if ($foto && Storage::disk('public')->exists('posko/' . $foto)) {
                Storage::disk('public')->delete('posko/' . $foto);
            }
            $fotoBaru = $request->file('foto')->store('posko', 'public');
            $foto     = basename($fotoBaru);
        }

        $posko->update([
            'nama'             => $request->nama,
            'alamat'           => $request->alamat,
            'kontak'           => $request->kontak,
            'penanggung_jawab' => $request->penanggung_jawab,
            'kejadian_id'      => $request->kejadian_id,
            'foto'             => $foto,
        ]);

        return redirect()->route('posko-bencana.index')
            ->with('success', 'Data posko berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $posko = PoskoBencana::findOrFail($id);

        if ($posko->foto && file_exists(public_path('uploads/posko/' . $posko->foto))) {
            unlink(public_path('uploads/posko/' . $posko->foto));
        }

        $posko->delete();
        return redirect()->route('posko-bencana.index')->with('success', 'Data posko berhasil dihapus!');
    }
}
