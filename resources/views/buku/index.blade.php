@extends('layout.dashboard2-layout')
@section('title', isset($pageTitle) ? $pageTitle : 'Data Buku')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="mt-3 d-flex justify-content-center">
    <h2><i class="bi bi-trophy"></i>Data Buku</h2>
</div>

<div class="xs-pd-20-10 pd-ltr-20" style="margin-top: 20px;">
    <button class="btn btn-primary float-right" type="button" onclick="window.location.href='buku/create'">
        <i class="bi bi-plus-lg">Tambah Buku</i>
    </button>
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
    <div class="xs-pd-20-10 pd-ltr-20">
        <div class="card-box pb-20">
            <table class="data-table table nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="table-plus">Judul</th>
                        <th>Cover</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Kategori</th>
                        {{-- <th>Stock</th> --}}
                        <th class="datatable-nosort">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buku as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="table-plus">
                            <div class="name-avatar d-flex align-values-center">
                                <div class="txt">
                                    <div class="weight-600">{{$value->judul}}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($value->img !='')
                            <a href="#" data-toggle="modal" data-target="#bukuModal{{$value->id}}">
                                <img src="{{ asset('fotoCover/'.$value->img) }}" alt="Cover Buku" width="70px">
                            </a>
                            @else
                            <img src="{{asset('img/buku.png')}}" alt="" width="75px" >
                            @endif
                        </td>
                        <td>{{ $value->penulis }}</td>
                        <td>{{ $value->penerbit }}</td>
                        <td>{{ $value->tahun_terbit }}</td>
                        <td>{{ $value->kategori->kategori}}</td>
                        {{-- <td>{{ $value->stock}}</td> --}}
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('buku.edit', $value->id) }}" data-color="#265ed7">
                                    <i class="icon-copy dw dw-edit2"></i>
                                </a>                                
                                <form action="{{ route('buku.delete', ['id' => $value->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" style="background: none; border: none;">
                                        <i class="icon-copy dw dw-delete-3" style="font-size: 1.2rem; color: red; cursor: pointer;"></i>
                                    </button>
                                </form>                                
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="bukuModal{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="bukuModalLabel{{$value->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="bukuModalLabel{{$value->id}}">{{$value->nama}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h2><strong>{{ $value->judul }}</strong></h2>
                                    <p><em>{{ $value->penulis }}</em></p>
                                    <p>{{ $value->penerbit }} - {{ $value->tahun_terbit }}</p>
                                    <img src="{{ asset('fotoCover/'.$value->img) }}" class="img-fluid" alt="Foto Pelanggaran">
                                    <p>{{ $value->deskripsi }}</p>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
