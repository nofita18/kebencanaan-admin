@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Daftar Logistik Bencana</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <a href="{{ route('logistik-bencana.create') }}" class="btn btn-primary mb-3">+ Tambah Logistik</a>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="GET" class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama barang / sumber / keterangan..." value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3">
                        <select name="kejadian_id" class="form-control">
                            <option value="">-- Filter Kejadian --</option>
                            @foreach ($kejadian as $k)
                                <option value="{{ $k->kejadian_id }}"
                                    {{ request('kejadian_id') == $k->kejadian_id ? 'selected' : '' }}>
                                    {{ $k->jenis_bencana }} - {{ $k->tanggal }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">Filter</button>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('logistik-bencana.index') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Kejadian</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Stok</th>
                                <th>Sumber</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logistik as $l)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $l->kejadian->jenis_bencana ?? '-' }}</td>
                                    <td>{{ $l->nama_barang }}</td>
                                    <td class="text-center">{{ $l->satuan }}</td>
                                    <td class="text-center">{{ $l->stok }}</td>
                                    <td>{{ $l->sumber ?? '-' }}</td>
                                    <td>{{ $l->keterangan ?? '-' }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('logistik-bencana.show', $l->logistik_id) }}"
                                            class="btn btn-sm btn-info mb-1">
                                            <i class="fa-solid fa-eye"></i> Detail
                                        </a>

                                        <a href="{{ route('logistik-bencana.edit', $l->logistik_id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <form action="{{ route('logistik-bencana.destroy', $l->logistik_id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Belum ada data logistik.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $logistik->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
