@extends('../layouts/navbar')

@section('content')
<style>
  .img-pr{
    width:100%;
    object-fit:cover;
  }
    .profile-image{
      width:500px;
      height:300px;
      object-fit: cover;

    }
    @media (min-width: 320px) and (max-width: 767px){
      .profile-image{
      width:300px;
      height:170px;
      object-fit: cover;
      }
    }
</style>

<section class="mt-5 home">
  <div class="mt-5">
    <div id="carouselExampleCaptions" class="carousel slide px-lg-5">
      <div class="carousel-indicators">
        @foreach ($foto as $index => $item)
          <button type="button" data-bs-target="#carouselExampleCaptions" style="background-color:#2682A9;border-radius:50%;height:10px;width:10px;" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
        @endforeach
      </div>
      <div class="carousel-inner">
        @foreach ($foto as $index => $item)
          <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
            <img class="image-carousel mx-auto d-flex" src="{{ asset('assets/dataimage/'. $item->nama_file) }}" class="d-block " alt="..." width="900">
            <div class="carousel-caption d-none d-md-block">
              <h5 class="text-black fw-bold">Kegiatan Keputrian</h5>
              <p class="text-black fw-bold">SMKN 1 Katapang.</p>
            </div>
          </div>
        @endforeach
      </div>
      <button class="carousel-control-prev ms-5" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next me-5" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</section>
  <section class="py-4 my-5 mb-5 konten-2 profile-body">
    <div class="container">
      <div class="row">
        @foreach ($keputrian as $item)
        <div class="col-lg-6">
            <img src="{{ asset('assets/dataimage/' .$item->gambar) }}" alt="" srcset=""  class="profile-image mx-auto mx-md-0 d-flex">
        </div>
        <div class="col-lg-6 mt-lg-5">
            <h4 class="mt-3 mt-md-0 text-black text-center text-md-start"><strong>{{ $item->judul }}</strong></h4>
            <p class="fs-6 text-black">{!! $item->text !!}</p>
        </div>
        @endforeach
      </div>
    </div>
</section>
<section class=" bg-body">
        <div class="container">
          <h3 class="text-center"><span class="section-title">Galeri</h3>
          <div class="row gy-5 mt-2 mt-md-0">
          @foreach ($cardfoto->take(6) as $item)
            <div class="col-lg-4 col-sm-6">
              <div class="card h-100 text-white shadow-lg">
                <div class="card-body">
                  <div class="bg-primary rounded-3 text-center mb-3 overflow-hidden pembungkus">
                  @if($item->image)
                    @php
                        $imagePaths = json_decode($item->image);
                    @endphp

                    @if(!empty($imagePaths))
                        {{-- Menampilkan hanya satu gambar (ambil indeks pertama) --}}
                        @php
                            $firstImagePath = reset($imagePaths);
                        @endphp
                        <img src="{{ asset('assets/dataimage/' . $firstImagePath) }}"  data-bs-toggle="tooltip" class="img-pr img-fluid">
                    @else
                        No Image
                    @endif
                  @else
                      No Image
                  @endif
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
                  <a href="{{ route('galeri-detail', ['id' => $item->id]) }}" class="btn bg-primary w-100 text-white">Selengkapnya</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="row mt-5">
            <div class="col-12 d-flex align-items-center justify-content-center mb-5">
              <a href="{{ route('galeri') }}"><button class="btn btn-primary btn-lg">Selengkapnya</button></a>
            </div>
          </div>
        </div>
      </section>
@endsection