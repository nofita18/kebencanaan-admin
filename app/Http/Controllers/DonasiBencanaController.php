<?php
namespace App\Http\Controllers;

use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use App\Models\Media;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonasiBencanaController extends Controller
{
    public function index(Request $request)
    {
        $query = DonasiBencana::with(['kejadian', 'posko']);
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('donatur_nama', 'like', "%{$request->search}%")
                    ->orWhere('jenis', 'like', "%{$request->search}%")
                    ->orWhere('catatan', 'like', "%{$request->search}%");
            });
        }
        if ($request->kejadian_id) {
            $query->where('kejadian_id', $request->kejadian_id);
        }
        if ($request->posko_id) {
            $query->where('posko_id', $request->posko_id);
        }
        $donasi = $query->paginate(10)->withQueryString();
        $kejadian = KejadianBencana::all();
        $posko    = PoskoBencana::all();
        return view('pages.donasi-bencana.index', compact('donasi', 'kejadian', 'posko'));
    }

    public function create()
    {
        $kejadian = KejadianBencana::all();
        $posko    = PoskoBencana::all();

        return view('pages.donasi-bencana.create', compact('kejadian', 'posko'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'donatur_nama'  => 'required|string',
            'jenis'         => 'required|string',
            'nilai'         => 'nullable|numeric',
            'kejadian_id'   => 'required|exists:kejadian_bencana,kejadian_id',
            'posko_id'      => 'nullable',
            'catatan'       => 'nullable|string',
            'media_files.*' => 'nullable|file|max:4096',
        ]);
        $donasi = DonasiBencana::create($request->except('media_files'));
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $path = $file->store('uploads/donasi_bencana', 'public');

                Media::create([
                    'ref_table' => 'donasi_bencana',
                    'ref_id'    => $donasi->donasi_id,
                    'file_path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }
        return redirect()->route('donasi-bencana.index')
            ->with('success', 'Donasi berhasil ditambahkan');
    }
    public function show($id)
    {
        $donasi = DonasiBencana::with(['kejadian', 'posko'])->findOrFail($id);
        $media = Media::where('ref_table', 'donasi_bencana')
            ->where('ref_id', $donasi->donasi_id)
            ->get();

        return view('pages.donasi-bencana.show', compact('donasi', 'media'));
    }

    public function edit($id)
    {
        $donasi   = DonasiBencana::findOrFail($id);
        $kejadian = KejadianBencana::all();
        $posko    = PoskoBencana::all();

        return view('pages.donasi-bencana.edit', compact('donasi', 'kejadian', 'posko'));
    }

    public function update(Request $request, $id)
    {
        $donasi = DonasiBencana::findOrFail($id);
        $request->validate([
            'donatur_nama'  => 'required|string',
            'jenis'         => 'required|string',
            'nilai'         => 'nullable|numeric',
            'kejadian_id'   => 'required|exists:kejadian_bencana,kejadian_id',
            'posko_id'      => 'nullable',
            'catatan'       => 'nullable|string',
            'media_files.*' => 'nullable|file|max:4096',
        ]);
        $donasi->update($request->except('media_files'));
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $path = $file->store('uploads/donasi_bencana', 'public');

                Media::create([
                    'ref_table' => 'donasi_bencana',
                    'ref_id'    => $donasi->donasi_id,
                    'file_path' => $path,
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }
        return redirect()->route('donasi-bencana.index')
            ->with('success', 'Donasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $donasi = DonasiBencana::findOrFail($id);
        if ($donasi->bukti_donasi && Storage::disk('public')->exists($donasi->bukti_donasi)) {
            Storage::disk('public')->delete($donasi->bukti_donasi);
        }

        $donasi->delete();
        return redirect()->route('donasi-bencana.index')->with('success', 'Donasi berhasil dihapus');
    }
}
