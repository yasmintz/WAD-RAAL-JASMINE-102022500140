<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulir Data Penerbit & Supplier</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Editor.css') }}">
</head>
<body>
    <div class="form-container">
        <h2>Formulir Tambah Data Penerbit & Supplier</h2>

        <form action="{{ route('penerbit.store') }}" method="POST">
            @csrf

            <label>Nama Penerbit:</label>
            <input type="text" name="nama_penerbit" value="{{ old('nama_penerbit') }}">
            @error('nama_penerbit') <div class="error">{{ $message }}</div> @enderror

            <label>Nama Supplier:</label>
            <input type="text" name="nama_supplier" value="{{ old('nama_supplier') }}">
            @error('nama_supplier') <div class="error">{{ $message }}</div> @enderror

            <label>Kontak Sales:</label>
            <input type="tel" name="kontak_sales" placeholder="08123xxxxxxx" value="{{ old('kontak_sales') }}">
            @error('kontak_sales') <div class="error">{{ $message }}</div> @enderror

            <label>Alamat:</label>
            <textarea name="alamat" rows="5">{{ old('alamat') }}</textarea>
            @error('alamat') <div class="error">{{ $message }}</div> @enderror

            <button type="submit">Simpan Data</button>
        </form>
    </div>

    <p style="text-align:center;">
        <a href="{{ route('penerbit.index') }}">Lihat Semua Data &rarr;</a>
    </p>
</body>
</html>