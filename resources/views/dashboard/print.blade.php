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
                @php
                    $imagePaths = json_decode($report->image);
                    @endphp

                    @if(!empty($imagePaths))
                        @foreach($imagePaths as $imagePath)
                                <img src="{{ asset('assets/dataimage/' . $imagePath) }}" height="70" width="70" alt="" srcset="" data-bs-toggle="tooltip">
                        @endforeach
                    @else
                        No Image
                    @endif
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
