<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef2f5; text-align: center; }
        form { display: inline-block; background: white; padding: 20px; border-radius: 10px; margin-top: 40px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        input { margin: 10px; padding: 8px; width: 250px; border-radius: 6px; border: 1px solid #ccc; }
        button { background: #007BFF; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; }
        a { display: block; margin-top: 15px; color: #007BFF; text-decoration: none; }
    </style>
</head>
<body>
    <h2>Tambah Mahasiswa</h2>
    <form method="POST" action="{{ route('mahasiswa.store') }}">
        @csrf
        <input type="number" name="nim" placeholder="NIM" required><br>
        <input type="text" name="nama" placeholder="Nama" required><br>
        <input type="text" name="prodi" placeholder="Prodi" required><br>
        <button type="submit">Simpan</button>
    </form>
    <a href="{{ route('mahasiswa.index') }}">Kembali</a>
</body>
</html>
