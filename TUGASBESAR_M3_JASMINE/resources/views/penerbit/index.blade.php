<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Penerbit & Supplier</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Editor.css') }}">
</head>
<body>
    <div class="table-container">
        <h2>Data Penerbit & Supplier</h2>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Penerbit</th>
                <th>Nama Supplier</th>
                <th>Kontak Sales</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            @forelse ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_penerbit }}</td>
                <td>{{ $item->nama_supplier }}</td>
                <td>{{ $item->kontak_sales }}</td>
                <td>{{ $item->alamat }}</td>
                <td>
                    <form action="{{ route('penerbit.status', $item->id) }}" method="POST" class="status-form">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()"
                            class="status-select {{ $item->status == 'Berhasil' ? 'status-berhasil' : 'status-diproses' }}">
                            <option value="Diproses" {{ $item->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="Berhasil" {{ $item->status == 'Berhasil' ? 'selected' : '' }}>Berhasil</option>
                        </select>
                    </form>
                </td>
                <td class="aksi">
                    <a href="{{ route('penerbit.edit', $item->id) }}">Edit</a>
                    <form action="{{ route('penerbit.destroy', $item->id) }}" method="POST" style="display:inline"
                          onsubmit="return confirm('Yakin mau hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="width:auto;color:#d08c8c;background:#fbeaea;padding:6px 14px;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;">Belum ada data</td></tr>
            @endforelse
        </table>

        <a href="{{ route('penerbit.create') }}" class="tambah-btn">+ Tambah Data Baru</a>
    </div>
</body>
</html>