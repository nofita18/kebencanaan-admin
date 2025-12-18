<?php

namespace App\Http\Controllers;

use App\Models\LogistikBencana;
use App\Models\KejadianBencana;
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
        $kejadian  = KejadianBencana::all();

        return view('pages.logistik-bencana.index', compact('logistik', 'kejadian'));
    }

    // 2️⃣ CREATE
    public function create()
    {
        $kejadian = KejadianBencana::all();
        return view('pages.logistik-bencana.create', compact('kejadian'));
    }

    // 3️⃣ STORE
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

        LogistikBencana::create($request->all());

        return redirect()->route('logistik-bencana.index')
                         ->with('success', 'Data logistik berhasil ditambahkan!');
    }

    // 4️⃣ EDIT
    public function edit($id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        $kejadian  = KejadianBencana::all();
        return view('pages.logistik-bencana.edit', compact('logistik', 'kejadian'));
    }

    // 5️⃣ UPDATE
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

        $logistik->update($request->all());

        return redirect()->route('logistik-bencana.index')
                         ->with('success', 'Data logistik berhasil diperbarui!');
    }

    // 6️⃣ DESTROY
    public function destroy($id)
    {
        $logistik = LogistikBencana::findOrFail($id);
        $logistik->delete();

        return redirect()->route('logistik-bencana.index')
                         ->with('success', 'Data logistik berhasil dihapus!');
    }
}
