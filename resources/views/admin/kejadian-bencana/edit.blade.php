@extends('layouts.admin.app')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Edit Data Kejadian Bencana</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('kejadian-bencana.update', $kejadian->kejadian_id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Jenis Bencana</label>
                        <input type="text" name="jenis_bencana" class="form-control"
                            value="{{ old('jenis_bencana', $kejadian->jenis_bencana) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Kejadian</label>
                        <input type="date" name="tanggal" class="form-control"
                            value="{{ old('tanggal', $kejadian->tanggal) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" class="form-control"
                            value="{{ old('lokasi', $kejadian->lokasi) }}" required>
                    </div>

                    <div class="form-group">
                        <label>RT</label>
                        <input type="text" name="rt" class="form-control" value="{{ old('rt', $kejadian->rt) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>RW</label>
                        <input type="text" name="rw" class="form-control" value="{{ old('rw', $kejadian->rw) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Dampak</label>
                        <input type="text" name="dampak" class="form-control"
                            value="{{ old('dampak', $kejadian->dampak) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Status Kejadian</label>
                        <input type="text" name="status_kejadian" class="form-control"
                            value="{{ old('status_kejadian', $kejadian->status_kejadian) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control">{{ old('keterangan', $kejadian->keterangan) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Foto (opsional)</label>
                        @if ($kejadian->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $kejadian->foto) }}" alt="Foto kejadian" width="150"
                                    class="img-thumbnail">
                            </div>
                        @endif
                        <input type="file" name="foto" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-rotate-right"></i> Perbarui
                    </button>
                    <a href="{{ route('kejadian-bencana.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>

                </form>
            </div>
        </div>
    </div>
@endsection
