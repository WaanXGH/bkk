<?php

$loker = get_Loker();
$relasion = get_relasi();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>BKK - JobStreet Website SMKN 2 Kota Bekasi</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:slnt,wght@-10..0,100..900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="assets/lib/animate/animate.min.css">
    <link href="assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    <!-- Navbar & Hero Start -->
    <div class="container-fluid nav-bar px-0 px-lg-3 py-lg-0">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a href="#" class="navbar-brand p-0">
                    <!-- <h1 class="text-primary mb-0"><i class="fab fa-slack me-2"></i> LifeSure</h1> -->
                    <img src="assets/img/logo.jpeg" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-0 mx-lg-auto">
                        <a href="#home" class="nav-item nav-link active">Beranda</a>
                        <a href="#tentang" class="nav-item nav-link">Tentang kami</a>
                        <a href="#relasi" class="nav-item nav-link">Relasi Perusahaan</a>
                        <a href="#lowongan" class="nav-item nav-link">Lowongan</a>

                        <div class="nav-btn px-3">
                            @auth
                            <!-- Jika user sudah login, tampilkan nama user & tombol logout -->
                            <a href="#" class="btn btn-primary rounded-pill py-2 px-5 ms-5 flex-shrink-0">
                                Halo, {{ explode(' ', Auth::user()->nama)[0] }}
                            </a>
                            <a href="{{ route('logout') }}" class="btn btn-danger rounded-pill py-2 px-4 ms-3 flex-shrink-0"
                                onclick="document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <!-- <form action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form> -->
                            @else
                            <!-- Jika user belum login, tampilkan tombol login -->
                            <a href="{{ route('login') }}" class="btn btn-primary rounded-pill py-2 px-4 ms-3 flex-shrink-0">
                                Login
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel" id="home">
        <div class="header-carousel-item bg-primary justify-content-center">
            <div class="carousel-caption">
                <div class="container p-5 mt-5" style="flex-wrap: nowrap !important;">
                    <div class="row g-4 align-items-center">
                        <div class="col-lg-7 animated fadeInLeft">
                            <div class="text-sm-center text-md-start">
                                <h4 class="text-white text-uppercase fw-bold mb-4">Selamat datang</h4>
                                <h1 class="display-1 text-white mb-20">BKK SMKN 2 Kota Bekasi</h1>
                                <p class="mb-5 fs-5">Lembaga yang bekerjasama dengan Perusahaan ternama dan menyediakan lowongan pekerjaan yang profesional.
                                </p>
                                <div class="d-flex justify-content-center justify-content-md-start flex-shrink-0 mb-4">
                                    <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 me-2" href="#"><i class="fas fa-play-circle me-2"></i> Watch Video</a>
                                    <a class="btn btn-dark rounded-pill py-3 px-4 px-md- ms-2" href="#">Learn More</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 animated fadeInRight">
                            <div class="calrousel-img" style="object-fit: cover;">
                                <img src="assets/img/carousel-2.png" class="img-fluid w-100" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Feature Start -->
    <div class="container-fluid feature bg-light py-5" id="tentang">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Tentang kami</h4>
                <h1 class="display-4 mb-4">Apa itu BKK?</h1>
                <p class="mb-0">Bursa Kerja Khusus (BKK) adalah sebuah lembaga yang dibentuk di Sekolah Menengah Kejuruan Negeri dan Swasta, sebagai unit pelaksana yang memberikan pelayanan dan informasi lowongan kerja, pelaksana pemasaran, penyaluran dan penempatan tenaga kerja, merupakan mitra Dinas Tenaga Kerja dan Transmigrasi.
                </p>
            </div>
        </div>
    </div>
    </div>
    <!-- Feature End -->

    <!-- About Start -->
    <div class="container-fluid bg-light about pb-5 ">
        <div class="container pb-3">
            <div class="row">
                <!-- Tujuan Dibentuknya BKK -->
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="about-item-content bg-white rounded p-5 h-100 shadow-sm">
                        <h1 class="display-4 mb-4 text-primary">Tujuan Dibentuknya BKK</h1>
                        <p class="mb-3">
                            Ada Banyak Kegunaan dalam menggunakan Website BKK SMKN 2 Kota Bekasi Yaitu:
                        </p>
                        <ul class="list-unstyled">
                            <li class="text-dark mb-5">
                                <i class="fa fa-check text-primary me-3"></i>
                                Sebagai wadah dalam mempertemukan tamatan dengan pencari kerja.
                            </li>
                            <li class="text-dark mb-5">
                                <i class="fa fa-check text-primary me-3"></i>
                                Memberikan layanan kepada tamatan sesuai dengan tugas dan fungsi masing-masing seksi yang ada dalam BKK.
                            </li>
                            <li class="text-dark mb-5">
                                <i class="fa fa-check text-primary me-3"></i>
                                Sebagai wadah dalam pelatihan tamatan yang sesuai dengan permintaan pencari kerja.
                            </li>
                            <li class="text-dark">
                                <i class="fa fa-check text-primary me-3"></i>
                                Sebagai wadah untuk menanamkan jiwa wirausaha bagi tamatan melalui pelatihan.
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Statistik dan Ilustrasi -->
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="statistics-section text-center bg-white rounded p-5 shadow-sm">
                        <div class="illustration mb-4">
                            <img src="assets/img/1.png" class="img-fluid" alt="Hiring Illustration" />
                        </div>
                        <div class="statistics d-flex flex-column gap-4">
                            <div class="stat-item bg-light rounded p-4">
                                <span class="stat-number display-4 text-primary fw-bold">99+</span>
                                <p class="stat-label text-dark mb-0">Perusahaan yang telah bekerja sama</p>
                            </div>
                            <div class="stat-item bg-light rounded p-4">
                                <span class="stat-number display-4 text-primary fw-bold">69+</span>
                                <p class="stat-label text-dark mb-0">Jumlah Pelamar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    <div class="container-fluid service py-5" id="relasi">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Hubungan Kerja</h4>
                <h1 class="display-4 mb-4">Relasi Perusahaan</h1>
                <p class="mb-0">Berikut Perusahaan yang telah membangun kerjasama dengan BKK SMKN 2 Kota Bekasi</p>
            </div>
            <div class="row g-4">
                <!-- Bootstrap Carousel Start -->
                <div id="serviceCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($relasion->chunk(4) as $index => $chunk)<!-- Group cards by 4 -->
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row g-4 justify-content-center">
                                @foreach ($chunk as $service)
                                <div class="col-md-6 col-lg-3">
                                    <div class="service-item">
                                        <div class="service-img position-relative">
                                            <img src="{{ Storage::url($service->image_p) }}" class="img-fluid rounded-top w-100" style="aspect-ratio: 1/1;" alt="{{ $service->nama_p }}">
                                        </div>
                                        <div class="service-content p-4">
                                            <div class="service-content-inner">
                                                <a href="#" class="d-inline-block h4 mb-4">{{ $service->nama_p }}</a>
                                                <p class="mb-4">{{ $service->detil_s }}</p>
                                                <a class="btn btn-primary rounded-pill py-2 px-4" href="#">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#serviceCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#serviceCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- Bootstrap Carousel End -->
            </div>
        </div>
    </div>

    <!-- Service End -->

    <!-- FAQs Start -->
    <div class="container-fluid faq-section bg-light py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="h-100">
                        <div class="mb-5">
                            <h4 class="text-primary">Some Important FAQ's</h4>
                            <h1 class="display-4 mb-0">pertanyaan umum tentang BKK SMKN 2 KOTA BEKASI</h1>
                        </div>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button border-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Q: Apa itu BKK SMKN 2 KOTA BEKASI?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show active" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body rounded">
                                        <strong>A:</strong> BKK SMKN 2 Kota Bekasi, atau Bursa Kerja Khusus, adalah sebuah lembaga yang didirikan untuk menjembatani lulusan SMKN 2 Kota Bekasi dengan dunia kerja. Lembaga ini bertujuan membantu siswa yang telah menyelesaikan pendidikan mereka mendapatkan pekerjaan yang sesuai dengan kompetensi dan keahlian mereka. Selain itu, BKK SMKN 2 kota bekasi juga berfungsi sebagai mitra strategis bagi perusahaan yang membutuhkan tenaga kerja berkualitas. Dengan peran ini, BKK SMKN 2 kota bekasi menjadi penghubung penting yang mempermudah proses rekrutmen bagi perusahaan sekaligus memberikan peluang kerja yang lebih luas bagi lulusan.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Q: Bagaimana cara perusahaan bermitra dengan BKK SMKN 2 Kota Bekasi?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>A:</strong> Perusahaan yang ingin bermitra dengan SMKN 2 Kota Bekasi dapat mengikuti langkah-langkah berikut:
                                        <ol>
                                            <li>Mengajukan surat permohonan resmi ke pihak BKK SMKN 2 Kota Bekasi untuk menyatakan minat kerja sama.</li>
                                            <li>Menghadiri diskusi dengan pihak sekolah untuk membahas detail kemitraan, termasuk jenis tenaga kerja yang dibutuhkan dan sektor industri yang relevan.</li>
                                            <li>Menandatangani Memorandum of Understanding (MoU) sebagai dasar hukum kerja sama.</li>
                                            <li>Memberikan informasi terkait kebutuhan tenaga kerja seperti jumlah, kualifikasi, dan keahlian yang dibutuhkan.</li>
                                            <li>Melakukan proses seleksi tenaga kerja yang difasilitasi oleh pihak BKK SMKN 2 Kota Bekasi.</li>
                                        </ol>
                                        Dengan kemitraan ini, perusahaan mendapatkan tenaga kerja yang berkualitas dan sesuai kebutuhan, serta mendukung pengembangan talenta lokal.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Q: Bagaimana siswa lulusan SMK dapat mendaftar untuk mendapatkan pekerjaan melalui BKK SMKN 2 Kota Bekasi?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>A:</strong> Lulusan SMKN 2 Kota Bekasi dapat mendaftar untuk mendapatkan pekerjaan melalui BKK dengan mengikuti langkah-langkah berikut:
                                        <ol>
                                            <li>
                                                <strong>Mengisi Formulir Pendaftaran:</strong> Formulir dapat diambil langsung di kantor BKK SMKN 2 atau diisi secara online melalui situs resmi BKK jika tersedia.
                                            </li>
                                            <li>
                                                <strong>Melengkapi Dokumen Pendukung:</strong> Siapkan dokumen seperti:
                                                <ul>
                                                    <li>Fotokopi ijazah atau surat keterangan lulus.</li>
                                                    <li>Curriculum Vitae (CV) berisi data pribadi dan pengalaman.</li>
                                                    <li>Sertifikat pendukung (jika ada).</li>
                                                </ul>
                                            </li>
                                            <li>
                                                <strong>Mengikuti Seleksi:</strong> Beberapa perusahaan yang bekerja sama mungkin mengadakan tes seleksi seperti wawancara atau ujian keterampilan. Proses ini akan difasilitasi oleh pihak BKK.
                                            </li>
                                            <li>
                                                <strong>Mendapatkan Informasi Lowongan:</strong> Setelah semua langkah selesai, siswa akan menerima pemberitahuan terkait lowongan pekerjaan yang sesuai dengan jurusan atau keterampilan mereka.
                                            </li>
                                        </ol>
                                        Dengan mengikuti proses ini, lulusan SMK memiliki peluang besar untuk mendapatkan pekerjaan yang sesuai dengan kemampuan dan minat mereka.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                    <img src="assets/img/2.png" class="img-fluid w-100" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- FAQs End -->

    <!-- Blog Start -->
    <div class="container-fluid blog py-5" id="lowongan">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h4 class="text-primary">Pengumuman</h4>
                <h1 class="display-4 mb-4">Berita Terbaru</h1>
                <p class="mb-0">Halaman ini menyediakan informasi terkini mengenai pembukaan lowongan pekerjaan, jadwal seleksi, dan peluang karier bagi lulusan SMK.</p>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($loker as $data) <!-- Gunakan variabel data sebagai elemen tunggal -->
                <div class="col-lg-6 col-xl-4">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{ asset('storage/' . $data->gambar) }}" class="img-fluid rounded-top w-100" alt="Lowongan Kerja">
                            <div class="blog-categiry py-2 px-4">
                                <span>{{ $data->judul }}</span>
                            </div>
                        </div>
                        <div class="blog-content p-4">
                            <div class="blog-comment d-flex justify-content-between mb-3">
                                <div class="small"><span class="fa fa-calendar text-primary"></span> {{ $data->tanggal_mulai}}</div>
                                <div class="small"><span class="fa fa-user text-primary"></span> {{ $data->max_pelamar }} Pelamar</div>
                            </div>
                            <a href="#" class="h4 d-inline-block mb-3">{{ $data->judul }}</a>
                            <p class="mb-3">{!! strip_tags( $data->detail_s )!!}</p>
                            <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#lokerModal{{ $data->id }}">Selengkapnya <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="lokerModal{{ $data->id }}" tabindex="-1" aria-labelledby="lokerModalLabel{{ $data->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="lokerModalLabel{{ $data->id }}">{{ $data->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ asset('storage/' . $data->gambar) }}" class="img-fluid mb-3" alt="Lowongan Kerja" style="max-width: 100%; height: auto;">
                            </div>
                            <hr>
                            <div style="margin-left: 20px; text-align: left;">
                                <p>{!! strip_tags($data->detail) !!}</p>
                                <p><strong>Tanggal Mulai:</strong> {{ $data->tanggal_mulai}}</p>
                                <p><strong>Tanggal Selesai:</strong> {{ $data->tanggal_selesai}}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
    </div>
    <!-- Blog End -->

    <!-- Footer Start -->
    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Left Section -->
                <div class="col-lg-4">
                    <div class="d-flex mb-4">
                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                            <i class="fas fa-map-marker-alt fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Alamat</h4>
                            <p class="mb-0">Jl. Lap. Bola Rw. Butun, Ciketing Udik, Kec. Bantar Gebang, Kota Bks, Jawa Barat 17153</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                            <i class="fas fa-envelope fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="text-white">E-mail</h4>
                            <p class="mb-0">hubinsmkn2kotabekasi@gmail.com </p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="btn-xl-square bg-primary text-white rounded p-4 me-4">
                            <i class="fa fa-phone-alt fa-2x"></i>
                        </div>
                        <div>
                            <h4 class="text-white">Telepon</h4>
                            <p class="mb-0">(021) 8259 712</p>
                        </div>
                    </div>
                    <div class="footer-btn d-flex mt-4">
                        <a class="btn btn-md-square rounded-circle me-3" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-md-square rounded-circle me-3" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-md-square rounded-circle me-3" href="#"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-md-square rounded-circle me-3" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-md-square rounded-circle me-0" href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Middle Section -->
                <div class="col-lg-4">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">Useful Links</h4>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Beranda</a><br>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Tentang Kami</a><br>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Pertanyaan Umum</a><br>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Relasi Perusahaan</a><br>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Lowongan</a>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="col-lg-4">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">BKK SMKN 2 Kota Bekasi</h4>
                        <div class="position-relative rounded-pill">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.3016413244873!2d106.99193819999999!3d-6.354985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698c22161d4051%3A0x7a0a35b288779341!2sSMKN%202%20Kota%20Bekasi!5e0!3m2!1sid!2sid!4v1731469766306!5m2!1sid!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    </div>
    </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-end mb-md-0">
                    <span class="text-body"><a href="#" class="border-bottom text-white"><i class="fas fa-copyright text-light me-2"></i>BKK Team</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-start text-body">
                    Dibuatkan Oleh Bkk Team
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/counterup/counterup.min.js"></script>
    <script src="assets/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="assets/js/main.js"></script>
</body>

</html>