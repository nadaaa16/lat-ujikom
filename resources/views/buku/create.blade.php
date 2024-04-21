@extends('layout.dashboard2-layout')
@section('title', isset($pageTitle) ? $pageTitle : 'Tambah Data Buku')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="mt-3 d-flex justify-content-center">
    <h2><i class="bi bi-trophy"></i>Tambah Data Buku</h2>
</div>

<div class="mobile-menu-overlay"></div>
		<div class="main-container">
            <h2 style="margin-top: 20px;">Tambah Data Buku</h2>
            <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible show fade">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="judul">Judul Buku</label>
                            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required autofocus>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="penulis">Penulis</label>
                            <input type="text" name="penulis" id="penulis" class="form-control" value="{{ old('penulis') }}" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="penerbit">Penerbit</label>
                            <input type="text" name="penerbit" id="penerbit" class="form-control" value="{{ old('penerbit') }}" required>
                        </div>
                        {{-- <div class="form-group col-lg-6">
                            <label for="stock">Stock</label>
                            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}" required>
                        </div> --}}
                        <div class="form-group col-lg-6">
                            <label for="tahun_terbit">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" value="{{ old('tahun_terbit') }}" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control select2" required>
                                <option disabled selected>Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" style="height: 250px" required>{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="img" class="form-label mt-4">Foto</label>
                                <input type="file" class="form-control" id="img" name="img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke text-right">
                    <button type="submit" class="btn btn-primary">
                        Tambah Data
                    </button>
                </div>
            </form>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
