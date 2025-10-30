<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef2f5; text-align: center; }
        form { display: inline-block; background: white; padding: 20px; border-radius: 10px; margin-top: 40px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        input, select { margin: 10px; padding: 8px; width: 250px; border-radius: 6px; border: 1px solid #ccc; }
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

        {{-- Dropdown Fakultas --}}
        <select id="fakultas" name="id_fakultas" required>
            <option value="">-- Pilih Fakultas --</option>
            @foreach(\App\Models\Fakultas::orderBy('nama')->get() as $f)
                <option value="{{ $f->id }}">{{ $f->nama }}</option>
            @endforeach
        </select><br>

        {{-- Dropdown Prodi (akan berubah otomatis setelah fakultas dipilih) --}}
        <select id="prodi" name="id_prodi" required>
            <option value="">-- Pilih Program Studi --</option>
        </select><br>

        <button type="submit">Simpan</button>
    </form>
    <a href="{{ route('mahasiswa.index') }}">Kembali</a>

    <script>
        // Ketika fakultas dipilih, ambil prodi dengan AJAX
        document.getElementById('fakultas').addEventListener('change', function() {
            const fakultasId = this.value;
            const prodiSelect = document.getElementById('prodi');
            prodiSelect.innerHTML = '<option value="">-- Memuat data... --</option>';

            if (fakultasId) {
                fetch(`/get-prodi/${fakultasId}`)
                    .then(response => response.json())
                    .then(data => {
                        prodiSelect.innerHTML = '<option value="">-- Pilih Program Studi --</option>';
                        data.forEach(prodi => {
                            const option = document.createElement('option');
                            option.value = prodi.id;
                            option.textContent = prodi.nama;
                            prodiSelect.appendChild(option);
                        });
                    })
                    .catch(() => {
                        prodiSelect.innerHTML = '<option value="">-- Gagal memuat data --</option>';
                    });
            } else {
                prodiSelect.innerHTML = '<option value="">-- Pilih Program Studi --</option>';
            }
        });
    </script>
</body>
</html>
