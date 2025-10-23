<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #007BFF; color: white; }
        a { text-decoration: none; color: #007BFF; }
        .btn { padding: 8px 14px; background: #007BFF; color: white; border-radius: 6px; }
        .btn-danger { background: crimson; }
        .container { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Mahasiswa</h2>
        <a href="{{ route('mahasiswa.create') }}" class="btn">+ Tambah Mahasiswa</a>
        <br><br>

        @if(session('success'))
            <p style="color:green;">{{ session('success') }}</p>
        @endif

        <table>
    <tr>
        <th>ID</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Prodi</th>
        <th>Fakultas</th>
        <th>Aksi</th>
    </tr>
    @forelse($mahasiswas as $m)
        <tr>
            <td>{{ $m->id }}</td>
            <td>{{ $m->nim }}</td>
            <td>{{ $m->nama }}</td>
            <td>{{ $m->prodi->nama ?? '-' }}</td>
            <td>{{ $m->prodi->fakultas->nama ?? '-' }}</td>
            <td>
                <a href="{{ route('mahasiswa.edit', $m->id) }}">Edit</a> |
                <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" style="color:red;border:none;background:none;">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6">Belum ada data.</td></tr>
    @endforelse
    </table>
    </div>
</body>
</html>
