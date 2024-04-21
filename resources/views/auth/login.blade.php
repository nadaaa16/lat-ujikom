@extends('layout.auth')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login')
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
                        <h2 class="text-center text-primary">Login</h2>
                    </div>
                    <form action="{{route('login')}}" method="POST" class="logrg">
                        @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        
                        @if (Session::get('fail'))
                            <div class="alert alert-danger">
                                {{ Session::get('fail') }}
                            </div>
                        @endif
                        
                        @if (Session::get('notAllowed'))
                            <div class="alert alert-danger">
                                {{ Session::get('notAllowed') }}
                            </div>
                        @endif
                        @csrf
                        <div class="input-group custom">

                            <input type="text"class="form-control form-control-lg" placeholder=""name="name"/>

                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                            </div>

                        </div>
                        <div class="input-group custom">

                            <input type="password" class="form-control form-control-lg" placeholder=""  name="password" id="password" />

                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                            </div>

                        </div>
                        <div class="row pb-30">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="customCheck1"
                                    />
                                    {{-- <label class="custom-control-label" for="customCheck1">Remember Me</label> --}}
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="/register">Register</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    <button type="submit" class="btn btn-primary w-100">Login</button>
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
