<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Fakultas</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        table { width: 80%; margin: 20px auto; border-collapse: collapse; background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #007BFF; color: white; }
        a { text-decoration: none; color: #007BFF; }
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
        <h2>Daftar Fakultas</h2>

        {{-- Tombol tambah hanya untuk admin --}}
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('fakultas.create') }}" class="btn">+ Tambah Fakultas</a>
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
                <th>Nama Fakultas</th>
                {{-- Kolom aksi hanya untuk admin --}}
                @if(Auth::user()->role === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>

            @forelse($fakultas as $f)
                <tr>
                    <td>{{ $f->id }}</td>
                    <td>{{ $f->nama }}</td>

                    {{-- Aksi hanya muncul untuk admin --}}
                    @if(Auth::user()->role === 'admin')
                        <td>
                            <a href="{{ route('fakultas.edit', $f->id) }}" class="btn">Edit</a>
                            <form action="{{ route('fakultas.destroy', $f->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus fakultas ini?')" class="btn btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ Auth::user()->role === 'admin' ? 3 : 2 }}">
                        Belum ada data.
                    </td>
                </tr>
            @endforelse
        </table>

        {{-- Tombol kembali ke dashboard --}}
        <a href="{{ route('dashboard') }}" class="btn" style="margin-top:20px;">← Kembali ke Dashboard</a>
    </div>
</body>
</html>
