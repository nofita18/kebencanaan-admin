<?php
namespace App\Http\Controllers;

use App\Models\KejadianBencana;
use App\Models\LogistikBencana;
use Illuminate\Http\Request;

class LogistikBencanaController extends Controller
{
    // 1️⃣ INDEX
    public function index(Request $request)
    {
        $query = LogistikBencana::with(['kejadian', 'media']);
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
            'kejadian_id' => 'required|integer',
            'nama_barang' => 'required|string|max:100',
            'satuan'      => 'required|string|max:50',
            'stok'        => 'required|integer',
            'sumber'      => 'nullable|string|max:100',
            'keterangan'  => 'nullable|string',
        ]);
        $logistik = LogistikBencana::create($request->except('media_files'));
        return redirect()->route('logistik-bencana.index')
            ->with('success', 'Data logistik berhasil ditambahkan!');
    }

    public function show($id)
    {
        //show
    }
    public function edit($id)
    {
        $logistik = LogistikBencana::with('media')->findOrFail($id);
        $kejadian = KejadianBencana::all();
        return view('pages.logistik-bencana.edit', compact('logistik', 'kejadian'));
    }

    public function update(Request $request, $id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        $request->validate([
            'kejadian_id' => 'required|integer',
            'nama_barang' => 'required|string|max:100',
            'satuan'      => 'required|string|max:50',
            'stok'        => 'required|integer',
            'sumber'      => 'nullable|string|max:100',
            'keterangan'  => 'nullable|string',
        ]);
        $logistik->update($request->except('media_files'));
        return redirect()->route('logistik-bencana.index')
            ->with('success', 'Data logistik berhasil diperbarui!');
    }
    public function destroy($id)
    {
        LogistikBencana::findOrFail($id)->delete();

        return redirect()->route('logistik-bencana.index')
            ->with('success', 'Data logistik berhasil dihapus!');
    }
}
