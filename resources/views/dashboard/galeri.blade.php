@extends('../layouts/nav')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/galeri.css') }}">
<div class="container">
<h4 class="mt-5 mb-4"><span class="text-muted fw-light"> Dashboard /</span> Galeri</h4>
    <div class="card mb-3 border-0">
        <div class="p-2 card-top">
            <div class="ms-auto p-2">
                <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-insert">
                    <i class="fa-solid fa-user-plus"></i>
                    <span class="mx-2">Tambah foto</span>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
    @foreach ($image as $item)
            <style>
                /* Menentukan tinggi tetap dengan rasio aspek 16:9 */
                .image-card {
                    /* position: relative; */
                    padding-bottom: 52.6%;
                    /* 9:16 ratio (9 / 16 * 100) */
                    height: 0;
                    overflow: hidden;
                }

                .image-card img {
                    /* position: absolute; */
                    object-fit: contain;
                    /* Untuk memastikan gambar terisi penuh di dalam kotak */
                }
            </style>
            <div class="col-sm-4 mb-3 ">
                <div class="card card-foto">
                    <div class="card-header border-0 d-flex justify-content-between">
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="MonthlyCampaign" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical" style="color:white;"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="MonthlyCampaign" >
                                <a class="dropdown-item deleteprogram" type="button" id="" 
                                    data-id="{{ $item->id }}">Hapus</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-0">
                        <div class="bg-primary rounded-3 image-card text-center mb-3 overflow-hidden">
                            <img class="img-fluid" src="{{ asset('assets/dataimage/'. $item->nama_file)}}"
                                alt="campaign image" />
                        </div>
                    </div>
                </div>
            </div>
       @endforeach
    </div>
   
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Input Foto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addNewCCForm" class="row g-3" method="post" action="{{ route('galeri.data-galeri-register') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="col-12">
                    <label class="form-label w-100" for="modalAddCard">Upload Foto</label>
                    <div class="input-group">
                        <input type="file" class="form-control" name="foto" required>
                    </div>
                    <div id="error-message"></div>
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


<script>
        @if (session()->has('success'))
            $(function() {
                Swal.fire({
                    icon: 'success',
                    type: 'success',
                    text: '{{ session()->get('success') }}',
                });
                setTimeout(
                    "location.href='{{ route('galeri-dashboard') }}'",
                    1000);
            });
        @endif
</script>
<script>
$('.deleteprogram').on('click', function() {
    var id = $(this).data('id');
    console.log(id);
    Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "Anda tidak akan dapat mengembalikan data ini !!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ url('dashboard/galeri-dashboard/data-galeri-delete') }}/" + id,
                type: "get",
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        type: 'success',
                        text: 'Data Berhasil Di Hapus',
                    });
                    setTimeout(
                        "location.href='{{ route('galeri-dashboard') }}'",
                        1000);
                }
            });
        };
    })
});
</script>
@endsection

