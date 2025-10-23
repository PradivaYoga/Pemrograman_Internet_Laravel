<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Program Studi</title>
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
        <h2>Daftar Program Studi</h2>
        <a href="{{ route('prodi.create') }}" class="btn">+ Tambah Prodi</a>
        <br><br>

        @if(session('success'))
            <p style="color:green;">{{ session('success') }}</p>
        @endif

        <table>
            <tr>
                <th>ID</th>
                <th>Nama Prodi</th>
                <th>Fakultas</th>
                <th>Aksi</th>
            </tr>
            @forelse($prodis as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->fakultas->nama ?? '-' }}</td>
                <td>
                    <a href="{{ route('prodi.edit', $p->id) }}">Edit</a> |
                    <form action="{{ route('prodi.destroy', $p->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" style="color:red;border:none;background:none;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4">Belum ada data.</td></tr>
            @endforelse
        </table>
    </div>
</body>
</html>
