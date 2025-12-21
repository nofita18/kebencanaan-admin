<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\KejadianBencana;
use App\Models\PoskoBencana;
use App\Models\DonasiBencana;
use App\Models\LogistikBencana;
use App\Models\DistribusiLogistik;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalWarga = Warga::count();
        $totalKejadian = KejadianBencana::count();
        $totalPosko = PoskoBencana::count();
        $totalDonasi = DonasiBencana::count();
        $totalLogistik = LogistikBencana::count();
        $totalDistribusi = DistribusiLogistik::count();

        return view('pages.dashboard.dashboard', compact(
            'totalWarga',
            'totalKejadian',
            'totalPosko',
            'totalDonasi',
            'totalLogistik',
            'totalDistribusi'
        ));
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
