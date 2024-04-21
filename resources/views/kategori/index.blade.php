@extends('layout.dashboard2-layout')
@section('title', isset($pageTitle) ? $pageTitle : 'Kategori Buku')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="mt-3 d-flex justify-content-center">
    <h2><i class="bi bi-trophy"></i>Kategori Buku</h2>
</div>

<div class="xs-pd-20-10 pd-ltr-20" style="margin-top: 20px;">
    <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#tambahKategoriModal">
        <i class="bi bi-plus-lg"></i> Tambah Kategori Buku
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
        <div class="card-box pb-10">
            <table class="data-table table nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="table-plus">Kategori</th>
                        <th>Jumlah Buku</th>
                        <th class="datatable-nosort">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="table-plus">
                            <div class="name-avatar d-flex align-items-center">
                                <div class="txt">
                                    <div class="weight-600">{{$value->kategori}}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{$value->buku_count}}</td>
                        <td>
                            <div class="table-actions">
                                <a href="#" data-toggle="modal" data-target="#edit{{$value->id}}" data-color="#265ed7">
                                    <i class="icon-copy dw dw-edit2"></i>
                                </a>                                
                                <form action="{{ route('kategori.delete',['id' => $value->id] )}}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" style="background: none; border: none;">
                                        <i class="icon-copy dw dw-delete-3" style="font-size: 1.2rem; color: red; cursor: pointer;"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                
                    <div class="modal fade" id="edit{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="editLabel{{$value->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editLabel{{$value->id}}">Edit Kategori</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('kategori.update', ['id' => $value->id]) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="kategori">Kategori:</label>
                                            <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $value->kategori }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKategoriModalLabel">Tambah Kategori Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kategori.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan nama kategori">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button> <!-- Ganti href="/index" menjadi type="submit" -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
