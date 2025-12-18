@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Daftar Distribusi Logistik</h3>
    </div>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('distribusi-logistik.create') }}" class="btn btn-primary mb-3">+ Tambah Distribusi</a>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="GET" class="row mb-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari logistik..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="posko_id" class="form-control">
                        <option value="">-- Filter Posko --</option>
                        @foreach ($posko as $p)
                            <option value="{{ $p->posko_id }}" {{ request('posko_id') == $p->posko_id ? 'selected' : '' }}>
                                {{ $p->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('distribusi-logistik.index') }}" class="btn btn-secondary w-100">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Logistik</th>
                            <th>Posko</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Penerima</th>
                            <th>Keterangan</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($distribusi as $d)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $d->logistik->nama_barang ?? '-' }}</td>
                            <td>{{ $d->posko->nama ?? '-' }}</td>
                            <td class="text-center">{{ $d->tanggal }}</td>
                            <td class="text-center">{{ $d->jumlah }}</td>
                            <td>{{ $d->penerima ?? '-' }}</td>
                            <td>{{ $d->keterangan ?? '-' }}</td>
                            <td class="text-center">
                                @if ($d->media)
                                    <img src="{{ asset('storage/' . $d->media->file_path) }}" width="70" alt="Bukti">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('distribusi-logistik.show', $d->distribusi_id) }}" class="btn btn-info btn-sm">
                                    Detail
                                </a>
                                <a href="{{ route('distribusi-logistik.edit', $d->distribusi_id) }}" class="btn btn-sm btn-warning">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                                <form action="{{ route('distribusi-logistik.destroy', $d->distribusi_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                            <td colspan="9" class="text-center text-muted">Belum ada data distribusi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $distribusi->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
