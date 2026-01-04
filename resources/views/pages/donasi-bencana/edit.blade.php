@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Donasi Bencana</h3>
        </div>

        {{-- Error Validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('donasi-bencana.update', $donasi->donasi_id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="donatur_nama">Nama Donatur</label>
                        <input type="text" name="donatur_nama" id="donatur_nama" class="form-control"
                            value="{{ old('donatur_nama', $donasi->donatur_nama) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis">Jenis Donasi</label>
                        <input type="text" name="jenis" id="jenis" class="form-control"
                            value="{{ old('jenis', $donasi->jenis) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nilai">Nilai Donasi (Rp)</label>
                        <input type="number" step="0.01" name="nilai" id="nilai" class="form-control"
                            value="{{ old('nilai', $donasi->nilai) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="kejadian_id">Kejadian Bencana</label>
                        <select name="kejadian_id" id="kejadian_id" class="form-control" required>
                            @foreach ($kejadian as $k)
                                <option value="{{ $k->kejadian_id }}"
                                    {{ old('kejadian_id', $donasi->kejadian_id) == $k->kejadian_id ? 'selected' : '' }}>
                                    {{ $k->jenis_bencana }} - {{ $k->lokasi_text }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bukti Donasi Saat Ini:</label><br>

                        @if ($donasi->media->count())
                            @foreach ($donasi->media as $m)
                                <img src="{{ asset('storage/' . $m->file_path) }}" width="150" class="rounded mb-2 me-2">
                            @endforeach
                        @else
                            <p class="text-muted">Belum ada bukti.</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tambah Bukti Donasi</label>
                        <input type="file" name="media_files[]" class="form-control" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-rotate-right"></i> Update
                    </button>
                    <a href="{{ route('donasi-bencana.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
