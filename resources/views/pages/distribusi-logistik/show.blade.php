@extends('layouts.admin.app')

@section('content')
<div class="container py-4">

    <h2 class="mb-4">Detail Distribusi Logistik</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Tombol Kembali -->
            <a href="{{ route('distribusi-logistik.index') }}" class="btn btn-secondary mb-3">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>

            <!-- Tabel Informasi Distribusi -->
            <table class="table table-bordered">
                <tr>
                    <th width="200">Logistik</th>
                    <td>{{ $distribusi->logistik->nama_barang ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Posko</th>
                    <td>{{ $distribusi->posko->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Distribusi</th>
                    <td>{{ $distribusi->tanggal ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>{{ $distribusi->jumlah ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Penerima</th>
                    <td>{{ $distribusi->penerima ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $distribusi->keterangan ?? '-' }}</td>
                </tr>
            </table>

            <!-- Media / Bukti Distribusi -->
            <h5 class="mt-4">Bukti Distribusi</h5>

            @if(isset($distribusi->media) && $distribusi->media)
                <div class="row mt-3">
                    <div class="col-md-3 mb-3">
                        <img src="{{ asset('storage/' . $distribusi->media->file_path) }}"
                             class="img-fluid rounded"
                             style="border: 1px solid #ddd;">
                    </div>
                </div>
            @else
                <p class="text-muted">Belum ada bukti distribusi.</p>
            @endif

        </div>
    </div>
</div>
@endsection
