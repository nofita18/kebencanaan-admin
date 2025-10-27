@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Tambah Posko Bencana</h3>
        </div>

        {{-- 🔴 Menampilkan error validasi --}}
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
                <form action="{{ route('posko-bencana.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nama">Nama Posko</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="kontak">Kontak</label>
                        <input type="text" name="kontak" id="kontak" class="form-control"
                            value="{{ old('kontak') }}">
                    </div>

                    <div class="form-group">
                        <label for="penanggung_jawab">Penanggung Jawab</label>
                        <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control"
                            value="{{ old('penanggung_jawab') }}">
                    </div>

                    <div class="form-group">
                        <label for="kejadian_id">Kejadian Bencana</label>
                        <select name="kejadian_id" id="kejadian_id" class="form-control" required>
                            <option value="">-- Pilih Kejadian --</option>
                            @foreach ($kejadian as $k)
                                <option value="{{ $k->kejadian_id }}"
                                    {{ old('kejadian_id') == $k->kejadian_id ? 'selected' : '' }}>
                                    {{ $k->jenis_bencana }} - {{ $k->lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Posko (Opsional)</label>
                        <input type="file" name="foto" id="foto" class="form-control-file">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-rotate-right"></i> Update
                    </button>
                    <a href="{{ route('posko-bencana.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>

                </form>
            </div>
        </div>
    </div>
@endsection
