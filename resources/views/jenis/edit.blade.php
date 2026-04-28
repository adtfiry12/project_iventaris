@extends('template.layout')
@section('title', 'Edit Jenis')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card card-warning shadow">
                    <div class="card-header">
                        <h3 class="card-title text-white">Form Edit Jenis Barang</h3>
                    </div>

                    <form action="{{ route('jenis.update', $jenis->id_jenis) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="form-group">
                                <label for="kode_jenis">Kode Jenis</label>
                                <input type="text" class="form-control" id="kode_jenis" name="kode_jenis"
                                    value="{{ old('kode_jenis', $jenis->kode_jenis) }}" readonly
                                    style="pointer-events: none; background-color: #e9ecef;">
                            </div>

                            <div class="form-group">
                                <label for="nama_jenis">Nama Jenis</label>
                                <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror"
                                    id="nama_jenis" name="nama_jenis" value="{{ old('nama_jenis', $jenis->nama_jenis) }}"
                                    required>
                                @error('nama_jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                    rows="3">{{ old('keterangan', $jenis->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Foto Jenis</label><br>
                                @if ($jenis->image)
                                    <img src="{{ asset('storage/' . $jenis->image) }}" alt="Foto {{ $jenis->nama_jenis }}"
                                        width="150" class="img-thumbnail mb-2">
                                    <br>
                                @endif
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/*">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto jenis
                                    barang.</small>
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('jenis.index') }}" class="btn btn-default mr-2">Batal</a>
                            <button type="submit" class="btn btn-warning shadow">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
