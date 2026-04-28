@extends('template.layout')
@section('title', 'Karyawan')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Karyawan</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th class="text-center">Foto</th>
                                    <th>NIP</th>
                                    <th>Nama Lengkap</th>
                                    <th>Alamat</th>
                                    <th>No. Telp</th>
                                    <th class="text-center" style="width: 200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawan as $d)
                                    <tr>
                                        <td class="align-middle">{{ $loop->iteration }}.</td>

                                        <td class="align-middle text-center">
                                            @if ($d->image)
                                                <img src="{{ asset('storage/' . $d->image) }}"
                                                    alt="Foto {{ $d->nama }}" width="50" height="50"
                                                    class="img-circle" style="object-fit: cover;">
                                            @else
                                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="fas fa-user-tie"></i>
                                                </div>
                                            @endif
                                        </td>

                                        <td class="align-middle">{{ $d->nip }}</td>
                                        <td class="align-middle">{{ $d->nama }}</td>
                                        <td class="align-middle">{{ $d->alamat }}</td>
                                        <td class="align-middle">{{ $d->no_telp }}</td>

                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('karyawan.edit', $d->id_karyawan) }}"
                                                    class="btn btn-outline-info btn-sm rounded-pill px-3 shadow-sm mr-2"
                                                    title="Edit Data">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <form action="{{ route('karyawan.destroy', $d->id_karyawan) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data karyawan ini?')"
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
                            @if (method_exists($karyawan, 'links'))
                                {{ $karyawan->links('pagination::bootstrap-4') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
