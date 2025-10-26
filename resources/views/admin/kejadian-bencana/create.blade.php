@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Tambah Data Kejadian Bencana</h3>
    </div>
    <div class="card">
        <div class="card-body">
            {{-- Flash message --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('kejadian-bencana.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Jenis Bencana</label>
                    <input type="text" name="jenis_bencana" class="form-control" value="{{ old('jenis_bencana') }}"
                        required>
                </div>
                <div class="form-group">
                    <label>Tanggal Kejadian</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
                </div>
                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi') }}" required>
                </div>
                <div class="form-group">
                    <label>RT</label>
                    <input type="text" name="rt" class="form-control" value="{{ old('rt') }}" required>
                </div>
                <div class="form-group">
                    <label>RW</label>
                    <input type="text" name="rw" class="form-control" value="{{ old('rw') }}" required>
                </div>
                <div class="form-group">
                    <label>Dampak</label>
                    <input type="text" name="dampak" class="form-control" value="{{ old('dampak') }}" required>
                </div>
                <div class="form-group">
                    <label>Status Kejadian</label>
                    <select name="status_kejadian" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Aktif" {{ old('status_kejadian') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Selesai" {{ old('status_kejadian') == 'Selesai' ? 'selected' : '' }}>Selesai
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Foto (Opsional)</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
