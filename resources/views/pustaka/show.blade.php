@extends('layout.dashboard2-layout')
@section('title', isset($pageTitle) ? $pageTitle : 'Detail Buku')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="mt-3 d-flex justify-content-center">
    <h4 class="font-weight-bold"><i class="bi bi-trophy"></i>Detail Buku</h4>
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

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                <b>Error:</b>
                {{ session('error') }}
            </div>
        </div>
    @endif
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box pb-20">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="text-center">{{ $buku->judul }}</h4>
                            <div class="ticket-info">
                                <div class="text-right"><em>{{ $buku->penulis }}</em></div>
                                <div class="text-right"><em>{{ $buku->penerbit }}</em></div>
                                <div class="text-right"><em>{{ $buku->tahun_terbit }}</em></div>
                                <div>{{ $buku->deskripsi }}</div>
                            </div>
                            <div class="ticket-form text-right">
                                <div class="{{ $koleksi ? 'd-none' : '' }}">
                                    <form action="{{ route('koleksi.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            <i class="bi bi-bookmark"></i>
                                            Tambah Buku Ke koleksi
                                        </button>
                                    </form>
                                </div>
                                <div class="mt-3 {{ $peminjaman ? 'd-none' : '' }}">
                                    <form action="{{ route('peminjaman.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                        <input type="hidden" name="tanggal_pinjam" value="{{ now()->toDateString() }}">
                                        <input type="hidden" name="tanggal_kembali" value="-">
                                        <input type="hidden" name="status" value="Dipinjam">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            <i class="bi bi-card-list"></i>
                                            Pinjam Buku
                                        </button>
                                    </form>
                                </div>
                            
                                <div class="mt-3 {{ $ulasan ? 'd-none' : '' }}">
                                    <button type="button" class="btn btn-primary float-center" data-toggle="modal" data-target="#modalReview">
                                        <i class="bi bi-pen"></i> Tambah Review
                                    </button>
                                </div>
                                <h6 class="card-title mt-5">Ulasan Buku</h6>
                                @foreach ($buku->ulasan as $item)
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">{{ $item->user->name }}</h6>
                                        <p class="card-text">Rating: {{ $item->rating }} <i class="bi bi-star"></i></p>
                                        <p class="card-text">{{ $item->ulasan }}</p>
                                    </div>
                                @endforeach
                            </div>
                                                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalReview" tabindex="-1" aria-labelledby="modalReviewLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalReviewLabel">Tambah Review</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM TAMBAH BARANG-->
                <form action="{{ route('ulasan.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="section-title">Tulis Ulasan dan Rating Kamu</div>
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <div class="selectgroup selectgroup-pills">
                            @for ($i = 1; $i <= 5; $i++)
                                <label class="selectgroup-item">
                                    <input type="radio" name="rating" value="{{ $i }}" class="selectgroup-input" required>
                                    <span class="selectgroup-button selectgroup-button-icon">
                                        {{ $i }}
                                        <i class="bi bi-star"></i>
                                    </span>
                                </label>
                            @endfor
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                   <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                    <div class="form-group">
                        <label for="ulasan">Ulasan</label>
                        <textarea class="form-control" name="ulasan" id="ulasan" style="height: 150px" placeholder="Tulis ulasan kamu..." required>{{ old('ulasan') }}</textarea>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary btn-lg">Upload</button>
                    </div>
                </form>
                <!--END FORM TAMBAH BARANG-->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
