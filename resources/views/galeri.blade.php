@extends('layouts.navbar')

@section('content')
<section class="section-dr-py bg-body ">
    <div class="container">
      <h3 class="text-center mb-3 mb-md-5"><span class="section-title">Berita</h3>
      <div class="row mt-5">
        <div class="col-12 col-md-4">
        <form action="galeri" method="GET">
        <div class="input-group">
            <input type="text" name="query" placeholder="Cari Berita ...." class="form-control" value="{{ request('query') }}" />
            <div class="input-group-append">
                <button class="btn btn-primary rounded-left" type="submit"><i class="ti ti-search"></i> Cari</button>
            </div>
        </div>
        </form>
        </div>
      </div>
      <div class="row gy-5 mt-2 mt-md-3">
        @foreach ($cardfoto as $item)
        <div class="col-lg-4 col-sm-6">
          <div class="card h-100 bg-label-primary text-white shadow-lg">
            <div class="card-body">
              <div class="bg-primary rounded-3 text-center mb-3 overflow-hidden">
                <img
                  class="img-pr img-fluid"
                  src="{{ asset('assets/dataimage/' . $item->image) }}"
                  alt="campaign image" />
              </div>
              <div>
                <ul class="p-0 m-0">
                  <li class="d-flex mb-3 pb-1">
                    <div class="w-100 align-items-center">
                      <div class="col-12">
                      @php
                        // Convert the date string to a Carbon object
                        $carbonDate = \Carbon\Carbon::parse($item->date);
                    @endphp
                            <h6 class="mb-2 text-black">{{ $item->jenis_kegiatan }} - {{ $item->lokasi }} - {{ $item->keterangan }} <br> {{  $carbonDate->format('d F Y')  }}</small>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        </div>
        
      {{-- <div class="row mt-5">
        <div class="col-12 d-flex align-items-center justify-content-center">
          <button class="btn btn-primary btn-lg">Lebih Banyak</button>
        </div>
      </div> --}}
    </div>
  </section>
@endsection