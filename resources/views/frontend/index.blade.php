@extends('template.layoutfront')
@section('content')
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Kelola Aset & Inventaris Lebih Mudah.</h1>
            <p class="hero-text">Tinggalkan pencatatan manual. Pantau ketersediaan barang, tata letak ruang, hingga
                proses peminjaman karyawan secara real-time dalam satu platform terintegrasi.</p>
            <a href="#" class="btn-order">Mulai Sekarang</a>
        </div>
        <div class="hero-image">
            <img src="{{ asset('img/logo.png') }}" alt="Ilustrasi Inventaris">
        </div>
    </section>
    <section class="categories">
        <div class="cat-title-wrapper">
            <div class="cat-title">Kategori Barang</div>
        </div>

        <div class="cat-grid">
            <div class="cat-item">
                <div class="cat-card c-1">
                    <i class="fas fa-laptop"></i>
                </div>
                <div class="cat-label">Elektronik</div>
            </div>

            <div class="cat-item">
                <div class="cat-card c-2">
                    <i class="fas fa-chair"></i>
                </div>
                <div class="cat-label">Furnitur</div>
            </div>

            <div class="cat-item">
                <div class="cat-card c-3">
                    <i class="fas fa-pen-ruler"></i>
                </div>
                <div class="cat-label">ATK</div>
            </div>

            <div class="cat-item">
                <div class="cat-card c-4">
                    <i class="fas fa-car"></i>
                </div>
                <div class="cat-label">Kendaraan</div>
            </div>

            <div class="cat-item">
                <div class="cat-card c-5">
                    <i class="fas fa-cogs"></i>
                </div>
                <div class="cat-label">Mesin Listrik</div>
            </div>

            <div class="cat-item">
                <div class="cat-card c-6">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="cat-label">Lainnya</div>
            </div>
        </div>
    </section>
@endsection
