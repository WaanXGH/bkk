<style>
    /* Wrapper untuk navbar */
    .navbar-wrapper {
        background-color: #f1f3f4;
        /* Ganti sesuai dengan warna yang diinginkan */
        border-radius: 20px;
        margin: 1rem 3rem;
        /* Menyesuaikan margin agar lebih mepet */
        padding: 0.2rem 1rem;
        /* Padding yang cukup agar tampilan rapi */
    }

    .navbar {
        background: transparent !important;
        padding: 0;
        /* Hilangkan padding default */
    }

    .navbar-light .navbar-brand img {
        max-height: 80px;
        /* Sesuaikan ukuran logo */
        transition: 0.5s;
    }

    .navbar .navbar-nav {
        display: flex;
        align-items: center;
        justify-content: center;
        /* Posisi menu di tengah */
        gap: 15px;
        /* Jarak antar item menu lebih rapat */
    }

    .navbar .navbar-nav .nav-item {
        display: flex;
        align-items: center;
        margin: 2rem 1rem;
        /* Padding yang lebih kecil untuk menekan jarak */
        font-size: 20px;

    }

    .navbar .navbar-nav .nav-item .nav-link {
        display: inline-flex;
        align-items: center;
        font-weight: bold;
        color: var(--bs-dark);
        font-size: 1.1rem;
        /* Ukuran huruf diperbesar */
        transition: color 0.3s;
    }

    .navbar .navbar-nav .nav-item .nav-link:hover {
        color: var(--bs-primary);
    }

    .navbar .nav-btn {
        display: flex;
        align-items: center;
        margin-left: auto;
    }

    .navbar .nav-btn .btn {
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 1.1rem;
        /* Sesuaikan ukuran huruf tombol */
    }




    @media (min-width: 1100px) {
        .navbar-wrapper {
            margin: 1rem 19rem;
            padding: 0.5rem 1rem;
        }
    }

    @media (min-width: 2100px) {
        .navbar-wrapper {
            margin: 1rem 24rem;
            padding: 0.5rem 1rem;
        }
    }

    @media (max-width: 991px) {
        .navbar-wrapper {
            margin: 1rem 1.5rem;
            padding: 0.5rem 1rem;
        }

        .navbar-wrapper {
            background-color: #f1f3f4;
            /* Ganti sesuai dengan warna yang diinginkan */
            border-radius: 20px;
            margin: 1rem 3rem;
            /* Menyesuaikan margin agar lebih mepet */
            padding: 0.2rem 1rem;
            /* Padding yang cukup agar tampilan rapi */
        }

        .navbar {
            flex-wrap: wrap;
        }

        .navbar .navbar-nav {
            flex-direction: column;
            align-items: center;
            /* Posisikan menu di tengah secara vertikal */
            width: 100%;
            padding: 10px;
            border-radius: 10px;
        }

        .navbar .navbar-nav .nav-item {
            width: 100%;
            padding: 10px 0;
            justify-content: center;
        }

        .navbar .nav-btn {
            justify-content: center;
            margin-top: 10px;
        }

        .navbar .d-flex {
            flex-direction: column;
            align-items: center;
            gap: 10px;
            /* Tambahkan jarak antar tombol */
        }

        .navbar .btn {
            width: 100%;
            /* Tombol penuh di layar kecil */
            text-align: center;
        }

        .navbar .navbar-toggler {
            padding: 10px;
            border: 1px solid var(--bs-primary);
            color: var(--bs-primary);
        }

        .navbar .navbar-expand-lg .navbar-collapse {
            font-size: 13px !important;
        }

    }
</style>

<div class="navbar-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light">
        <!-- Brand / Logo -->
        <a href="{{ route('home') }}" class="navbar-brand p-0">
            <img src="{{ asset('assets/img/logo.jpeg') }}" alt="Logo" class="img-fluid" style="margin-right: 20px;">
        </a>

        <!-- Toggler untuk layar kecil -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>

        <!-- Menu Navbar -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-0 mx-lg-auto">
                <a href="{{ route('home') }}" class="nav-item nav-link">Beranda</a>
                <a href="{{ route('home') }}#tentang" class="nav-item nav-link">Tentang kami</a>
                <a href="{{ route('home') }}#relasi" class="nav-item nav-link">Relasi Perusahaan</a>
                <a href="{{ route('home') }}#lowongan" class="nav-item nav-link">Lowongan</a>
            </div>

            <!-- Tombol Login / Logout
            <div class="d-flex align-items-center ms-lg-auto">
                <!- auth -->

            <!-- <a href="#" class="btn btn-primary rounded-pill py-2 px-4 me-2 flex-shrink-0">
                    Halo, {{ explode(' ', Auth::user()->nama)[0] }}
                </a>
                <a href="{{ route('logout') }}" class="btn btn-danger rounded-pill py-2 px-4 flex-shrink-0"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout -->
            <!-- </a> -->
            <!-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                </form> -->
            <!-- else -->
            <!-- <a href="{{ route('login') }}" class="btn btn-primary rounded-pill py-2 px-4 flex-shrink-0">
                    Login
                </a> -->
            <!-- endauth -->
            <!-- </div>  -->


        </div>
    </nav>
</div>