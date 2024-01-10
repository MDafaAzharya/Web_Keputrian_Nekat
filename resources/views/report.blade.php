@extends('nav')

@section('content')
<div class="row">
    <div class="col-10 mx-auto mt-5">
        <h5>Selamat Datang <b>{{Auth::user()->name}}</b>.</h5>
    </div>
    <div class="card shadow col-10  mx-auto mb-5">
        <div class="card-title justify-content-between d-md-flex">
            <div class="my-auto mt-3 mt-md-0 py-md-3 ps-4 mt-md-1">
                <h4 class="title "> Daftar Laporan Kegiatan </h4>
            </div>
            <div>
                <button type="button" class="btn-insert my-md-3 mb-3  ms-4 ms-md-0 " id="print-button" data-bs-toggle="modal" data-bs-target="#dateRangeModal"> Print data</button>
                <button type="button" class="btn-insert my-md-3 mb-3 me-md-4  ms-md-0 " data-bs-toggle="modal" data-bs-target="#exampleModal"> Tambah data</button>
            </div>
        </div>
        <div class="card-body mt-5 pt-5 table-responsive">
            <table id="example" class="table table-hover table-bordered py-3"  style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jenis Kegiatan</th>
                        <th>Lokasi</th>
                        <th>Keterangan</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activitymodel as $key => $report)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{$report->date }}</td>
                        <td>{{ $report->jenis_kegiatan }}</td>
                        <td>{{ $report->lokasi }}</td>
                        <td>{{ $report->keterangan }}</td>
                        <td class="text-center">
                            @if($report->image)
                            <div class="mb-2">
                                <img src="{{ asset('assets/dataimage/' .$report->image) }}" height="110" width="110" alt="" srcset="" data-bs-toggle="tooltip" >
                            </div>
                            @else
                            No Image
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="" data-bs-toggle="modal" data-bs-target="#editmodal" class="edit-data" data-id="{{ $report->id }}"><i class="fa-solid fa-pen-to-square" style="color: white;background-color:dodgerblue; padding:5px;border-radius:5px;"></i></a>
                            <a href="{{ route('report.delete', ['id' => $report->id]) }}" class="delete-data"><i class="fa-solid fa-trash-can" style="color: white;background-color:red; padding:5px;border-radius:5px;"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
    </div>
</div>

<!-- Modal Insert -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Input Laporan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('insert.activity') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3 d-md-flex justify-content-between">
                    <label for="date" class="form-label my-auto">Tanggal</label>
                    <input type="date" class="form-control me-4" id="date" name="date" style="width:70%;">
                </div>
                <div class="form-group mb-3 d-md-flex justify-content-between">
                    <label for="activity" class="form-label my-auto">Kegiatan</label>
                    <input type="text" class="form-control me-4" id="activity" placeholder="Jenis Aktivitas" required autocomplete="off" name="activity" style="width:70%;">
                </div>
                <div class="form-group mb-3 d-md-flex justify-content-between">
                    <label for="place" class="form-label my-auto">Lokasi</label>
                    <input type="text" class="form-control me-4" id="place" placeholder="Ruangan" name="place" required autocomplete="off" style="width:70%;">
                </div>
                <div class="form-group mb-3 d-md-flex justify-content-between">
                    <label for="ket" class="form-label my-auto">Keterangan</label>
                    <input type="text" class="form-control me-4" id="ket" placeholder="Keterangan" name="ket" required autocomplete="off" style="width:70%;">
                </div>
                <div class="form-group mb-3 d-md-flex justify-content-between">
                    <label for="image" class="form-label my-auto">Dokumentasi</label>
                    <input type="file" class="form-control me-4" id="image" name="image" style="width:70%;">
                </div>
                
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
        </form>
        </div>
    </div>
</div>
<!-- End Modal Insert -->
<!-- Modal Edit -->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="editmodalLabel">Edit Laporan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('update.activity') }}" method="post" enctype="multipart/form-data">
                @csrf
            <input type="hidden" id="edit-report-id" name="report_id">
                <div class="form-group mb-3 d-md-flex justify-content-between">
                    <label for="date" class="form-label my-auto">Tanggal</label>
                    <input type="date" class="form-control me-4" id="edit-date" name="date" style="width:70%;">
                </div>
                <div class="form-group mb-3 d-md-flex justify-content-between">
                    <label for="activity" class="form-label my-auto">Kegiatan</label>
                    <input type="text" class="form-control me-4" id="edit-activity" placeholder="Jenis Aktivitas" name="activity" style="width:70%;">
                </div>
                <div class="form-group mb-3 d-md-flex justify-content-between">
                    <label for="place" class="form-label my-auto">Lokasi</label>
                    <input type="text" class="form-control me-4" id="edit-place" placeholder="Ruangan" name="place" style="width:70%;">
                </div>
                <div class="form-group mb-3 d-md-flex justify-content-between">
                    <label for="ket" class="form-label my-auto">Keterangan</label>
                    <input type="text" class="form-control me-4" id="edit-ket" placeholder="Keterangan" name="ket" style="width:70%;">
                </div>
                <div class="form-group mb-3 d-md-flex justify-content-between">
                    <label for="image" class="form-label my-auto">Dokumentasi</label>
                    <input type="file" class="form-control me-4" id="edit-image" name="image" style="width:70%;">
                </div>
                <div id="previous-image-container">
                    <img id="previous-image" src="" alt="Gambar Sebelumnya" style="max-width: 80px; max-height: 80px; border:1px solid #000">
                    <label for="" style="font-size:12px;">*Pilih File lagi jika ingin merubah gambar</label>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submoit" class="btn btn-primary">Edit</button>
        </div>
        </form>
        </div>
    </div>
</div>
<!-- End Modal Edit -->

<!-- Modal Print -->
<div class="modal fade" id="dateRangeModal" tabindex="-1" aria-labelledby="dateRangeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dateRangeModalLabel">Pilih Rentang Tanggal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="dateRangeForm">
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Tanggal Awal</label>
                        <input type="date" class="form-control" id="startDate" name="startDate">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="print-modal-button">Cetak</button>
            </div>
        </div>
    </div>
</div>

<!-- End Modal Print -->

<script>
new DataTable('#example');
</script>
<script>
    // Event handler untuk tombol "Edit"
    $('.edit-data').click(function(e) {
        e.preventDefault();
        var reportId = $(this).data('id'); // Mendapatkan ID laporan dari atribut data-id
        var reportRow = $(this).closest('tr');
        var reportDate = reportRow.find('td:nth-child(2)').text(); // Mendapatkan tanggal dari kolom kedua
        var reportActivity = reportRow.find('td:nth-child(3)').text(); // Mendapatkan jenis kegiatan dari kolom ketiga
        var reportPlace = reportRow.find('td:nth-child(4)').text(); // Mendapatkan lokasi dari kolom keempat
        var reportKet = reportRow.find('td:nth-child(5)').text(); // Mendapatkan keterangan dari kolom kelima
        var reportImage = reportRow.find('td:nth-child(6) img').attr('src'); // Mendapatkan path gambar sebelumnya
        

        // Mengisi nilai input dengan data yang sesuai
        $('#edit-report-id').val(reportId);
        $('#edit-date').val(reportDate);
        $('#edit-activity').val(reportActivity);
        $('#edit-place').val(reportPlace);
        $('#edit-ket').val(reportKet);

        // Menampilkan gambar sebelumnya
    $('#previous-image').attr('src', reportImage);
    $('#previous-image-container').show(); // Menampilkan container gambar sebelumnya
    });
</script>

<script>
   document.addEventListener("DOMContentLoaded", function () {
  const deleteLinks = document.querySelectorAll(".delete-data");
  deleteLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      const url = this.getAttribute("href");
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel",
        iconHtml: '<i class="fa fa-trash"></i>', 
      }).then((result) => {
        if (result.isConfirmed) {
          setTimeout(function () {
            window.location.href = url;
          }, 1000);
          // Show success alert immediately
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          );
        }
      });
    });
  });
});
</script>

<script>
    @if(Session::has('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ Session::get('success') }}',
        });
    @endif

    @if(Session::has('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ Session::get('error') }}',
        });
    @endif
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const printModalButton = document.getElementById("print-modal-button");
        printModalButton.addEventListener("click", function () {
            const startDate = document.getElementById("startDate").value;
            const endDate = document.getElementById("endDate").value;

            if (startDate && endDate) {
                // Redirect ke halaman cetak dengan parameter tanggal
                window.open(`/print?start_date=${startDate}&end_date=${endDate}`);
            } else {
                // Jika pengguna tidak memasukkan tanggal, tampilkan pesan kesalahan atau kembali ke modal
                alert("Harap masukkan rentang tanggal.");
            }
        });
    });
</script>
@endsection