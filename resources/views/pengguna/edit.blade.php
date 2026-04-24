@extends('template.layout')
@section('title', 'Edit Pengguna')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card card-warning shadow">
                    <div class="card-header">
                        <h3 class="card-title text-white">Form Edit Pengguna</h3>
                    </div>

                    <form action="{{ route('pengguna.update', $pengguna->id_pengguna) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="card-body">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username', $pengguna->username) }}"
                                    required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama', $pengguna->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $pengguna->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password <small class="text-danger">(Kosongkan jika tidak ingin
                                        mengubah password)</small></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Masukkan password baru jika ingin ganti">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control @error('role') is-invalid @enderror" id="role"
                                    name="role" required>
                                    <option value="admin" {{ old('role', $pengguna->role) == 'admin' ? 'selected' : '' }}>
                                        Admin</option>
                                    <option value="user" {{ old('role', $pengguna->role) == 'user' ? 'selected' : '' }}>
                                        User</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('pengguna.index') }}" class="btn btn-default mr-2">Batal</a>
                            <button type="submit" class="btn btn-warning shadow">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
