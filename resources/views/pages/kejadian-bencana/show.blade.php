@extends('layouts.admin.app')

@section('content')
<div class="container py-4">

    <!-- Judul Halaman -->
    <h2 class="mb-4">Detail Kejadian Bencana</h2>

    <!-- Card utama -->
    <div class="card shadow-sm">
        <div class="card-body">

            <!-- Nama / Judul -->
            <h4 class="mb-3">{{ $kejadian->jenis_bencana ?? 'Tidak ada nama' }}</h4>

            <!-- Detail -->
            <table class="table table-bordered">
                <tr>
                    <th width="200">Tanggal Kejadian</th>
                    <td>{{ $kejadian->tanggal ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td>{{ $kejadian->lokasi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Dampak</th>
                    <td>{{ $kejadian->dampak ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $kejadian->status_kejadian ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $kejadian->keterangan ?? '-' }}</td>
                </tr>
            </table>

            <!-- Foto / Media -->
            <h5 class="mt-4">Foto / Dokumentasi</h5>

            @if(isset($media) && count($media) > 0)
                <div class="row mt-3">
                    @foreach ($media as $item)
                        <div class="col-md-3 mb-3">
                            <img src="{{ asset('storage/' . $item->file_path) }}"
                                 class="img-fluid rounded"
                                 style="border: 1px solid #ddd;">
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">Belum ada dokumentasi.</p>
            @endif

            <!-- Tombol Kembali -->
            <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-secondary mt-3">
                Kembali
            </a>

        </div>
    </div>
</div>
@endsection
