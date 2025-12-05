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
                <form method="GET" class="row mb-3">

                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari jenis bencana / lokasi / dampak..." value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3">
                        <select name="status_kejadian" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="Aktif" {{ request('status_kejadian') == 'Aktif' ? 'selected' : '' }}>Aktif
                            </option>
                            <option value="Selesai" {{ request('status_kejadian') == 'Selesai' ? 'selected' : '' }}>Selesai
                            </option>
                        </select>
                    </div>

                    {{-- <div class="col-md-3">
                        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                    </div> --}}

                    <div class="col-md-2 mt-2 mt-md-0">
                        <button class="btn btn-primary w-100">Filter</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>

                </form>

                {{-- <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-secondary mb-3">Reset</a> --}}

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
                                <th>Foto/Berita acara</th>
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
                                    <td class="text-center">
                                        <span
                                            class="badge-status {{ strtolower($item->status_kejadian) == 'aktif' ? 'badge-aktif' : 'badge-selesai' }}">
                                            {{ ucfirst($item->status_kejadian) }}
                                        </span>
                                    </td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('kejadian-bencana.show', $item->kejadian_id) }}"
                                            class="btn btn-warning btn-sm">
                                            Lihat Detail
                                        </a>
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
                    <div class="mt-3">
                        {{ $kejadian->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
