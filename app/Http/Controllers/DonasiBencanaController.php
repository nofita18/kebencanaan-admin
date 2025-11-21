<?php
namespace App\Http\Controllers;

use App\Models\DonasiBencana;
use App\Models\KejadianBencana;
use App\Models\PoskoBencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonasiBencanaController extends Controller
{
    public function index(Request $request)
    {
        $query = DonasiBencana::with(['kejadian', 'posko']);

        // --- SEARCH donor, jenis, catatan ---
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('donatur_nama', 'like', "%{$request->search}%")
                    ->orWhere('jenis', 'like', "%{$request->search}%")
                    ->orWhere('catatan', 'like', "%{$request->search}%");
            });
        }

        // --- FILTER berdasarkan kejadian ---
        if ($request->kejadian_id) {
            $query->where('kejadian_id', $request->kejadian_id);
        }

        // --- FILTER berdasarkan posko ---
        if ($request->posko_id) {
            $query->where('posko_id', $request->posko_id);
        }

        // PAGINATION
        $donasi = $query->paginate(10)->withQueryString();

        // data dropdown filter
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
            'donatur_nama' => 'required|string',
            'jenis'        => 'required|string',
            'nilai'        => 'nullable|numeric',
            'kejadian_id'  => 'required|exists:kejadian_bencana,kejadian_id',
            'posko_id'     => 'nullable',
            'catatan'      => 'nullable|string',
            'bukti'        => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('bukti_donasi')) {
            $data['bukti_donasi'] = $request->file('bukti_donasi')->store('bukti-donasi', 'public');
        }

        DonasiBencana::create($data);

        return redirect()->route('donasi-bencana.index')->with('success', 'Donasi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $donasi   = DonasiBencana::findOrFail($id);
        $kejadian = KejadianBencana::all();
        $posko    = PoskoBencana::all();

        return view('pages.donasi-bencana.edit', compact('donasi', 'kejadian', 'posko'));
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $donasi = DonasiBencana::findOrFail($id);

        $request->validate([
            'donatur_nama' => 'required|string',
            'jenis'        => 'required|string',
            'nilai'        => 'nullable|numeric',
            'kejadian_id'  => 'required|exists:kejadian_bencana,kejadian_id',
            'posko_id'     => 'nullable',
            'catatan'      => 'nullable|string',
            'bukti'        => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('bukti_donasi')) {

            // delete old file
            if ($donasi->bukti_donasi && Storage::disk('public')->exists($donasi->bukti_donasi)) {
                Storage::disk('public')->delete($donasi->bukti_donasi);
            }

            $data['bukti_donasi'] = $request->file('bukti_donasi')->store('bukti-donasi', 'public');
        }

        $donasi->update($data);

        return redirect()->route('donasi-bencana.index')->with('success', 'Donasi berhasil diperbarui');
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
