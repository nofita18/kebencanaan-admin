@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Posko Bencana</h3>
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
                <form action="{{ route('posko-bencana.update', $posko->posko_id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama">Nama Posko</label>
                        <input type="text" name="nama" id="nama" class="form-control"
                            value="{{ old('nama', $posko->nama) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat', $posko->alamat) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="kontak">Kontak</label>
                        <input type="text" name="kontak" id="kontak" class="form-control"
                            value="{{ old('kontak', $posko->kontak) }}" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="penanggung_jawab">Penanggung Jawab</label>
                        <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control"
                            value="{{ old('penanggung_jawab', $posko->penanggung_jawab) }}" placeholder="Opsional">
                    </div>

                    <div class="form-group">
                        <label for="kejadian_id">Kejadian Bencana</label>
                        <select name="kejadian_id" id="kejadian_id" class="form-control" required>
                            <option value="">-- Pilih Kejadian --</option>
                            @foreach ($kejadian as $k)
                                <option value="{{ $k->kejadian_id }}"
                                    {{ old('kejadian_id', $posko->kejadian_id) == $k->kejadian_id ? 'selected' : '' }}>
                                    {{ $k->jenis_bencana }} - {{ $k->lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Foto Saat Ini:</label><br>
                        @if ($posko->foto)
                            <img src="{{ asset('storage/posko/' . $posko->foto) }}" alt="Foto Posko" width="150"
                                class="rounded mb-2">
                        @else
                            <p class="text-muted">Belum ada foto.</p>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="foto">Ganti Foto (Opsional)</label>
                        <input type="file" name="foto" id="foto" class="form-control-file">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>

                </form>
            </div>
        </div>
    </div>
@endsection
