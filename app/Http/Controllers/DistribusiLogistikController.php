<?php
namespace App\Http\Controllers;

use App\Models\DistribusiLogistik;
use App\Models\LogistikBencana;
use App\Models\Media;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DistribusiLogistikController extends Controller
{
    public function index(Request $request)
    {
        $query = DistribusiLogistik::with(['logistik', 'posko']);
        if ($request->search) {
            $query->whereHas('logistik', function ($q) use ($request) {
                $q->where('nama_barang', 'like', "%{$request->search}%");
            });
        }
        if ($request->posko_id) {
            $query->where('posko_id', $request->posko_id);
        }
        $distribusi = $query->paginate(10)->withQueryString();
        $posko      = PoskoBencana::all();
        return view('pages.distribusi-logistik.index', compact('distribusi', 'posko'));
    }

    public function create()
    {
        $logistik = LogistikBencana::all();
        $posko    = PoskoBencana::all();

        return view('pages.distribusi-logistik.create', compact('logistik', 'posko'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logistik_id' => 'required|integer',
            'posko_id'    => 'required|integer',
            'tanggal'     => 'required|date',
            'jumlah'      => 'required|integer',
            'penerima'    => 'nullable|string|max:100',
            'keterangan'  => 'nullable|string',
            'bukti'       => 'nullable|file|max:4096',
        ]);
        $distribusi = DistribusiLogistik::create($request->except('bukti'));
        if ($request->hasFile('bukti')) {
            $file     = $request->file('bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path     = $file->storeAs('uploads/distribusi_logistik', $filename, 'public');
            Media::create([
                'ref_table' => 'distribusi_logistik',
                'ref_id'    => $distribusi->distribusi_id,
                'file_path' => $path,
                'mime_type' => $file->getClientMimeType(),
            ]);
        }
        return redirect()->route('distribusi-logistik.index')
            ->with('success', 'Distribusi logistik berhasil ditambahkan!');
    }

    public function show($id)
    {
        $distribusi = DistribusiLogistik::with(['logistik', 'posko', 'media'])->findOrFail($id);
        return view('pages.distribusi-logistik.show', compact('distribusi'));
    }

    public function edit($id)
    {
        $distribusi = DistribusiLogistik::findOrFail($id);
        $logistik   = LogistikBencana::all();
        $posko      = PoskoBencana::all();
        return view('pages.distribusi-logistik.edit', compact('distribusi', 'logistik', 'posko'));
    }

    public function update(Request $request, $id)
    {
        $distribusi = DistribusiLogistik::findOrFail($id);
        $request->validate([
            'logistik_id' => 'required|integer',
            'posko_id'    => 'required|integer',
            'tanggal'     => 'required|date',
            'jumlah'      => 'required|integer',
            'penerima'    => 'nullable|string|max:100',
            'keterangan'  => 'nullable|string',
            'bukti'       => 'nullable|file|max:4096',
        ]);
        $distribusi->update($request->except('bukti'));
        if ($request->hasFile('bukti')) {
            if ($distribusi->media && Storage::disk('public')->exists($distribusi->media->file_path)) {
                Storage::disk('public')->delete($distribusi->media->file_path);
                $distribusi->media->delete();
            }
            $file     = $request->file('bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path     = $file->storeAs('uploads/distribusi_logistik', $filename, 'public');
            Media::create([
                'ref_table' => 'distribusi_logistik',
                'ref_id'    => $distribusi->distribusi_id,
                'file_path' => $path,
                'mime_type' => $file->getClientMimeType(),
            ]);
        }
        return redirect()->route('distribusi-logistik.index')
            ->with('success', 'Distribusi logistik berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $distribusi = DistribusiLogistik::findOrFail($id);
        if ($distribusi->media && Storage::disk('public')->exists($distribusi->media->file_path)) {
            Storage::disk('public')->delete($distribusi->media->file_path);
            $distribusi->media->delete();
        }
        $distribusi->delete();
        return redirect()->route('distribusi-logistik.index')
            ->with('success', 'Distribusi logistik berhasil dihapus!');
    }
}
