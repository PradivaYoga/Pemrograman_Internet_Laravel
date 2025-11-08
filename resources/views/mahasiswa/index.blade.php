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
        <h2>Daftar Mahasiswa</h2>

        {{-- Tombol tambah hanya untuk admin --}}
        @auth
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('mahasiswa.create') }}" class="btn">+ Tambah Mahasiswa</a>
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
                <th>NIM</th>
                <th>Nama</th>
                <th>Program Studi</th>
                <th>Fakultas</th>
                {{-- Kolom aksi hanya untuk admin --}}
                @if(Auth::user()->role === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>

            @forelse($mahasiswas as $m)
                <tr>
                    <td>{{ $m->id }}</td>
                    <td>{{ $m->nim }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->prodi->nama ?? '-' }}</td>
                    <td>{{ $m->prodi->fakultas->nama ?? '-' }}</td>

                    {{-- Tampilkan kolom aksi hanya untuk admin --}}
                    @if(Auth::user()->role === 'admin')
                        <td>
                            <a href="{{ route('mahasiswa.edit', $m->id) }}" class="btn">Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $m->id) }}" method="POST" style="display:inline;">
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
                    <td colspan="{{ Auth::user()->role === 'admin' ? 6 : 5 }}">
                        Belum ada data.
                    </td>
                </tr>
            @endforelse
        </table>

        <a href="{{ route('dashboard') }}" class="btn" style="margin-top:20px;">Kembali ke Dashboard</a>
    </div>
</body>
</html>
