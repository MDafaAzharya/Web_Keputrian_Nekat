<!DOCTYPE html>
<html>
<head>
   <title>Laporan Kegiatan</title>
</head>
<body>
    <center>
    <h2>Laporan Kegiatan Keputrian</h2>
    <h3>SMKN I KATAPANG </h3>
    <p>________________________________________________________________________</p>

    <table border="1" cellspacing="0" cellpadding="8">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jenis Kegiatan</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $key => $report)
            <tr>
                <td><center>{{ $key + 1 }}</td>
                <td><center>{{ date('d/M/Y', strtotime($report->date)) }}</td>
                <td><center>{{ $report->jenis_kegiatan }}</td>
                <td><center>{{ $report->lokasi }}</td>
                <td><center>{{ $report->keterangan }}</td>
                <td>
                    @if($report->image)
                    <img src="{{ asset('assets/dataimage/' .$report->image) }}" alt="Image" width="70" height="70">
                    @else
                    No Image
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </center>
</body>
<script>
   // Di halaman print.blade.php
document.addEventListener("DOMContentLoaded", function () {
    // Pemicu pencetakan otomatis
    window.print();

    // Menutup jendela cetak setelah selesai
    window.onafterprint = function () {
        window.close();
        window.opener.location.reload(); 
    };
});

</script>
</html>
