@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Data User</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">+ Tambah User</a>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form method="GET" class="row mb-3">

                    <div class="col-md-3">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Cari nama / email...">
                    </div>

                    <div class="col-md-3">
                        <select name="email_domain" class="form-control">
                            <option value="">Filter Domain Email</option>
                            <option value="gmail.com" {{ request('email_domain') == 'gmail.com' ? 'selected' : '' }}>Gmail
                            </option>
                            <option value="yahoo.com" {{ request('email_domain') == 'yahoo.com' ? 'selected' : '' }}>Yahoo
                            </option>
                            <option value="outlook.com" {{ request('email_domain') == 'outlook.com' ? 'selected' : '' }}>
                                Outlook</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="per_page" class="form-control">
                            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">Filter</button>
                    </div>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary mb-3">Reset</a>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>

                                        <form action="{{ route('users.destroy', $item->id) }}" method="POST"
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
                                    <td colspan="4" class="text-center">Belum ada data user</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
