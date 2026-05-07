@extends('template.layout')
@section('title', 'Daftar Inventaris')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Master Inventaris Barang</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th class="text-center">Foto</th>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Ruangan</th>
                            <th class="text-center">Kondisi</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center" style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventaris as $d)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}.</td>

                                <td class="align-middle text-center">
                                    @if ($d->image)
                                        <img src="{{ asset('storage/' . $d->image) }}" alt="Foto" width="50"
                                            height="50" class="img-circle shadow-sm" style="object-fit: cover;">
                                    @else
                                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm"
                                            style="width: 50px; height: 50px;">
                                            <i class="fas fa-box"></i>
                                        </div>
                                    @endif
                                </td>

                                <td class="align-middle"><span
                                        class="badge badge-secondary px-2 py-1">{{ $d->kode_inventaris }}</span></td>
                                <td class="align-middle font-weight-bold">{{ $d->nama }}</td>

                                <!-- Memanggil nama dari relasi, gunakan ?? '-' untuk jaga-jaga kalau data master terhapus -->
                                <td class="align-middle">{{ $d->jenis->nama_jenis ?? '-' }}</td>
                                <td class="align-middle">{{ $d->ruang->nama_ruang ?? '-' }}</td>

                                <td class="align-middle text-center">
                                    @if ($d->kondisi == 'Baik')
                                        <span class="badge badge-success px-2 py-1">Baik</span>
                                    @elseif($d->kondisi == 'Rusak Ringan')
                                        <span class="badge badge-warning px-2 py-1">Rusak Ringan</span>
                                    @else
                                        <span class="badge badge-danger px-2 py-1">Rusak Berat</span>
                                    @endif
                                </td>

                                <td class="align-middle text-center">{{ $d->jumlah }}</td>

                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('inventaris.edit', $d->id_inventaris) }}"
                                            class="btn btn-outline-info btn-sm rounded-pill px-3 shadow-sm mr-2"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('inventaris.destroy', $d->id_inventaris) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?')"
                                            class="m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    @if (method_exists($inventaris, 'links'))
                        {{ $inventaris->links('pagination::bootstrap-4') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
