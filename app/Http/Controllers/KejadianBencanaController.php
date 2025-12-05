<?php
namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KejadianBencanaController extends Controller
{
    public function index(Request $request)
    {
        $query = KejadianBencana::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('jenis_bencana', 'like', "%{$request->search}%")
                    ->orWhere('lokasi', 'like', "%{$request->search}%")
                    ->orWhere('dampak', 'like', "%{$request->search}%")
                    ->orWhere('keterangan', 'like', "%{$request->search}%");
            });
        }

        if ($request->status_kejadian) {
            $query->where('status_kejadian', $request->status_kejadian);
        }

        if ($request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $kejadian = $query->paginate(10)->withQueryString();

        return view('pages.kejadian-bencana.index', compact('kejadian'));
    }

    public function create()
    {
        return view('pages.kejadian-bencana.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_bencana'   => 'required',
            'tanggal'         => 'required|date',
            'lokasi'          => 'required',
            'rt'              => 'required',
            'rw'              => 'required',
            'dampak'          => 'required',
            'status_kejadian' => 'required',
            'keterangan'      => 'nullable',

            // file utama
            'upload_ev'       => 'nullable|file|max:4096',

            // banyak media
            'media_files.*'   => 'nullable|file|max:4096',
        ]);

        // SIMPAN DATA TANPA FILE
        $kejadian = KejadianBencana::create(
            $request->except('upload_ev', 'media_files', 'foto')
        );

        //  SIMPAN FILE UTAMA
        if ($request->hasFile('upload_ev')) {

            $file     = $request->file('upload_ev');
            $filename = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs(
                'uploads/kejadian_bencana',
                $filename,
                'public'
            );

            $kejadian->update([
                'upload_ev' => $path,
            ]);
        }

        //  SIMPAN MEDIA MULTIPLE
        if ($request->hasFile('media_files')) {

            foreach ($request->file('media_files') as $file) {

                $filename = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs(
                    'uploads/kejadian_bencana/media',
                    $filename,
                    'public'
                );

                Media::create([
                    'ref_table' => 'kejadian_bencana',
                    'ref_id'    => $kejadian->kejadian_id,
                    'file_path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('kejadian-bencana.index')
            ->with('success', 'Data kejadian bencana berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        $media = Media::where('ref_table', 'kejadian_bencana')
            ->where('ref_id', $id)
            ->get();

        return view('pages.kejadian-bencana.show', compact('kejadian', 'media'));
    }

    public function edit(string $id)
    {
        $kejadian = KejadianBencana::findOrFail($id);
        return view('pages.kejadian-bencana.edit', compact('kejadian'));
    }

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

            'upload_ev'       => 'nullable|file|max:4096',
            'media_files.*'   => 'nullable|file|max:4096',
        ]);

        $data = $request->except('upload_ev', 'media_files', 'foto');

        // ======================================
        // UPDATE FILE UTAMA (hapus lama → ganti)
        // ======================================
        if ($request->hasFile('upload_ev')) {

            if ($kejadian->upload_ev && Storage::disk('public')->exists($kejadian->upload_ev)) {
                Storage::disk('public')->delete($kejadian->upload_ev);
            }

            $file     = $request->file('upload_ev');
            $filename = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs(
                'uploads/kejadian_bencana',
                $filename,
                'public'
            );

            $data['upload_ev'] = $path;
        }

        $kejadian->update($data);

        // ======================
        // TAMBAH MEDIA BARU
        // ======================
        if ($request->hasFile('media_files')) {

            foreach ($request->file('media_files') as $file) {

                $filename = time() . '_' . $file->getClientOriginalName();

                $path = $file->storeAs(
                    'uploads/kejadian_bencana/media',
                    $filename,
                    'public'
                );

                Media::create([
                    'ref_table' => 'kejadian_bencana',
                    'ref_id'    => $kejadian->kejadian_id,
                    'file_path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('kejadian-bencana.index')
            ->with('success', 'Data kejadian bencana berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $kejadian = KejadianBencana::findOrFail($id);

        if ($kejadian->upload_ev && Storage::disk('public')->exists($kejadian->upload_ev)) {
            Storage::disk('public')->delete($kejadian->upload_ev);
        }

        // Hapus semua media terkait
        $media = Media::where('ref_table', 'kejadian_bencana')
            ->where('ref_id', $id)
            ->get();

        foreach ($media as $item) {
            if (Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }
            $item->delete();
        }

        $kejadian->delete();

        return redirect()->route('kejadian-bencana.index')
            ->with('success', 'Data kejadian bencana berhasil dihapus!');
    }
}
