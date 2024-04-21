@extends('layout.dashboard2-layout')
@section('title', isset($pageTitle) ? $pageTitle : 'Edit Buku')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="mt-3 d-flex justify-content-center">
    <h2><i class="bi bi-trophy"></i>Edit Buku</h2>
</div>

<div class="mobile-menu-overlay"></div>
		<div class="main-container">
            <h2 style="margin-top: 20px;">Edit Buku</h2>
            <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible show fade">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="nama">Nama Pengguna</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ $user->name }}" required autofocus>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="telepon">Telepon</label>
                            <input type="text" name="telepon" id="telepon" class="form-control" value="{{ $user->telepon }}" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control selectric" required>
                                @if ($user->role === 'pembaca')
                                    <option value="pembaca" {{ $user->role === 'pembaca' ? 'selected' : '' }}>Pembaca</option>
                                @else
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="pustakawan" {{ $user->role === 'pustakawan' ? 'selected' : '' }}>Pustakawan</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" style="height: 250px" required>{{ $user->alamat }}</textarea>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Foto Profil</label>
                            <img src="{{ $user->gambar }}" alt="{{ $user->name }}" width="250" class="d-block">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="image-upload">Edit Foto Profil</label>
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Pilih Gambar</label>
                                <input type="file" name="foto_profil" id="image-upload">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke text-right">
                    <button type="submit" class="btn btn-primary">
                        Edit Data
                    </button>
                </div>
            </form>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
