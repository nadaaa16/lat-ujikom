@extends('layout.dashboard2-layout')
@section('title', isset($pageTitle) ? $pageTitle : 'Koleksi Buku')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="mt-3 d-flex justify-content-center">
    <h2><i class="bi bi-trophy"></i>Koleksi Buku</h2>
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
        @foreach ($koleksi as $item)
        <div class="col-md-3 mb-4">
            <div class="card" style="width: 100%;">
                <img src="{{ asset('fotoCover/'.$item->buku->img) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="article-category">
                        {{-- <h6 href="#" class="category-link text-muted">{{ ucfirst($item->buku->kategori->kategori) }}</h6> --}}
                    </div>                    
                    <h4 class="card-title">{{ $item->buku->judul }}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $item->buku->penerbit }} - {{ $item->buku->tahun_terbit }}</h6>
                    <p>
                        @if (strlen($item->buku->deskripsi) > 60)
                            {{ substr($item->buku->deskripsi, 0, 60).'...' }}
                        @else
                            {{ $item->buku->deskripsi }}
                        @endif
                    </p>      
                    <div class="article-cta">
                        <form action="{{ route('koleksi.destroy',['id' => $item->id] )}}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" data-confirm-delete="true">
                                <i class="bi bi-star"></i> Kembalikan
                            </button>
                        </form>
                    </div>                       
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
