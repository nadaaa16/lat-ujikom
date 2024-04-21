@extends('layout.dashboard2-layout')
@section('title', isset($pageTitle) ? $pageTitle : 'Data Buku Yang Dipinjam')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="mt-3 d-flex justify-content-center">
    <h2><i class="bi bi-trophy"></i>Data Buku Yang Dipinjam</h2>
</div>

<div class="main-container">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box pb-20">
            <table class="data-table table nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="table-plus">Judul</th>
                        <th>Tanggal Dipinjam</th>
                        <th>Tanggal Dikembalikan</th>
                        <th>Status</th>
                        <th class="datatable-nosort">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $peminjaman)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="table-plus">
                            <div class="name-avatar d-flex align-values-center">
                                <div class="txt">
                                    <div class="weight-600">{{$peminjaman->buku->judul}}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $peminjaman->{'tanggal_pinjam'} }} </td>
                        <td>{{ $peminjaman->tanggal_kembali }}</td>
                        <td>{{ $peminjaman->status }}</td>
                        <td> 
                            @if($peminjaman->status == 'Dipinjam')
                                <form action="{{ route('peminjaman.update', ['peminjaman' => $peminjaman->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                        <input type="hidden" name="status" value="Dikembalikan">
                                        <input type="hidden" name="tanggal_kembali" value="{{ date('Y-m-d') }}">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            Kembalikan
                                        </button>
                                </form>
                            @elseif($peminjaman->status == 'dikembalikan')
                                <span>Sudah Dikembalikan</span>
                                @endif
                        </td>
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
