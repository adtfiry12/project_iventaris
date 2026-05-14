@extends('template.layout')
@section('title', 'Form Pinjam Inventaris')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white text-center border-bottom-0 pt-4">
                <h3 class="card-title w-100 font-weight-bold" style="font-size: 22px;">Form Pinjam Inventaris</h3>
            </div>

            <form action="{{ route('pinjam.store') }}" method="POST">
                @csrf
                <div class="card-body px-5">

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>Kode Pinjam</label>
                            <input type="text" name="kode_pinjam" class="form-control" value="{{ $kode_pinjam }}"
                                readonly style="background-color: #e9ecef;">
                        </div>
                        <div class="col-md-4">
                            <label>Pengguna</label>
                            <input type="text" class="form-control" value="{{ auth()->user()->nama ?? 'Admin' }}"
                                readonly style="background-color: #e9ecef;">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>NIP</label>
                            <input type="text" id="in_karyawan" class="form-control" placeholder="Ketik NIP..."
                                autocomplete="off">
                            <input type="hidden" name="id_karyawan" id="val_karyawan" required>
                        </div>
                        <div class="col-md-3">
                            <label>Nama Karyawan</label>
                            <input type="text" id="res_nama_karyawan" class="form-control" readonly
                                style="background-color: #e9ecef;">
                        </div>
                        <div class="col-md-3">
                            <label>Alamat</label>
                            <input type="text" id="res_alamat_karyawan" class="form-control" readonly
                                style="background-color: #e9ecef;">
                        </div>
                        <div class="col-md-3">
                            <label>No Telp</label>
                            <input type="text" id="res_telp_karyawan" class="form-control" readonly
                                style="background-color: #e9ecef;">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label>Kode Inventaris</label>
                            <input type="text" id="in_inventaris" class="form-control" placeholder="Ketik Kode Barang..."
                                autocomplete="off">
                            <input type="hidden" id="tmp_id_inv">
                        </div>
                        <div class="col-md-3">
                            <label>Nama</label>
                            <input type="text" id="tmp_nama" class="form-control" readonly
                                style="background-color: #e9ecef;">
                        </div>
                        <div class="col-md-3">
                            <label>Kondisi</label>
                            <input type="text" id="tmp_kondisi" class="form-control" readonly
                                style="background-color: #e9ecef;">
                        </div>
                        <div class="col-md-3">
                            <label>Jumlah</label>
                            <input type="number" id="tmp_qty" class="form-control" value="1" min="1">
                        </div>
                    </div>

                    <div class="row mb-4 align-items-end">
                        <div class="col-md-3">
                            <label>Jenis</label>
                            <input type="text" id="tmp_jenis" class="form-control" readonly
                                style="background-color: #e9ecef;">
                        </div>
                        <div class="col-md-3">
                            <label>Ruang</label>
                            <input type="text" id="tmp_ruang" class="form-control" readonly
                                style="background-color: #e9ecef;">
                        </div>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <button type="button" id="btn-tambah"
                                class="btn btn-outline-secondary btn-block font-weight-bold"
                                style="font-size: 20px; border-color: #ced4da;">+</button>
                        </div>
                    </div>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered text-center" id="tabel-keranjang">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama</th>
                                    <th>Kondisi</th>
                                    <th>Jenis</th>
                                    <th>Ruang</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <label>Tgl Pinjam</label>
                            <input type="date" name="tgl_pinjam" class="form-control" value="{{ date('Y-m-d') }}"
                                required>
                        </div>
                        <div class="col-md-3">
                            <label>Tgl Kembali</label>
                            <input type="date" name="tgl_kembali" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label>Status</label>
                            <input type="text" name="status_pinjam" class="form-control" value="Dipinjam" readonly
                                style="background-color: #e9ecef;">
                        </div>
                        <div class="col-md-3 text-right">
                            <button type="submit" class="btn btn-outline-secondary px-5 font-weight-bold"
                                style="border-color: #ced4da;">Simpan</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let karyawan = @json($karyawan);
            let inventaris = @json($inventaris);

            // Ketik NIP Karyawan
            $('#in_karyawan').on('keyup', function() {
                let keyword = $(this).val().toLowerCase();

                let find = karyawan.find(k => k.nip && String(k.nip).toLowerCase() === keyword);

                if (find) {
                    $('#res_nama_karyawan').val(find.nama);
                    $('#res_alamat_karyawan').val(find.alamat);
                    $('#res_telp_karyawan').val(find.no_telp);
                    $('#val_karyawan').val(find.id_karyawan); // Udah bener ini
                } else {
                    $('#res_nama_karyawan, #res_alamat_karyawan, #res_telp_karyawan, #val_karyawan').val(
                        '');
                }
            });

            // Ketik Kode Inventaris
            $('#in_inventaris').on('keyup', function() {
                let keyword = $(this).val().toLowerCase();

                let find = inventaris.find(i => i.kode_inventaris && String(i.kode_inventaris)
                    .toLowerCase() === keyword);

                if (find) {
                    $('#tmp_id_inv').val(find.id_inventaris);
                    $('#tmp_nama').val(find.nama);
                    $('#tmp_kondisi').val(find.kondisi);
                    $('#tmp_jenis').val(find.jenis ? find.jenis.nama_jenis : '-');
                    $('#tmp_ruang').val(find.ruang ? find.ruang.nama_ruang : '-');
                } else {
                    $('#tmp_id_inv, #tmp_nama, #tmp_kondisi, #tmp_jenis, #tmp_ruang').val('');
                }
            });

            let counter = 1;
            $('#btn-tambah').click(function() {
                let id_inv = $('#tmp_id_inv').val();
                let nama = $('#tmp_nama').val();
                let kondisi = $('#tmp_kondisi').val();
                let jenis = $('#tmp_jenis').val();
                let ruang = $('#tmp_ruang').val();
                let qty = $('#tmp_qty').val();

                if (!id_inv) return;

                let row = `
            <tr>
                <td class="align-middle">${counter}</td>
                <td class="align-middle text-left"><input type="hidden" name="id_inventaris[]" value="${id_inv}">${nama}</td>
                <td class="align-middle"><input type="hidden" name="kondisi_pinjam[]" value="${kondisi}">${kondisi}</td>
                <td class="align-middle">${jenis}</td>
                <td class="align-middle">${ruang}</td>
                <td class="align-middle"><input type="hidden" name="qty_pinjam[]" value="${qty}">${qty}</td>
                <td class="align-middle"><button type="button" class="btn btn-sm btn-outline-danger btn-hapus">Hapus</button></td>
            </tr>
        `;
                $('#tabel-keranjang tbody').append(row);
                counter++;

                $('#in_inventaris, #tmp_id_inv, #tmp_nama, #tmp_kondisi, #tmp_jenis, #tmp_ruang').val('');
                $('#tmp_qty').val(1);
                $('#in_inventaris').focus();
            });

            $(document).on('click', '.btn-hapus', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
