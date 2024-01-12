<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg px-lg-5 mx-lg-5 mt-lg-3 sticky-top">
  <div class="container-fluid ">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('assets/img/katapang.png') }}" alt="" srcset="" width="50">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-lg-flex justify-content-between pe-lg-5 me-lg-5" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="{{route('home')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('galeri')}}">Galeri</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('agenda')}}">Jadwal</a>
        </li>
      </ul>
      <ul class="navbar-nav ">
      <li class="nav-item d-flex offset-lg-10">
            <a class="nav-login px-3 py-2 rounded d-flex justify-content-start" href="/login">
                <i class="fa-solid fa-arrow-right-to-bracket mt-1 me-2"></i>
                Login
            </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const navbar = document.querySelector(".navbar");

    window.addEventListener("scroll", function() {
      if (window.scrollY > 0) {
        navbar.classList.add("scrolled");
      } else {
        navbar.classList.remove("scrolled");
      }
    });
  });
</script>

<main>
    @yield('content')
</main>

 <!-- Footer: Start -->
 <footer class="landing-footer footer-text mt-5 py-5">
   <div class="footer-top">
     <div class="container">
       <div class="row g-md-5">
         <div class="col-lg-4">
          <h6 class="footer-title text-uppercase text-white"> Keputrian Katapang</h6>
           <p class="footer-text mb-4 text-white">
             Satuan organisasi yang mengelola Gerakan Pramuka tingkat nasional, dan 
             berkedudukan di Ibukota Negara,Jakarta
             <br><br>
             "Gerakan Pramuka Wadah Utama Pembentukan Kadar Pemimpin Bangsa"
           </p>
         </div>
         <div class="col-lg-5 col-md-4 col-sm-6 ms-lg-5">
           <h6 class="footer-title mb-4 text-uppercase text-white">Contact</h6>
           <p  class="footer-text mb-4 text-white">
            Banjaran<br>
            Email : mdafaazharya@gmail.com <br>
            Telfon : 08967868  
           </p>
         </div>
         <div class="col-lg-2 col-md-4 col-sm-6">
           <h6 class="footer-title mb-4 text-uppercase text-white">Media Sosial</h6>
           <ul class="list-unstyled justify-content-start d-flex">
             <li class="mb-3">
               <a href="" target="_blank" class="footer-link"><i class="fa-solid fa-globe fa-xl" style="color:white;"></i></a>
             </li>
             <li class="mb-3">
               <a href="" target="_blank" class="footer-link ms-3"><i class="fa-brands fa-instagram fa-xl" style="color:white;"></i></a>
             </li>
           </ul>
         </div>
       </div>
       <div class="row mt-2">
          <div class="col-12">
              <hr class="text-white">
              <p class="footer-text text-white">© 2022 Company, Inc. All rights reserved.</p>
          </div>
       </div>
     </div>
   </div>
   
 </footer>
 <!-- Footer: End -->
</body>
</html>