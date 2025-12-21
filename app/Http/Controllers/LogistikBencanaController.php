<?php
namespace App\Http\Controllers;
use App\Models\Media;
use App\Models\KejadianBencana;
use App\Models\LogistikBencana;
use Illuminate\Http\Request;

class LogistikBencanaController extends Controller
{
    // 1️⃣ INDEX
    public function index(Request $request)
    {
        $query = LogistikBencana::query();
        if ($request->search) {
            $query->where('nama_barang', 'like', "%{$request->search}%")
                ->orWhere('satuan', 'like', "%{$request->search}%")
                ->orWhere('sumber', 'like', "%{$request->search}%")
                ->orWhere('keterangan', 'like', "%{$request->search}%");
        }

        if ($request->kejadian_id) {
            $query->where('kejadian_id', $request->kejadian_id);
        }
        $logistik = $query->paginate(10)->withQueryString();
        $kejadian = KejadianBencana::all();
        return view('pages.logistik-bencana.index', compact('logistik', 'kejadian'));
    }

    public function create()
    {
        $kejadian = KejadianBencana::all();
        return view('pages.logistik-bencana.create', compact('kejadian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kejadian_id'   => 'required|integer',
            'nama_barang'   => 'required|string|max:100',
            'satuan'        => 'required|string|max:50',
            'stok'          => 'required|integer',
            'sumber'        => 'nullable|string|max:100',
            'keterangan'    => 'nullable|string',
            'media_files.*' => 'nullable|file|max:4096', // tambahan media
        ]);
        $logistik = LogistikBencana::create($request->except('media_files'));
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path     = $file->storeAs('uploads/logistik_bencana', $filename, 'public');
                \App\Models\Media::create([
                    'ref_table' => 'logistik_bencana',
                    'ref_id'    => $logistik->logistik_id,
                    'file_path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }
        return redirect()->route('logistik-bencana.index')
            ->with('success', 'Data logistik berhasil ditambahkan!');
    }

    public function show($id)
    {
        $logistik = LogistikBencana::with('kejadian')->findOrFail($id);
        $media = Media::where('ref_table', 'logistik_bencana')
            ->where('ref_id', $logistik->logistik_id)
            ->get();

        return view('pages.logistik-bencana.show', compact('logistik', 'media'));
    }
    public function edit($id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        $kejadian = KejadianBencana::all();
        return view('pages.logistik-bencana.edit', compact('logistik', 'kejadian'));
    }

    public function update(Request $request, $id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        $request->validate([
            'kejadian_id'   => 'required|integer',
            'nama_barang'   => 'required|string|max:100',
            'satuan'        => 'required|string|max:50',
            'stok'          => 'required|integer',
            'sumber'        => 'nullable|string|max:100',
            'keterangan'    => 'nullable|string',
            'media_files.*' => 'nullable|file|max:4096', // tambahan media
        ]);
        $logistik->update($request->except('media_files'));
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path     = $file->storeAs('uploads/logistik_bencana', $filename, 'public');

                \App\Models\Media::create([
                    'ref_table' => 'logistik_bencana',
                    'ref_id'    => $logistik->logistik_id,
                    'file_path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }
        return redirect()->route('logistik-bencana.index')
            ->with('success', 'Data logistik berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        $media = \App\Models\Media::where('ref_table', 'logistik_bencana')
            ->where('ref_id', $logistik->logistik_id)
            ->get();
        foreach ($media as $item) {
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($item->file_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($item->file_path);
            }
            $item->delete();
        }

        $logistik->delete();
        return redirect()->route('logistik-bencana.index')
            ->with('success', 'Data logistik berhasil dihapus!');
    }
}
