@extends('layout.dashboard2-layout')
@section('title', isset($pageTitle) ? $pageTitle : 'Dashboard')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="main-container">
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
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="title pb-20">
            <h2 class="h3 mb-0">Hallo, {{ Auth::user()->name }}!</h2>
        </div>
        {{-- <div class="row pb-10">
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">2</div>
									<div class="font-14 text-secondary weight-500">
										Siswa
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="white">
										<i class="bi bi-person"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">6</div>
									<div class="font-14 text-secondary weight-500">
										Guru
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="white">
										<i class="bi bi-person-check"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">2</div>
									<div class="font-14 text-secondary weight-500">
										Prestasi Siswa
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#09cc06">
										<i
											class="bi bi-trophy"
											aria-hidden="true"
										></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">2</div>
									<div class="font-14 text-secondary weight-500">Pelanggaran Siswa</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="white">
										<i class="bi bi-journal-check" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> --}}
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
