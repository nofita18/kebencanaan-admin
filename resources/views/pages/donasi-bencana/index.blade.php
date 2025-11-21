@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Daftar Donasi Bencana</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <a href="{{ route('donasi-bencana.create') }}" class="btn btn-primary mb-3">+ Tambah Donasi</a>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form method="GET" class="row mb-3">

                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama donatur / jenis / catatan..." value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3">
                        <select name="kejadian_id" class="form-control">
                            <option value="">-- Filter Kejadian --</option>
                            @foreach ($kejadian as $k)
                                <option value="{{ $k->kejadian_id }}"
                                    {{ request('kejadian_id') == $k->kejadian_id ? 'selected' : '' }}>
                                    {{ $k->jenis_bencana }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="col-md-3">
                        <select name="posko_id" class="form-control">
                            <option value="">-- Filter Posko --</option>
                            @foreach ($posko as $p)
                                <option value="{{ $p->posko_id }}"
                                    {{ request('posko_id') == $p->posko_id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="col-md-2 mt-2 mt-md-0">
                        <button class="btn btn-primary w-100">Filter</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('donasi-bencana.index') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>

                </form>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Donatur</th>
                                <th>Jenis Donasi</th>
                                <th>Nilai (Rp)</th>
                                <th>Kejadian</th>
                                <th>Bukti</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($donasi as $d)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $d->donatur_nama }}</td>
                                    <td>{{ $d->jenis }}</td>
                                    <td>Rp {{ number_format($d->nilai, 2, ',', '.') }}</td>
                                    <td>{{ $d->kejadian->jenis_bencana ?? '-' }}</td>

                                    <td class="text-center">
                                        @if ($d->bukti)
                                            <img src="{{ asset('storage/donasi_bencana/' . $d->bukti) }}" width="70"
                                                alt="bukti">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('donasi-bencana.edit', $d->donasi_id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>

                                        <form action="{{ route('donasi-bencana.destroy', $d->donasi_id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                                    <td colspan="7" class="text-center text-muted">Belum ada data donasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $donasi->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
