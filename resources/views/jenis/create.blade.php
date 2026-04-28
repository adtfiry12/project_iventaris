@extends('template.layout')
@section('title', 'Tambah Jenis')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Jenis</h3>
                    </div>
                    <form action="{{ route('jenis.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Kode Jenis</label>
                                <input type="text" name="kode_jenis" class="form-control" value="{{ $kode_jenis }}"
                                    readonly style="pointer-events: none; background: #eee;">
                                <small class="text-danger mt-1 d-block"><i class="fas fa-info-circle"></i> Kode ini
                                    digenerate otomatis dan tidak dapat diubah.</small>
                            </div>
                            <div class="form-group">
                                <label>Nama Jenis</label>
                                <input type="text" name="nama_jenis" placeholder="Contoh : Peralatan rumah tangga"
                                    class="form-control @error('nama_jenis') is-invalid @enderror" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan <small class="text-muted">(Opsional)</small></label>
                                <textarea name="keterangan" class="form-control" rows="3" placeholder="Masukan keterangan jenis"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Foto <small class="text-muted">(Opsional)</small></label>
                                <input type="file" name="image" class="form-control-file">
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('jenis.index') }}" class="btn btn-default">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
