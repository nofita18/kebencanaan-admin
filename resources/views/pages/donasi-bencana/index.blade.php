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
                                            <img src="{{ asset('storage/donasi_bencana/' . $d->bukti) }}"
                                                 width="70" alt="bukti">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('donasi-bencana.edit', $d->donasi_id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>

                                        <form action="{{ route('donasi-bencana.destroy', $d->donasi_id) }}"
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
                                    <td colspan="7" class="text-center text-muted">Belum ada data donasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
