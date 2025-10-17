<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { text-align: center; color: #1F2937; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #D1D5DB; padding: 8px; text-align: left; }
        th { background-color: #F3F4F6; text-transform: uppercase; font-size: 12px; color: #6B7280; }
        tr:nth-child(even) { background-color: #F9FAFB; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h1>Laporan Siswa</h1>

    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Status Kehadiran</th>
                <th>Keterangan Kehadiran</th>
                <th>Jenis Pelanggaran</th>
                <th>Tanggal Pelanggaran</th>
                <th>Pengumuman</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $siswa)
                <tr>
                    <td>{{ $siswa->nama ?? '-' }}</td>
                    <td>{{ $siswa->kehadiran->isNotEmpty() ? $siswa->kehadiran->first()->status : '-' }}</td>
                    <td>{{ $siswa->kehadiran->isNotEmpty() ? $siswa->kehadiran->first()->keterangan ?? '-' : '-' }}</td>
                    <td>{{ $siswa->pelanggaran->isNotEmpty() ? $siswa->pelanggaran->first()->jenis_pelanggaran ?? '-' : '-' }}</td>
                    <td>{{ $siswa->pelanggaran->isNotEmpty() ? \Carbon\Carbon::parse($siswa->pelanggaran->first()->tanggal)->translatedFormat('d M Y') : '-' }}</td>
                    <td>{{ $pengumuman ? $pengumuman->judul : '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>