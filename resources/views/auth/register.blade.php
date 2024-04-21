@extends('layout.auth')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Register')
@section('content')
    
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@if (Session::get('errors'))
<p style="color: red">{{Session::get('errors')}}</p>
@endif

<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-7">
                <img src="/back/vendors/images/login-page-img.png" alt="" />
            </div>
            <div class="col-md-6 col-lg-5">
                <div class="login-box bg-white box-shadow border-radius-10">
                    <div class="login-title">
                        <h2 class="text-center text-primary">Register</h2>
                    </div>
                    <form action="{{ route('register.inputRegister') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (Session::get('success'))
                           <div class="alert alert-success">
                            {{Session::get('success')}}</div>
                        @endif
                        @if (Session::get('error'))
                           <div class="alert alert-danger">
                            {{Session::get('error')}}</div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group custom">
                                    <input type="text" class="form-control form-control-lg" placeholder="Nama" name="nama" id="nama" value="{{ old('nama') }}"required />
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group custom">
                                    <input type="text" class="form-control form-control-lg" placeholder="Username" name="username" id="username" value="{{ old('username') }}"required />
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                                <div class="input-group custom">
                                    <input type="password" class="form-control form-control-lg" placeholder="Password" name="password" id="password" value="{{ old('password') }}"required />
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                    </div>
                                </div>
                                <div class="input-group custom">
                                    <input type="email" class="form-control form-control-lg" placeholder="Email" name="email" id="email" value="{{ old('email') }}"required />
                                    <div class="input-group-append custom">
                                        <span class="input-group-text"><i class="icon-copy dw dw-email"></i></span>
                                    </div>
                                </div>
                    
                        <div class="input-group custom">
                            <input type="tel" class="form-control form-control-lg" placeholder="Telepon" name="telepon" id="telepon" value="{{ old('telepon') }}"required />
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-phone"></i></span>
                            </div>
                        </div>

                        {{-- <div class="form-group col-lg-6">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control selectric" required>
                                <option disabled selected>Role</option>
                                <option value="pembaca">Pembaca</option>
                            </select>
                        </div> --}}
                    
                        <div class="input-group custom">
                            <input type="text" class="form-control form-control-lg" placeholder="Alamat" name="alamat" id="alamat" {{ old('alamat') }} required />
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-map"></i></span>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>.
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    <button type="submit" class="btn btn-primary w-100">Register</button>
                                    <input type="hidden" name="role" value="pembaca">
                                </div>
                            </div>
                        </div>                        
                    </form>                                                          
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection