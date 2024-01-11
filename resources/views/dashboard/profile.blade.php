@extends('../layouts/nav')

@section('content')
<div class="prof row my-5 pt-3 d-flex justify-content-center">
      <div class="col-lg-4 col-md-8 col-10 mt-1">
        <div class="card mb-5">
          <div class="card-body text-center">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3">{{Auth::user()->name}}</h5>
            <p class="text-muted mb-1">{{Auth::user()->email}}</p>
            <p class="text-muted mb-4">Admin</p>
            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-outline-primary ms-1" data-bs-toggle="modal" data-bs-target="#EditAkun">Edit Data</button>
            </div>
          </div>
        </div>
</div>

<!-- Modal Insert -->
<div class="modal fade" id="EditAkun" tabindex="-1" aria-labelledby="EditAkunLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="EditAkunLabel">Edit Akun</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                <div class="form-group mb-3 d-md-flex justify-content-between">
                    <label for="name" class="form-label my-auto">Username</label>
                    <input type="name" class="form-control me-4" id="name" value="{{Auth::user()->name}}" name="name" style="width:70%;">
                </div>
                <div class="form-group mb-3 d-md-flex justify-content-between">
                    <label for="email" class="form-label my-auto">Email</label>
                    <input type="email" class="form-control me-4" id="email" value="{{Auth::user()->email}}" readonly name="email" style="width:70%;background:#f0f0f0">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Edit Data</button>
        </div>
        </form>
        </div>
    </div>
</div>
<!-- End Modal Insert -->
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
@endsection