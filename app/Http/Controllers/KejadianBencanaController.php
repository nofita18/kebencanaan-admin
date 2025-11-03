<?php
namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KejadianBencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kejadian = KejadianBencana::all();
        return view('pages.kejadian-bencana.index', compact('kejadian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kejadian-bencana.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_bencana'   => 'required|max:100',
            'tanggal'         => 'required|date',
            'lokasi'          => 'required|max:150',
            'rt'              => 'required|max:5',
            'rw'              => 'required|max:5',
            'dampak'          => 'required|max:150',
            'status_kejadian' => 'required|max:50',
            'keterangan'      => 'nullable',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file         = $request->file('foto');
            $filename     = time() . '_' . $file->getClientOriginalName();
            $path         = $file->storeAs('uploads/kejadian', $filename, 'public');
            $data['foto'] = $path;
        }

        KejadianBencana::create($data);

        return redirect()->route('kejadian-bencana.create')
            ->with('success', 'Data kejadian bencana berhasil ditambahkan!');
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
        $kejadian = KejadianBencana::findOrFail($id);
        return view('pages.kejadian-bencana.edit', compact('kejadian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        $request->validate([
            'jenis_bencana'   => 'required|max:100',
            'tanggal'         => 'required|date',
            'lokasi'          => 'required|max:150',
            'rt'              => 'required|max:5',
            'rw'              => 'required|max:5',
            'dampak'          => 'required|max:150',
            'status_kejadian' => 'required|max:50',
            'keterangan'      => 'nullable',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');

        // Jika ada foto baru
        if ($request->hasFile('foto')) {
            $file        = $request->file('foto');
            $filename    = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('uploads/kejadian');

            if (! file_exists($destination)) {
                mkdir($destination, 0777, true);
            }

            // Jika ada foto lama, hapus dulu
            if ($kejadian->foto && file_exists(public_path($kejadian->foto))) {
                unlink(public_path($kejadian->foto));
            }

            // Pindahkan file baru
            $file->move($destination, $filename);
            $data['foto'] = 'uploads/kejadian/' . $filename;
        }

        // Update data lama, bukan create
        $kejadian->update($data);

        // ✅ Redirect dilakukan sekali di akhir
        return redirect()->route('kejadian-bencana.index')
            ->with('success', 'Data kejadian bencana berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        if ($kejadian->foto && Storage::disk('public')->exists($kejadian->foto)) {
            Storage::disk('public')->delete($kejadian->foto);
        }

        $kejadian->delete();

        return redirect()->route('kejadian-bencana.index')
            ->with('success', 'Data kejadian bencana berhasil dihapus!');
    }
}
