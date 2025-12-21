@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Tambah Data Logistik Bencana</h3>
        </div>

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
                <form action="{{ route('logistik-bencana.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Kejadian Bencana</label>
                        <select name="kejadian_id" class="form-control" required>
                            <option value="">-- Pilih Kejadian --</option>
                            @foreach ($kejadian as $k)
                                <option value="{{ $k->kejadian_id }}"
                                    {{ old('kejadian_id') == $k->kejadian_id ? 'selected' : '' }}>
                                    {{ $k->jenis_bencana }} ({{ $k->tanggal }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" name="satuan" class="form-control" value="{{ old('satuan') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Sumber</label>
                        <input type="text" name="sumber" class="form-control" value="{{ old('sumber') }}">
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="media_files" class="form-label">Upload Media (Bisa lebih dari 1)</label>
                        <input type="file" name="media_files[]" id="media_files" class="form-control" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                    <a href="{{ route('logistik-bencana.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
