@extends('layout.dashboard2-layout')
@section('title', isset($pageTitle) ? $pageTitle : 'Pustaka Buku')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="mt-3 d-flex justify-content-center">
    <h2><i class="bi bi-trophy"></i>Pustaka Buku</h2>
</div>

<div class="main-container">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                <b>Success:</b>
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
                {{-- <div class="card-body">
                    <div class="section-title mt-0">Cari Buku</div>
                    <form action="{{ route('pustaka.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari buku.." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </div>
                    </form>
                </div> --}}
        </div>
    </div>
    <div class="row">
        @foreach ($buku as $item)
        <div class="col-md-3 mb-4">
            <div class="card" style="width: 100%;">
                <img src="{{ asset('fotoCover/'.$item->img) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="article-category">
                        <h6 href="#" class="category-link text-muted">{{ $item->kategori->kategori}}</h6>
                        <div class="bullet"></div>
                        <a href="#">{{ number_format($item->ulasan_avg_rating, 1) }} / 5</a>
                    </div>                    
                    <h3 class="card-title">{{ $item->judul }}</h3>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $item->penerbit }} - {{ $item->tahun_terbit }}</h6>
                    <p>
                        @if (strlen($item->deskripsi) > 60)
                            {{ substr($item->deskripsi, 0, 60).'...' }}
                        @else
                            {{ $item->deskripsi }}
                        @endif
                    </p>          
                    <a href="{{ route('pustaka.show', $item->id) }}" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
