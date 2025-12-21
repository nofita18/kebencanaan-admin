@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Detail Donasi Bencana</h3>
    <a href="{{ route('donasi-bencana.index') }}" class="btn btn-secondary mb-3">
        <i class="fa-solid fa-arrow-left"></i> Kembali
    </a>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered">
                <tr><th width="200">Donatur</th><td>{{ $donasi->donatur_nama }}</td></tr>
                <tr><th>Jenis Donasi</th><td>{{ $donasi->jenis }}</td></tr>
                <tr><th>Nilai</th><td>{{ $donasi->nilai ?? '-' }}</td></tr>
                <tr><th>Kejadian</th><td>{{ $donasi->kejadian->jenis_bencana ?? '-' }}</td></tr>
            </table>
            <h5 class="mt-4">Bukti / Dokumentasi Donasi</h5>
            @if($media->count())
                <div class="row mt-3">
                    @foreach($media as $m)
                        <div class="col-md-3 mb-3">
                            <img src="{{ asset('storage/'.$m->file_path) }}"
                                 class="img-fluid rounded border">
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">Belum ada dokumentasi.</p>
            @endif

        </div>
    </div>
</div>
@endsection
