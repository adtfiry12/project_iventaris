@extends('template.layout')
@section('title', 'Tambah Ruangan')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Ruangan</h3>
                    </div>
                    <form action="{{ route('ruang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="kode_ruang">Kode Ruang</label>
                                <input type="text" class="form-control" id="kode_ruang" name="kode_ruang"
                                    value="{{ $kode_ruang }}" readonly
                                    style="pointer-events: none; background-color: #e9ecef;">
                                <small class="text-danger mt-1 d-block"><i class="fas fa-info-circle"></i> Kode ini
                                    digenerate otomatis dan tidak dapat diubah.</small>
                            </div>

                            <div class="form-group">
                                <label for="nama_ruang">Nama Ruangan</label>
                                <input type="text" class="form-control @error('nama_ruang') is-invalid @enderror"
                                    id="nama_ruang" name="nama_ruang" placeholder="Contoh: Gudang Elektronik"
                                    value="{{ old('nama_ruang') }}" required>
                                @error('nama_ruang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan <small class="text-muted">(Opsional)</small></label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                    rows="3" placeholder="Masukkan keterangan atau lokasi ruangan">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Foto Ruangan <small class="text-muted">(Opsional)</small></label>
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('ruang.index') }}" class="btn btn-default mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary shadow">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
