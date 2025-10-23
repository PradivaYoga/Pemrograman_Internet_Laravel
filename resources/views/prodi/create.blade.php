<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Program Studi</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef2f5; text-align: center; }
        form { display: inline-block; background: white; padding: 20px; border-radius: 10px; margin-top: 40px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        input, select { margin: 10px; padding: 8px; width: 250px; border-radius: 6px; border: 1px solid #ccc; }
        button { background: #007BFF; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; }
        a { display: block; margin-top: 15px; color: #007BFF; text-decoration: none; }
    </style>
</head>
<body>
    <h2>Tambah Program Studi</h2>
    <form action="{{ route('prodi.store') }}" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Nama Prodi" required><br>
        <select name="id_fakultas" required>
            <option value="">-- Pilih Fakultas --</option>
            @foreach($fakultas as $f)
                <option value="{{ $f->id }}">{{ $f->nama }}</option>
            @endforeach
        </select><br>
        <button type="submit">Simpan</button>
    </form>
    <a href="{{ route('prodi.index') }}">Kembali</a>
</body>
</html>
