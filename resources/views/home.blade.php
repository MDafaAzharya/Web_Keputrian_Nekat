@extends('navbar')

@section('content')
<section class="mt-5 home">
  <div class=" mt-5 ">
    <div id="carouselExampleCaptions" class="carousel slide px-lg-5">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="image-carousel mx-auto d-flex" src="{{ asset('assets/img/habibi.jpg') }}" class="d-block " alt="..." width="900">
          <div class="carousel-caption d-none d-md-block">
            <h5 class="text-black">First slide label</h5>
            <p class="text-black">Some representative placeholder content for the first slide.</p>
          </div>
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
        <div class="col-lg-6">
            <img src="{{ asset('assets/img/habibi.jpg') }}" alt="" srcset=""  class="profile-image mx-auto mx-md-0 d-flex">
        </div>
        <div class="col-lg-6 mt-lg-5">
            <h4 class="mt-3 mt-md-0 text-black"><strong>Profile Keputrian</strong></h4>
            <p class="fs-6 text-black">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio temporibus tempora dolorem, odio saepe eum placeat nobis culpa atque adipisci quidem eaque quos unde consequuntur itaque repellat error dolor fugit.</p>
        </div>
      </div>
    </div>
</section>
<section class=" bg-body">
        <div class="container">
          <h3 class="text-center"><span class="section-title">Galeri</h3>
          <div class="row gy-5 mt-2 mt-md-0">
            <div class="col-lg-4 col-sm-6">
              <div class="card h-100 text-white shadow-lg">
                <div class="card-body">
                  <div class="bg-primary rounded-3 text-center mb-3 overflow-hidden">
                    <img
                      class="img-pr img-fluid"
                      src="{{ asset('assets/img/habibi.jpg') }}"
                      alt="campaign image" />
                  </div>
                  <div>
                    <ul class="p-0 m-0">
                      <li class="d-flex mb-3 pb-1">
                        <div class="w-100 align-items-center">
                          <div class="col-12">
                            <h6 class="mb-2 text-black">Pembacaan Rangkaian kegiatan tahun 2024</small>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <a href="" class="btn btn-primary w-100 text-white">Selengkapnya</a>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-12 d-flex align-items-center justify-content-center mb-5">
              <a href=""><button class="btn btn-primary btn-lg">Selengkapnya</button></a>
            </div>
          </div>
        </div>
      </section>
@endsection