<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Guru</title>
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
    <h1>Laporan Guru</h1>

    <table>
        <thead>
            <tr>
                <th>Nama Tugas</th>
                <th>Rata-rata Nilai</th>
                <th>Nilai Tertinggi</th>
                <th>Nilai Terendah</th>
                <th>Jumlah Siswa</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($statistik as $item)
                <tr>
                    <td>{{ $item['nama_tugas'] ?? '-' }}</td>
                    <td>{{ number_format($item['rata_rata'], 2) }}</td>
                    <td>{{ $item['nilai_tertinggi'] }}</td>
                    <td>{{ $item['nilai_terendah'] }}</td>
                    <td>{{ $item['jumlah_siswa'] }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>