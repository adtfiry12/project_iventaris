@extends('template.layout')
@section('title', 'Edit Inventaris')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-warning shadow">
                    <div class="card-header">
                        <h3 class="card-title text-white">Form Edit Inventaris</h3>
                    </div>

                    <form action="{{ route('inventaris.update', $inventaris->id_inventaris) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body row">

                            <div class="form-group col-md-6">
                                <label>Kode Inventaris</label>
                                <input type="text" name="kode_inventaris" class="form-control"
                                    value="{{ $inventaris->kode_inventaris }}" readonly
                                    style="pointer-events: none; background: #e9ecef;">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Tanggal Register</label>
                                <input type="date" name="tgl_register" class="form-control"
                                    value="{{ $inventaris->tgl_register }}" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Nama Barang</label>
                                <input type="text" name="nama" class="form-control" value="{{ $inventaris->nama }}"
                                    required>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Jenis Barang</label>
                                <select name="id_jenis" class="form-control" required>
                                    <option value="">-- Pilih Jenis Barang --</option>
                                    @foreach ($jenis as $j)
                                        <option value="{{ $j->id_jenis }}"
                                            {{ $inventaris->id_jenis == $j->id_jenis ? 'selected' : '' }}>
                                            {{ $j->nama_jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Ruangan</label>
                                <select name="id_ruang" class="form-control" required>
                                    <option value="">-- Pilih Ruangan --</option>
                                    @foreach ($ruang as $r)
                                        <option value="{{ $r->id_ruang }}"
                                            {{ $inventaris->id_ruang == $r->id_ruang ? 'selected' : '' }}>
                                            {{ $r->nama_ruang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Kondisi Barang</label>
                                <select name="kondisi" class="form-control" required>
                                    <option value="Baik" {{ $inventaris->kondisi == 'Baik' ? 'selected' : '' }}>Baik
                                    </option>
                                    <option value="Rusak Ringan"
                                        {{ $inventaris->kondisi == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan
                                    </option>
                                    <option value="Rusak Berat"
                                        {{ $inventaris->kondisi == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" min="1"
                                    value="{{ $inventaris->jumlah }}" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Foto Barang</label><br>
                                @if ($inventaris->image)
                                    <img src="{{ asset('storage/' . $inventaris->image) }}" alt="Foto Barang"
                                        width="80" class="img-thumbnail mb-2">
                                @endif
                                <input type="file" name="image" class="form-control-file" accept="image/*">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                            </div>

                            <div class="form-group col-md-12">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="3">{{ $inventaris->keterangan }}</textarea>
                            </div>

                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('inventaris.index') }}" class="btn btn-default mr-2">Batal</a>
                            <button type="submit" class="btn btn-warning shadow text-white">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
