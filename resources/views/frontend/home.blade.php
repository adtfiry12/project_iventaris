@extends('template.layoutfront')
@section('title', 'Home')

@section('content')
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Manage Assets & Inventory Easily.</h1>
            <p class="hero-text">Say goodbye to manual tracking. Monitor item availability, room layouts, and employee
                borrowing processes in real-time within a single integrated platform.</p>
            <a href="#" class="btn-order">Get Started</a>
        </div>
        <div class="hero-image">
            <img src="{{ asset('img/logoweb.png') }}" alt="Inventory Illustration">
        </div>
    </section>

    <section class="categories" style="background-color: #21b3c6; padding: 50px 0;">
        <div class="cat-title-wrapper" style="text-align: center; margin-bottom: 30px;">
            <div class="cat-title bg-white d-inline-block px-4 py-2 font-weight-bold rounded shadow-sm"
                style="color: #333; font-size: 1.2rem;">
                Item Categories
            </div>
        </div>

        <div
            style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; max-width: 1300px; margin: 0 auto; padding: 0 20px;">

            @foreach ($jenis as $j)
                <div style="text-align: center; width: 180px;">

                    <div class="shadow-sm"
                        style="background-color: #ffffff !important; border-radius: 20px; padding: 20px 15px; height: 190px; display: flex; flex-direction: column; align-items: center; justify-content: space-between; margin-bottom: 15px; border: 1px solid #eaeaea; transition: transform 0.3s ease, box-shadow 0.3s ease;"
                        onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.15)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.1)';">

                        <div
                            style="height: 100px; width: 100%; display: flex; align-items: center; justify-content: center;">
                            @if ($j->image)
                                <img src="{{ asset('storage/' . $j->image) }}" alt="{{ $j->nama_jenis }}"
                                    style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            @else
                                <i class="fas fa-box fa-3x" style="color: #ccc;"></i>
                            @endif
                        </div>

                        <div style="font-size: 1.05rem; font-weight: 600; letter-spacing: 0.5px; color: #333333 !important; width: 100%; margin-top: 15px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
                            title="{{ $j->nama_jenis }}">
                            {{ $j->nama_jenis }}
                        </div>

                    </div>

                </div>
            @endforeach

        </div>

        <div class="d-flex justify-content-center mt-5" style="width: 100%;">
            <div class="bg-white rounded-pill shadow-sm px-3 py-2 d-inline-block">
                @if (method_exists($jenis, 'links'))
                    {{ $jenis->links('pagination::bootstrap-4') }}
                @endif
            </div>
        </div>
    </section>
@endsection
