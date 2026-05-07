@extends('template.layout')
@section('title', 'Tambah Inventaris')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-primary shadow">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Inventaris</h3>
                    </div>

                    <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body row">

                            <div class="form-group col-md-6">
                                <label>Kode Inventaris</label>
                                <input type="text" name="kode_inventaris" class="form-control"
                                    value="{{ $kode_inventaris }}" readonly
                                    style="pointer-events: none; background: #e9ecef;">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tanggal Register</label>
                                <input type="date" name="tgl_register" class="form-control" value="{{ date('Y-m-d') }}"
                                    required>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Nama Barang</label>
                                <input type="text" name="nama"
                                    class="form-control @error('nama') is-invalid @enderror"
                                    placeholder="Masukkan nama barang" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Jenis Barang</label>
                                <select name="id_jenis" class="form-control" required>
                                    <option value="">-- Pilih Jenis Barang --</option>
                                    @foreach ($jenis as $j)
                                        <option value="{{ $j->id_jenis }}">{{ $j->nama_jenis }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Ruangan</label>
                                <select name="id_ruang" class="form-control" required>
                                    <option value="">-- Pilih Ruangan --</option>
                                    @foreach ($ruang as $r)
                                        <option value="{{ $r->id_ruang }}">{{ $r->nama_ruang }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Kondisi Barang</label>
                                <select name="kondisi" class="form-control" required>
                                    <option value="">-- Pilih Kondisi --</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                    <option value="Rusak Berat">Rusak Berat</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" min="1" value="1"
                                    required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Foto Barang</label>
                                <input type="file" name="image" class="form-control-file" accept="image/*">
                                <small class="text-muted">Maksimal 2MB (Opsional)</small>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="3" placeholder="Tambahkan keterangan opsional..."></textarea>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('inventaris.index') }}" class="btn btn-default mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary shadow">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
