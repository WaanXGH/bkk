<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login & Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #9face6);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-tabs {
            border-bottom: none;
        }

        .nav-link {
            color: #6c757d;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
        }

        .nav-link.active {
            background-color: #007bff;
            color: white;
        }

        button {
            border-radius: 50px;
        }

        .form-control {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="card p-4" style="max-width: 450px; width: 100%;">
        <div class="text-center mb-4">
            <img src="assets/img/logo.jpeg" alt="Logo" class="img-fluid mb-3 rounded-circle" style="width: 150px; height: 130px;">
            <h4 class="fw-bold">Selamat Datang</h4>
            <p class="text-muted">Silahkan Login Untuk Melanjutkan Sesi Ini</p>
        </div>
        <!-- Tabs Navigation -->
        <ul class="nav nav-pills nav-justified mb-3" id="authTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Masuk</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">Daftar</button>
            </li>
        </ul>
        <!-- Tabs Content -->
        <div class="tab-content" id="authTabContent">
            <!-- Login Form -->
            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                <form action="{{ route('login-proses') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Alamat E-Mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukkan Alamat Email">
                        @error('email')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan kata sandi">
                        @error('password')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

            </div>
            <!-- Register Form -->
            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                <form action="{{route ('register-proses')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="registerName" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan Nama Lengkap Anda" value="{{old('nama_lengkap')}}">
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Alamat E-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukkan Email Anda" value="{{old('email')}}">
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Buat Kata sandi">
                        @error('password')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="registerConfirmPassword" class="form-label">Ulangi kata Sandi</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Ulangi kata sandi">
                        @error('password')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success w-100" id="registerButton">Register</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if($message = Session::get('failed'))
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "{{$message}}",
        })
    </script>
    @endif

    @if($message = Session::get('success'))
    <script>
        Swal.fire("{{$message}}!");
    </script>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil tab terakhir yang aktif dari session storage
            let activeTab = sessionStorage.getItem("activeTab");
            if (activeTab) {
                let tabElement = document.querySelector(`button[data-bs-target="${activeTab}"]`);
                if (tabElement) {
                    new bootstrap.Tab(tabElement).show();
                }
            }

            //confirm password
            document.getElementById("registerButton").addEventListener("click", function(event) {
                let password = document.getElementById("password").value;
                let confirmPassword = document.getElementById("confirm_password").value;

                if (password !== confirmPassword) {
                    event.preventDefault(); // Mencegah form dikirim jika password tidak sama
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Password dan Konfirmasi Password tidak cocok!",
                    });
                }
                if (password === confirmPassword) {
                    Swal.fire({
                        title: "Good job!",
                        text: "Registrasi Berhasil",
                        icon: "success"
                    });

                }
            });

            // Simpan tab yang aktif saat pengguna berpindah tab
            document.querySelectorAll('.nav-link').forEach(function(tab) {
                tab.addEventListener("click", function(event) {
                    sessionStorage.setItem("activeTab", event.target.dataset.bsTarget);
                });
            });
        });
    </script>


</body>

</html>