@extends('layout.dashboard2-layout')
@section('title', isset($pageTitle) ? $pageTitle : 'Tambah User')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="mt-3 d-flex justify-content-center">
    <h2><i class="bi bi-trophy"></i>Tambah User</h2>
</div>

<div class="mobile-menu-overlay"></div>
		<div class="main-container">
            <h2 style="margin-top: 20px;">Tambah User</h2>
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="card-body">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible show fade">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="nama">Nama Pengguna</label>
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required autofocus>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="telepon">Telepon</label>
                            <input type="text" name="telepon" id="telepon" class="form-control" value="{{ old('telepon') }}" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control selectric" required>
                                <option disabled selected>Role</option>
                                <option value="admin">Admin</option>
                                <option value="pustakawan">Pustakawan</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat" style="height: 250px" required>{{ old('alamat') }}</textarea>
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
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
