@extends('template.layout')
@section('title', 'Data Ruangan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Ruangan</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th class="text-center">Foto</th>
                                    <th>Kode Ruang</th>
                                    <th>Nama Ruangan</th>
                                    <th>Keterangan</th>
                                    <th class="text-center" style="width: 200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ruang as $d)
                                    <tr>
                                        <td class="align-middle">{{ $loop->iteration }}.</td>

                                        <td class="align-middle text-center">
                                            @if ($d->image)
                                                <img src="{{ asset('storage/' . $d->image) }}"
                                                    alt="Foto {{ $d->nama_ruang }}" width="50" height="50"
                                                    class="img-circle" style="object-fit: cover;">
                                            @else
                                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="fas fa-door-open"></i>
                                                </div>
                                            @endif
                                        </td>

                                        <td class="align-middle"><span
                                                class="badge badge-secondary px-2 py-1">{{ $d->kode_ruang }}</span></td>
                                        <td class="align-middle">{{ $d->nama_ruang }}</td>
                                        <td class="align-middle">{{ $d->keterangan ?? '-' }}</td>

                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('ruang.edit', $d->id_ruang) }}"
                                                    class="btn btn-outline-info btn-sm rounded-pill px-3 shadow-sm mr-2"
                                                    title="Edit Data">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <form action="{{ route('ruang.destroy', $d->id_ruang) }}" method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ruangan ini?')"
                                                    class="m-0 p-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm"
                                                        title="Hapus Data">
                                                        <i class="fas fa-trash-alt"></i> Hapus
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
                            @if (method_exists($ruang, 'links'))
                                {{ $ruang->links('pagination::bootstrap-4') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
