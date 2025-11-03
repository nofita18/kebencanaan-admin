@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Daftar Kejadian Bencana</h3>
        </div>
        <div class="card">
            <div class="card-body">
                {{-- Tombol tambah data --}}
                <a href="{{ route('kejadian-bencana.create') }}" class="btn btn-primary mb-3">+ Tambah
                    Kejadian</a>

                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                {{-- Tabel data --}}
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Bencana</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>RT</th>
                                <th>RW</th>
                                <th>Dampak</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kejadian as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->jenis_bencana }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td>{{ $item->rt }}</td>
                                    <td>{{ $item->rw }}</td>
                                    <td>{{ $item->dampak }}</td>
                                    <td>{{ $item->status_kejadian }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Bencana"
                                                width="80">
                                            {{-- <br>
                                            <small>{{ asset('storage/' . $item->foto) }}</small> --}}
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('kejadian-bencana.edit', $item->kejadian_id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>

                                        <form action="{{ route('kejadian-bencana.destroy', $item->kejadian_id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Belum ada data kejadian bencana
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
