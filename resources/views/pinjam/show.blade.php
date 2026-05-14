@extends('template.layout')
@section('title', 'Detail Peminjaman')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white pt-4">
                <h3 class="card-title font-weight-bold">Detail Peminjaman: {{ $pinjam->kode_pinjam }}</h3>
                <div class="card-tools">
                    <a href="{{ route('pinjam.index') }}" class="btn btn-default btn-sm rounded-pill px-3"><i
                            class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>

            <div class="card-body">
                <div class="row mb-4 bg-light p-3 rounded">
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="30%"><strong>Kode Pinjam</strong></td>
                                <td>: {{ $pinjam->kode_pinjam }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tgl Pinjam</strong></td>
                                <td>: {{ \Carbon\Carbon::parse($pinjam->tgl_pinjam)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tgl Kembali</strong></td>
                                <td>:
                                    {{ $pinjam->tgl_kembali ? \Carbon\Carbon::parse($pinjam->tgl_kembali)->format('d F Y') : 'Belum Kembali' }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="30%"><strong>Petugas</strong></td>
                                <td>: {{ $pinjam->pengguna->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Peminjam</strong></td>
                                <td>: {{ $pinjam->karyawan->nama ?? '-' }} (NIP: {{ $pinjam->karyawan->nip ?? '-' }})</td>
                            </tr>
                            <tr>
                                <td><strong>No Telp</strong></td>
                                <td>: {{ $pinjam->karyawan->no_telp ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <h5 class="font-weight-bold mb-3">Daftar Barang Dipinjam</h5>
                <table class="table table-bordered table-striped text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Ruangan</th>
                            <th>Kondisi</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pinjam->detail_pinjam as $detail)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $detail->inventaris->kode_inventaris ?? '-' }}</td>
                                <td class="align-middle text-left">{{ $detail->inventaris->nama ?? 'Barang Terhapus' }}
                                </td>
                                <td class="align-middle">{{ $detail->inventaris->jenis->nama_jenis ?? '-' }}</td>
                                <td class="align-middle">{{ $detail->inventaris->ruang->nama_ruang ?? '-' }}</td>
                                <td class="align-middle">{{ $detail->kondisi }}</td>
                                <td class="align-middle">{{ $detail->jumlah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
