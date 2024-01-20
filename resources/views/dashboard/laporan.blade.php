<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Peminjaman Buku</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .laporan {
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .paper {
            width: 100%;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        td {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="laporan">
        <h2>Laporan Peminjaman</h2>
        <div class="paper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kode peminjaman</th>
                        <th>Tgl peminjaman</th>
                        <th>Tgl kembali</th>
                        <th>Dikembalikan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjamans as $peminjaman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $peminjaman->buku->judul }}</td>
                            <td>{{ $peminjaman->kode }}</td>
                            <td>{{ $peminjaman->tgl_peminjaman }}</td>
                            <td>{{ $peminjaman->tgl_kembali }}</td>
                            <td>{{ $peminjaman->dikembalikan == null ? '-' : $peminjaman->dikembalikan}}</td>
                            <td>{{ $peminjaman->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>