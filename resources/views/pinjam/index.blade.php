@extends('template.layout')
@section('title', 'Data Peminjaman')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Transaksi Peminjaman</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Kode Pinjam</th>
                            <th>Karyawan (Peminjam)</th>
                            <th>Admin (Petugas)</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th class="text-center" style="width: 250px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pinjam as $p)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}.</td>
                                <td class="align-middle"><span
                                        class="badge badge-secondary px-2 py-1">{{ $p->kode_pinjam }}</span></td>
                                <td class="align-middle">{{ $p->karyawan->nama ?? '-' }}</td>
                                <td class="align-middle">{{ $p->pengguna->nama ?? '-' }}</td>
                                <td class="align-middle">{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d-m-Y') }}</td>
                                <td class="align-middle">
                                    @if ($p->tgl_kembali)
                                        {{ \Carbon\Carbon::parse($p->tgl_kembali)->format('d-m-Y') }}
                                    @else
                                        <span class="badge badge-warning">Belum Kembali</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <a href="{{ route('pinjam.show', $p->id_pinjam) }}"
                                        class="btn btn-outline-info btn-sm rounded-pill px-3 shadow-sm mr-1">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('pinjam.struk', $p->id_pinjam) }}" target="_blank"
                                        class="btn btn-outline-warning btn-sm rounded-pill px-3 shadow-sm mr-1">
                                        <i class="fas fa-print"></i> Struk
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    @if (method_exists($pinjam, 'links'))
                        {{ $pinjam->links('pagination::bootstrap-4') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
