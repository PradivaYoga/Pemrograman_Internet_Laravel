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
        a { text-decoration: none; }
        .btn { 
            padding: 8px 14px; 
            background: #007BFF; 
            color: white; 
            border-radius: 6px; 
            transition: 0.2s; 
        }
        .btn:hover { background: #0056b3; }
        .btn-danger { background: crimson; }
        .btn-danger:hover { background: darkred; }
        .container { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Program Studi</h2>

        {{-- Tombol tambah hanya untuk admin --}}
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('prodi.create') }}" class="btn">+ Tambah Program Studi</a>
            @endif
        @endauth
        <br><br>

        {{-- Pesan sukses --}}
        @if(session('success'))
            <p style="color:green;">{{ session('success') }}</p>
        @endif

        <table>
            <tr>
                <th>ID</th>
                <th>Nama Program Studi</th>
                <th>Fakultas</th>
                {{-- Kolom aksi hanya untuk admin --}}
                @if(Auth::user()->role === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>

            @forelse($prodis as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->fakultas->nama ?? '-' }}</td>

                    {{-- Tampilkan kolom aksi hanya untuk admin --}}
                    @if(Auth::user()->role === 'admin')
                        <td>
                            <a href="{{ route('prodi.edit', $p->id) }}" class="btn">Edit</a>
                            <form action="{{ route('prodi.destroy', $p->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ Auth::user()->role === 'admin' ? 4 : 3 }}">
                        Belum ada data.
                    </td>
                </tr>
            @endforelse
        </table>

        <a href="{{ route('dashboard') }}" class="btn" style="margin-top:20px;">Kembali ke Dashboard</a>
    </div>
</body>
</html>
