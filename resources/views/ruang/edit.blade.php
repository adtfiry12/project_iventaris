@extends('template.layout')
@section('title', 'Edit Ruangan')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card card-warning shadow">
                    <div class="card-header">
                        <h3 class="card-title text-white">Form Edit Ruangan</h3>
                    </div>

                    <form action="{{ route('ruang.update', $ruang->id_ruang) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="form-group">
                                <label for="kode_ruang">Kode Ruang</label>
                                <input type="text" class="form-control" id="kode_ruang" name="kode_ruang"
                                    value="{{ old('kode_ruang', $ruang->kode_ruang) }}" readonly
                                    style="pointer-events: none; background-color: #e9ecef;">
                            </div>

                            <div class="form-group">
                                <label for="nama_ruang">Nama Ruangan</label>
                                <input type="text" class="form-control @error('nama_ruang') is-invalid @enderror"
                                    id="nama_ruang" name="nama_ruang" value="{{ old('nama_ruang', $ruang->nama_ruang) }}"
                                    required>
                                @error('nama_ruang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                    rows="3">{{ old('keterangan', $ruang->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Foto Ruangan</label><br>
                                @if ($ruang->image)
                                    <img src="{{ asset('storage/' . $ruang->image) }}" alt="Foto {{ $ruang->nama_ruang }}"
                                        width="150" class="img-thumbnail mb-2">
                                    <br>
                                @endif
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto ruangan.</small>
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('ruang.index') }}" class="btn btn-default mr-2">Batal</a>
                            <button type="submit" class="btn btn-warning shadow">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
