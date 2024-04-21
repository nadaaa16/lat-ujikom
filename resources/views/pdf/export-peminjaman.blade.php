<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Daftar Peminjaman</h2>
    <table>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Tanggal Dipinjam</th>
                <th scope="col">Tanggal Dikembalikan</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjaman as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->buku->judul }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_kembali }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
