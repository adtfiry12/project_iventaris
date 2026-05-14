@extends('template.layout')
@section('title', 'Pengguna')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pengguna</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Foto</th>
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center" style="width: 200px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengguna as $d)
                                    <tr>
                                        <td class="align-middle">{{ $loop->iteration }}.</td>

                                        <td class="align-middle text-center">
                                            @if ($d->image)
                                                <img src="{{ asset('storage/' . $d->image) }}" alt="Foto" width="50"
                                                    height="50" class="img-circle" style="object-fit: cover;">
                                            @else
                                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto"
                                                    style="width: 50px; height: 50px;">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                        </td>

                                        <td class="align-middle">{{ $d->username }}</td>
                                        <td class="align-middle">{{ $d->nama }}</td>
                                        <td class="align-middle">{{ $d->email }}</td>

                                        <td class="text-center align-middle">
                                            @if (strtolower($d->role) == 'admin')
                                                <span class="badge badge-pill badge-danger px-3 py-2 shadow-sm">
                                                    <i class="fas fa-user-shield mr-1"></i> Admin
                                                </span>
                                            @else
                                                <span class="badge badge-pill badge-info px-3 py-2 shadow-sm">
                                                    <i class="fas fa-user mr-1"></i> User
                                                </span>
                                            @endif
                                        </td>

                                        <td class="align-middle">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('pengguna.edit', $d->id_pengguna) }}"
                                                    class="btn btn-outline-info btn-sm rounded-pill px-3 shadow-sm mr-2"
                                                    title="Edit Data">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <form action="{{ route('pengguna.destroy', $d->id_pengguna) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')"
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
                            @if (method_exists($pengguna, 'links'))
                                {{ $pengguna->links('pagination::bootstrap-4') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
