@extends('layout.dashboard2-layout')
@section('title', isset($pageTitle) ? $pageTitle : 'Data Buku Yang Dipinjam')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="mt-3 d-flex justify-content-center">
    <h2><i class="bi bi-trophy"></i>Data Buku Yang Dipinjam</h2>
</div>

<div class="main-container">
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box pb-20">
            {{-- <div class="dropdown" id="dropdownRole" style="float: right;">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Export PDF
                </button>
                
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('peminjaman.exportPdf') }}">Semua</a>
                    <a class="dropdown-item" href="{{ route('peminjaman.exportPdf', ['status' => 'dipinjam']) }}">Dipinjam</a>
                    <a class="dropdown-item" href="{{ route('peminjaman.exportPdf', ['status' => 'dikembalikan']) }}">Dikembalikan</a>
                </div>
            </div> --}}
            
            <table class="data-table table nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="table-plus">Nama</th>
                        <th>Judul Buku</th>
                        <th>Penerbit</th> 
                        <th>Tanggal Dipinjam</th>
                        <th>Tanggal Dikembalikan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="table-plus">
                            <div class="name-avatar d-flex align-values-center">
                                <div class="txt">
                                    <div class="weight-600">{{$value->user->name}}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $value->buku->judul }}</td>
                        <td>{{ $value->buku->penerbit }}</td>
                        <td>{{ $value->{'tanggal_pinjam'} }}</td>
                        <td>{{ $value->tanggal_kembali }}</td>
                        <td>{{ $value->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
