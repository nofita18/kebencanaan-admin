<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KejadianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kejadian = [
            [
                'kejadian_id' => 1,
                'jenis_bencana' => 'Banjir',
                'tanggal' => '2025-09-20',
                'lokasi_text' => 'Jl. Melati, Pekanbaru',
                'dampak' => '50 rumah terendam',
                'status_kejadian' => 'Darurat'
            ],
            [
                'kejadian_id' => 2,
                'jenis_bencana' => 'Kebakaran',
                'tanggal' => '2025-09-22',
                'lokasi_text' => 'Jl. Mawar, Pekanbaru',
                'dampak' => '3 rumah terbakar',
                'status_kejadian' => 'Selesai'
            ]
        ];

        return view('kejadian', compact('kejadian'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
