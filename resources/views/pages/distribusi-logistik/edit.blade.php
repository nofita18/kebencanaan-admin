@extends('layouts.admin.app')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Edit Distribusi Logistik</h3>
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
            <form action="{{ route('distribusi-logistik.update', $distribusi->distribusi_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="logistik_id">Logistik Bencana</label>
                    <select name="logistik_id" id="logistik_id" class="form-control" required>
                        <option value="">-- Pilih Logistik --</option>
                        @foreach ($logistik as $l)
                            <option value="{{ $l->logistik_id }}" {{ old('logistik_id', $distribusi->logistik_id) == $l->logistik_id ? 'selected' : '' }}>
                                {{ $l->nama_barang }} (Stok: {{ $l->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="posko_id">Posko Bencana</label>
                    <select name="posko_id" id="posko_id" class="form-control" required>
                        <option value="">-- Pilih Posko --</option>
                        @foreach ($posko as $p)
                            <option value="{{ $p->posko_id }}" {{ old('posko_id', $distribusi->posko_id) == $p->posko_id ? 'selected' : '' }}>
                                {{ $p->nama }} - {{ $p->alamat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal Distribusi</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal', $distribusi->tanggal) }}" required>
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ old('jumlah', $distribusi->jumlah) }}" required>
                </div>

                <div class="form-group">
                    <label for="penerima">Penerima</label>
                    <input type="text" name="penerima" id="penerima" class="form-control" value="{{ old('penerima', $distribusi->penerima) }}">
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan', $distribusi->keterangan) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Bukti Saat Ini:</label><br>
                    @if ($distribusi->media)
                        <img src="{{ asset('storage/' . $distribusi->media->file_path) }}" alt="Bukti Distribusi" width="150">
                    @else
                        <p class="text-muted">Belum ada bukti.</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="bukti">Ganti Bukti (Opsional)</label>
                    <input type="file" name="bukti" id="bukti" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-rotate-right"></i> Update
                </button>
                <a href="{{ route('distribusi-logistik.index') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Kembali
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
