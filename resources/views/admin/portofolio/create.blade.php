<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- ada form yang isi input nya yaitu:
    nis siswa
    nama lomba
    file dokumentasi
    deksripsi lomba
    tanggal lomba
    tingkat lomba dropdwown internasional, nasional, provinsi, kota
    tingkat juara dropdwown 1,2,3, dan pilihan isi sendiri
    poin lomba
    --}}
    <form action="{{ route('admin.portofolio.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="nis">NIS Siswa:</label>
        <input type="text" id="nis" name="nis" required><br><br>

        <label for="nama_lomba">Nama Lomba:</label>
        <input type="text" id="nama_lomba" name="nama_lomba" required><br><br>

        <label for="file_evidence">File Dokumentasi:</label>
        <input type="file" id="file_evidence" name="file_evidence" accept="image/*,application/pdf" required><br><br>

        <label for="deskripsi_lomba">Deskripsi Lomba:</label>
        <textarea id="deskripsi_lomba" name="deskripsi_lomba" required></textarea><br><br>

        <label for="tanggal_lomba">Tanggal Lomba:</label>
        <input type="date" id="tanggal_lomba" name="tanggal_lomba" required><br><br>

        <label for="tingkat_lomba">Tingkat Lomba:</label>
        <select id="tingkat_lomba" name="tingkat_lomba" required>
            <option value="">--Pilih Tingkat--</option>
            <option value="internasional">Internasional</option>
            <option value="nasional">Nasional</option>
            <option value="provinsi">Provinsi</option>
            <option value="kota">Kota</option>
        </select><br><br>

        <label for="tingkat_juara">Tingkat Juara:</label>
        <select id="tingkat_juara" name="tingkat_juara" required>
            <option value="">--Pilih Tingkat Juara--</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="lainnya">Lainnya (isi sendiri)</option>
        </select>
        <input type="text" id="tingkat_juara_lainnya" name="tingkat_juara_lainnya" placeholder="Isi jika memilih 'Lainnya'" style="display:none;"><br><br>

        <label for="poin_lomba">Poin Lomba:</label>
        <input type="number" id="poin_lomba" name="poin_lomba" required><br><br>
        <button type="submit">Submit</button>
    </form>
    <script>
        document.getElementById('tingkat_juara').addEventListener('change', function() {
            var lainnyaInput = document.getElementById('tingkat_juara_lainnya');
            if (this.value === 'lainnya') {
                lainnyaInput.style.display = 'inline';
                lainnyaInput.required = true;
            } else {
                lainnyaInput.style.display = 'none';
                lainnyaInput.required = false;
                lainnyaInput.value = '';
            }
        });
    </script>
    @php
        dd($_POST, $_FILES);
    @endphp
</body>
</html>