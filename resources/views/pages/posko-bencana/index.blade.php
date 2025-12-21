@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Daftar Posko Bencana</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <a href="{{ route('posko-bencana.create') }}" class="btn btn-primary mb-3">+ Tambah Posko</a>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form method="GET" class="row mb-3">

                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama posko / alamat / penanggung jawab..." value="{{ request('search') }}">
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

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">Filter</button>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('posko-bencana.index') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Posko</th>
                                <th>Alamat</th>
                                <th>Kontak</th>
                                <th>Penanggung Jawab</th>
                                <th>Kejadian</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posko as $p)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->alamat }}</td>
                                    <td>{{ $p->kontak ?? '-' }}</td>
                                    <td>{{ $p->penanggung_jawab ?? '-' }}</td>
                                    <td>{{ $p->kejadian->jenis_bencana ?? '-' }}</td>
                                    <td class="text-center">
                                        @php
                                            $foto = $p->media->first();
                                        @endphp
                                        @if ($foto)
                                            <img src="{{ asset('storage/' . $foto->file_path) }}" width="70"
                                                class="rounded" alt="Foto Posko">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('posko-bencana.show', $p->posko_id) }}"
                                            class="btn btn-sm btn-info mb-1">
                                            <i class="fa-solid fa-eye"></i> Detail
                                        </a>

                                        <a href="{{ route('posko-bencana.edit', $p->posko_id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <form action="{{ route('posko-bencana.destroy', $p->posko_id) }}" method="POST"
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
                                    <td colspan="8" class="text-center text-muted">Belum ada data posko.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $posko->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
