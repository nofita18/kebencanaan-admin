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
                                    @if ($p->foto)
                                        <img src="{{ asset('storage/posko/'.$p->foto) }}" width="70" alt="foto posko">
                                    @else
                                        <span class="text-muted">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('posko-bencana.edit', $p->posko_id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('posko-bencana.destroy', $p->posko_id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
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
            </div>
        </div>
    </div>
</div>
@endsection
