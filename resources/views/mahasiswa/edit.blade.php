<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef2f5; text-align: center; }
        form { display: inline-block; background: white; padding: 20px; border-radius: 10px; margin-top: 40px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        input, select { margin: 10px; padding: 8px; width: 250px; border-radius: 6px; border: 1px solid #ccc; }
        button { background: #007BFF; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; }
        a { display: block; margin-top: 15px; color: #007BFF; text-decoration: none; }
    </style>
</head>
<body>
    <h2>Edit Data Mahasiswa</h2>

    <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa->id) }}">
        @csrf
        @method('PUT')

        <input type="number" name="nim" value="{{ $mahasiswa->nim }}" placeholder="NIM" required><br>
        <input type="text" name="nama" value="{{ $mahasiswa->nama }}" placeholder="Nama" required><br>

        {{-- Dropdown Fakultas --}}
        <select id="fakultas" name="fakultas" required>
            <option value="">-- Pilih Fakultas --</option>
            @foreach(\App\Models\Fakultas::orderBy('nama')->get() as $f)
                <option value="{{ $f->id }}"
                    {{ $mahasiswa->prodi && $mahasiswa->prodi->id_fakultas == $f->id ? 'selected' : '' }}>
                    {{ $f->nama }}
                </option>
            @endforeach
        </select><br>

        {{-- Dropdown Prodi --}}
        <select id="prodi" name="id_prodi" required>
            <option value="">-- Pilih Program Studi --</option>
            @if($mahasiswa->prodi)
                @foreach(\App\Models\Prodi::where('id_fakultas', $mahasiswa->prodi->id_fakultas)->get() as $p)
                    <option value="{{ $p->id }}" {{ $mahasiswa->id_prodi == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            @endif
        </select><br>

        <button type="submit">Perbarui</button>
    </form>

    <a href="{{ route('mahasiswa.index') }}">Kembali</a>

    {{-- Script AJAX --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#fakultas').on('change', function() {
            var fakultasID = $(this).val();
            $('#prodi').html('<option value="">-- Memuat Prodi... --</option>');

            if (fakultasID) {
                $.ajax({
                    url: '/get-prodi/' + fakultasID,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#prodi').empty().append('<option value="">-- Pilih Program Studi --</option>');
                        $.each(data, function(key, value) {
                            $('#prodi').append('<option value="'+ value.id +'">'+ value.nama +'</option>');
                        });
                    },
                    error: function() {
                        alert('Gagal memuat data prodi.');
                    }
                });
            } else {
                $('#prodi').html('<option value="">-- Pilih Program Studi --</option>');
            }
        });
    </script>
</body>
</html>
