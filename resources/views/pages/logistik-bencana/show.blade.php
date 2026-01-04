@extends('layouts.admin.app')

@section('content')
    <div class="container py-4">

        <h2 class="mb-4">Detail Logistik Bencana</h2>
        <div class="card shadow-sm">
            <div class="card-body">
                <a href="{{ route('logistik-bencana.index') }}" class="btn btn-secondary mb-3">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
                <table class="table table-bordered">
                    <tr>
                        <th width="200">Nama Barang</th>
                        <td>{{ $logistik->nama_barang ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Satuan</th>
                        <td>{{ $logistik->satuan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>{{ $logistik->stok ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Sumber</th>
                        <td>{{ $logistik->sumber ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $logistik->keterangan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Kejadian Bencana</th>
                        <td>{{ $logistik->kejadian->jenis_bencana ?? '-' }} ({{ $logistik->kejadian->tanggal ?? '-' }})</td>
                    </tr>
                </table>
                <h5 class="mt-4">Media</h5>

                @if ($logistik->media->count())
                    <div class="row mt-3">
                        @foreach ($logistik->media as $media)
                            <div class="col-md-3 mb-3">
                                <img src="{{ asset('storage/' . $media->file_path) }}" class="img-fluid rounded"
                                    style="border: 1px solid #ddd;">
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Belum ada media untuk logistik ini.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
