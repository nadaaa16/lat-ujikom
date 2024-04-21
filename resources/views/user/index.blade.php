@extends('layout.dashboard2-layout')
@section('title', isset($pageTitle) ? $pageTitle : 'Data Pengguna')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="mt-3 d-flex justify-content-center">
    <h2><i class="bi bi-trophy"></i>Data Pengguna</h2>
</div>

<div class="xs-pd-20-10 pd-ltr-20" style="margin-top: 20px;">
    <button class="btn btn-primary float-right" type="button" onclick="window.location.href='user/create'">
        <i class="bi bi-plus-lg"></i> Tambah Pengguna
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
            {{-- <div class="dropdown" id="dropdownRole" style="float: right;">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-role="all">
                    Pilih Role Pengguna
                </button>
                
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" data-role="all">Semua</a>
                    <a class="dropdown-item" href="#" data-role="pembaca">Pembaca</a>
                    <a class="dropdown-item" href="#" data-role="petugas">Petugas</a>
                </div>
            </div> --}}
            <table class="data-table table nowrap">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Foto Profil</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" width="100">
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ '@'.$item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->telepon }}</td>
                        <td>{{ ucfirst($item->role) }}</td>
                        <td>
                            {{-- <a href="{{ route('user.show', $item->slug) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Lihat Pengguna">
                                <i class="fas fa-eye"></i>
                            </a> --}}
                            <a href="{{ route('user.edit', $item->id) }}" data-color="#265ed7">
                                <i class="icon-copy dw dw-edit2"></i>
                            </a>
                            <form action="{{ route('user.delete', ['id' => $item->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" style="background: none; border: none;">
                                    <i class="icon-copy dw dw-delete-3" style="font-size: 1.2rem; color: red; cursor: pointer;"></i>
                                </button>
                            </form>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tambahkan event listener untuk setiap item dropdown
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function(event) {
                event.preventDefault();
                // Ambil role dari data-role attribute
                var role = this.getAttribute('data-role');
                // Setel nilai dropdown menjadi role yang dipilih
                document.getElementById('dropdownMenuButton').innerText = this.innerText;
                document.getElementById('dropdownMenuButton').setAttribute('data-role', role);
                // Filter tabel berdasarkan role yang dipilih
                filterTable(role);
            });
        });

        // Fungsi untuk memfilter tabel berdasarkan role pengguna
        function filterTable(role) {
            var rows = document.querySelectorAll('.data-table tbody tr');
            rows.forEach(row => {
                var roleCell = row.querySelector('td:nth-child(7)').innerText.toLowerCase();
                if (role === 'all' || (role === 'pembaca' && roleCell === 'pembaca') || (role === 'petugas' && (roleCell === 'admin' || roleCell === 'pustakawan'))) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    });
</script>


@endsection
