@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Daftar Warga</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <a href="{{ route('warga.create') }}" class="btn btn-primary mb-3">+ Tambah Warga</a>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form method="GET" class="row mb-3">

                    <div class="col-md-3">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari nama/alamat/HP...">
                    </div>

                    <div class="col-md-2">
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">Jenis Kelamin</option>
                            <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                    </div>

                    {{-- <div class="col-md-1">
                        <input type="text" name="rt" class="form-control" placeholder="RT"
                            value="{{ request('rt') }}">
                    </div>

                    <div class="col-md-1">
                        <input type="text" name="rw" class="form-control" placeholder="RW"
                            value="{{ request('rw') }}">
                    </div>

                    <div class="col-md-2">
                        <select name="per_page" class="form-control">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div> --}}

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">Filter</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('warga.index') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>RT</th>
                                <th>RW</th>
                                <th>Jenis Kelamin</th>
                                <th>No HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($warga as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->rt }}</td>
                                    <td>{{ $item->rw }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge-gender {{ strtolower($item->jenis_kelamin) == 'perempuan' ? 'badge-perempuan' : 'badge-laki' }}">
                                            {{ ucfirst($item->jenis_kelamin) }}
                                        </span>
                                    </td>
                                    <td>{{ $item->no_hp }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('warga.edit', $item->warga_id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>

                                        <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
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
                                    <td colspan="7" class="text-center">Belum ada data warga</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $warga->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
