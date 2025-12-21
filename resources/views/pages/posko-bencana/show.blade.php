@extends('layouts.admin.app')

@section('content')
<div class="container py-4">

    <h2 class="mb-4">Detail Posko Bencana</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Tombol Kembali -->
            <a href="{{ route('posko-bencana.index') }}" class="btn btn-secondary mb-3">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
            <!-- Tabel Informasi Posko -->
            <table class="table table-bordered">
                <tr>
                    <th width="200">Nama Posko</th>
                    <td>{{ $posko->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Kejadian Bencana</th>
                    <td>{{ $posko->kejadian->jenis_bencana ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $posko->alamat ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Kontak</th>
                    <td>{{ $posko->kontak ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Penanggung Jawab</th>
                    <td>{{ $posko->penanggung_jawab ?? '-' }}</td>
                </tr>
            </table>
            <!-- Media / Dokumentasi Posko -->
            <h5 class="mt-4">Foto / Dokumentasi Posko</h5>
            @if(isset($media) && $media->count())
                <div class="row mt-3">
                    @foreach($media as $item)
                        <div class="col-md-3 mb-3">
                            <img src="{{ asset('storage/' . $item->file_path) }}"
                                 class="img-fluid rounded"
                                 style="border: 1px solid #ddd;">
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">Belum ada dokumentasi posko.</p>
            @endif
        </div>
    </div>
</div>
@endsection
