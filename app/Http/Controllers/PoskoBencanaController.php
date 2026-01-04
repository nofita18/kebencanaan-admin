<?php
namespace App\Http\Controllers;
use App\Models\Media;
use App\Models\KejadianBencana;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PoskoBencanaController extends Controller
{
    public function index(Request $request)
    {
        $query = PoskoBencana::with('kejadian');
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', "%{$request->search}%")
                    ->orWhere('alamat', 'like', "%{$request->search}%")
                    ->orWhere('penanggung_jawab', 'like', "%{$request->search}%");
            });
        }
        if ($request->kejadian_id) {
            $query->where('kejadian_id', $request->kejadian_id);
        }
        $posko = $query->paginate(10)->withQueryString();
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
            'media_files.*'    => 'nullable|file|max:4096',
        ]);
        $posko = PoskoBencana::create($request->except('media_files'));
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs(
                    'uploads/posko_bencana',
                    $filename,
                    'public'
                );
                Media::create([
                    'ref_table' => 'posko_bencana',
                    'ref_id'    => $posko->posko_id,
                    'file_path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }
        return redirect()->route('posko-bencana.index')
            ->with('success', 'Data posko berhasil ditambahkan!');
    }
    public function show($id)
    {
        $posko = PoskoBencana::findOrFail($id);
        $media = Media::where('ref_table', 'posko_bencana')
            ->where('ref_id', $id)
            ->get();
        return view('pages.posko-bencana.show', compact('posko', 'media'));
    }

    public function edit($id)
    {
        $posko    = PoskoBencana::with('media')->findOrFail($id);
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

            'media_files.*'    => 'nullable|file|max:4096',
        ]);

        $posko->update($request->except('media_files'));
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs(
                    'uploads/posko_bencana',
                    $filename,
                    'public'
                );
                Media::create([
                    'ref_table' => 'posko_bencana',
                    'ref_id'    => $posko->posko_id,
                    'file_path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }
        return redirect()->route('posko-bencana.index')
            ->with('success', 'Data posko berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $posko = PoskoBencana::findOrFail($id);
        $media = Media::where('ref_table', 'posko_bencana')
            ->where('ref_id', $id)
            ->get();

        foreach ($media as $item) {
            if (Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }
            $item->delete();
        }
        $posko->delete();
        return redirect()->route('posko-bencana.index')
            ->with('success', 'Data posko berhasil dihapus!');
    }
}
