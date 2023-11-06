<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/doc.css') }}">
</head>
<body>
    <div class="container-fluid ">
        <div class="nav pt-3 pb-4 d-flex justify-content-start">
            <div class="ms-md-5 ms-2">
                <a class="navLogo" href="#"><img src="{{ asset('assets/img/katapang.png') }}" alt="" srcset="" width="45px" height="45px"></a>
            </div>
            <div class="pt-2 ms-2">
                <h4> Website Keputrian </h4>
            </div>
        </div>

        <div class="col-md-12 mt-3 mt-md-0">
            <div class="titleDoc text-center">
                <h6> Galeri Dokumentasi</h6>
                <h1 class="fw-bold" style="color:#2682a9;"> Arsip Keputrian </h1>
                <p> Sekolah Menengah Kejuruan Negeri 1 Katapang </p>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <hr class="rule rounded-pill mt-4" style="width:45%;" >
            <img src="{{ asset('assets/img/katapang.png') }}" alt="" srcset="" width="40px" height="40px" class="mx-4">
            <hr class="rule rounded-pill mt-4" style="width:45%;" >
        </div>

        <div class="row mx-3 mt-3">
            <div class="d-flex justify-content-between">
                <form action="{{ route('sort.activity') }}" method="post">
                    <div class="select">
                            @csrf
                            <select name="sort" class="sort">
                                <option selected disabled value="">Sort By</option>
                                <option value="oldest">Tanggal Terlama</option>
                                <option value="newest">Tanggal Terbaru</option>
                            </select>
                    </div>
                </form>
                <div class="search">
                    <form action="{{ route('search.activity') }}" method="post">
                        @csrf
                        <input type="text" name="search" id="search" class="search-input" placeholder="Search....">
                            <div class="search-icon">
                                <button type="submit" class="buttonSearch"><i class="fas fa-search"></i></button> <!-- Anda dapat menggunakan ikon lain -->
                            </div>
                    </form>
                </div>
            </div>
        </div>
       
        <div class="row mx-3 mt-3">
        @foreach($activitymodel as $key => $report)
                <div class="list-image pt-md-3 pt-0 col-lg-3 col-md-6 col-12 mx-mdvh-auto mx-auto my-md-1 my-2" >
                    <img src="{{ Storage::url($report->image) }}" width="100%" height="170" class="image object-fit-cover d-flex mx-auto  shadow-sm " 
                        alt="...">
                    <div class="body text-center mt-md-3 mt-0">
                        <p class="date fw-semibold"> <i>{{ date('d M Y', strtotime($report->date)) }}</i>  </p>
                        <h5 class="activity fw-bold">{{ $report->jenis_kegiatan }} </h5>
                        <p class="locket"> {{ $report->lokasi }} - {{ $report->keterangan }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <footer class="text-center text-white"  style="background-color: #f0f0f0;">
        <div class="container pt-0" >
            <section class="">
            <!-- Facebook -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-facebook-f"></i
            ></a>
            <!-- Wa -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-whatsapp"></i
            ></a>
            <!-- Instagram -->
            <a
                class="btn btn-link btn-floating btn-lg text-dark m-1"
                href="#!"
                role="button"
                data-mdb-ripple-color="dark"
                ><i class="fab fa-instagram"></i
            ></a>
            </section>
        </div>
        <div class="text-center text-white p-2" style="background-color: #2682A9;">
            © 2023 Copyright:
            <a class="text-white" href="https://www.smkn1katapang.sch.id/">smkn1katapang.sch.id</a>
        </div>
    </footer>        
</body>
</html>

<script>
    document.querySelector('.sort').addEventListener('change', function () {
        this.form.submit();
    });
</script>



