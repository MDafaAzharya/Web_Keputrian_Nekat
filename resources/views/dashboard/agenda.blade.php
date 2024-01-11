@extends('layouts.nav')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/agenda.css') }}">
<div class="container">
<h4 class="py-3 mt-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Agenda </h4>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mb-5">
        <div class="card-body">
            <div id='calendar' class="calendar"></div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Agenda</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAuthentication" class="mb-3" id="agenda_insert" action="{{ route('agenda.data-agenda-register') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3"> <label for="email" class="form-label">{{ __('Judul') }}</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            id="title" name="judul" placeholder="title" required autocomplete="title" autofocus
                            value="{{ old('title') }}" /> @error('title')
                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3"> <label for="email" class="form-label">{{ __('Tanggal Mulai') }}</label>
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                            id="start_date" name="start_date" placeholder="start_date" readonly /> @error('start_date')
                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3"> <label for="email" class="form-label">{{ __('Tanggal Selesai') }}</label>
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                            id="end_date" name="end_date" placeholder="end_date" required autocomplete="end_date" autofocus
                            value="{{ old('end_date') }}" /> @error('end_date')
                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">{{ __('Warna') }}</label>
                        <select name="warna" id="color" class="form-select form-control">
                            <option value="blue">Blue</option>
                            <option value="green">Green</option>
                            <option value="red">Red</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Agenda</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAuthentication" class="mb-3" id="agenda_insert" action="{{ route('agenda.data-agenda-update') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3"> <label for="email" class="form-label">{{ __('Judul') }}</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            id="title_edit" name="judul" placeholder="title" required autocomplete="title" autofocus
                            value="{{ old('title') }}" /> @error('title')
                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3"> <label for="email" class="form-label">{{ __('Tanggal Mulai') }}</label>
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                            id="start_date_edit" name="start_date" placeholder="start_date" readonly /> @error('start_date')
                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3"> <label for="email" class="form-label">{{ __('Tanggal Selesai') }}</label>
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                            id="end_date_edit" name="end_date" placeholder="end_date" required autocomplete="end_date" autofocus
                            value="{{ old('end_date') }}" /> @error('end_date')
                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">{{ __('Warna') }}</label>
                        <select name="warna" id="color_edit" class="form-select form-control">
                            <option value="blue">Blue</option>
                            <option value="green">Green</option>
                            <option value="red">Red</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- script -->
<script>
        const modal = $('#exampleModal')
        const editmodal = $('#editModal')
        const csrfToken = $('meta[name=csrf_token]').attr('content')

        document.addEventListener('DOMContentLoaded', function() {
            const modal = $('#exampleModal');
            const agendaForm = $('#agenda_insert');
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            events: `{{ route('agenda.data-agenda-show') }}`,
            dateClick: function (info) {
                // Tangani peristiwa klik tanggal
                const selectedDate = info.dateStr;
                $('#start_date').val(selectedDate);
                modal.modal('show');
            },
            eventClick: function (info) {
                // Tangani peristiwa klik acara untuk mengedit atau menghapus
                const eventId = info.event.id;
                const eventTitle = info.event.title;

                    Swal.fire({
                        title: 'Pilihan',
                        text: 'Apa yang ingin Anda lakukan pada acara ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Edit',
                        cancelButtonText: 'Hapus',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            modalEdit(eventId);
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            // Panggil fungsi untuk menghapus event
                            deleteEvent(eventId, eventTitle);
                        }
                    });
            },
            });
            calendar.render();
        });

    function modalEdit(eventId) {
        // Ambil data kegiatan dari server berdasarkan ID
        console.log(eventId);
        $.ajax({
            url: "{{ url('dashboard/agenda-dashboard/data-agenda-edit') }}/" + eventId,
            type: 'GET',
            data: { id: eventId },
            success: function (data) {
                console.log(data);
                // Isi formulir dengan data yang diperoleh
                $('#id').val(data.id);
                $('#title_edit').val(data.judul);
                $('#start_date_edit').val(data.start_date);
                $('#end_date_edit').val(data.end_date);
                $('#color_edit').val(data.warna);

                // Tampilkan modal
                editmodal.modal('show');
            },
            error: function (error) {
                console.error(error);
            },
        });
    }
    function deleteEvent(eventId, eventTitle) {
            // Panggil fungsi SweetAlert untuk konfirmasi penghapusan
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Anda yakin ingin menghapus acara "' + eventTitle + '"?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                // Jika pengguna menekan tombol konfirmasi, hapus event
                if (result.isConfirmed) {
                    // Panggil fungsi untuk menghapus event dari server
                    deleteEventFromServer(eventId);
                }
            });
        }

        function deleteEventFromServer(eventId) {
            $.ajax({
                url: "{{ url('dashboard/agenda-dashboard/data-agenda-delete') }}/" + eventId,
                type: 'get',
                data: { id: eventId, _token: csrfToken },
                success: function (data) {
                    // Hapus event dari kalender setelah penghapusan berhasil
                    location.reload(true);
                    // Tampilkan pesan sukses
                    Swal.fire('Berhasil!', 'Acara telah dihapus.', 'success');
                },
                error: function (error) {
                    console.error(error);
                    // Tampilkan pesan kesalahan jika penghapusan gagal
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus acara.', 'error');
                },
            });
        }
    </script>
@endsection