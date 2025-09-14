<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Sistem Sekolah Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100 p-4">
    <div class="flex flex-col md:flex-row w-full max-w-5xl rounded-3xl overflow-hidden shadow-2xl bg-white" data-aos="fade-up" data-aos-duration="800">
        <div class="w-full md:w-1/2 p-8 lg:p-12 flex flex-col justify-center items-center text-center bg-blue-500 text-white relative">
            <div class="absolute inset-0 bg-blue-500 opacity-90"></div>
            <div class="relative z-10 w-full" data-aos="fade-right" data-aos-delay="200">
                <div class="mb-6">
                    <div class="w-20 h-20 mx-auto rounded-full bg-white p-2 flex items-center justify-center shadow-lg transform transition-transform duration-300 hover:scale-105">
                        <i class="fas fa-graduation-cap text-4xl text-blue-500"></i>
                    </div>
                </div>
                <h1 class="text-3xl lg:text-4xl font-bold mb-4">Sistem Sekolah Digital</h1>
                <p class="text-blue-100 mb-8 max-w-sm mx-auto">
                    Platform Terpadu untuk Pembelajaran Abad 21. Kelola kegiatan belajar mengajar dengan lebih mudah dan efisien.
                </p>

            </div>
        </div>

        <div class="w-full md:w-1/2 bg-white p-8 lg:p-12 flex flex-col justify-center relative">
            <div class="relative z-10">
                <div class="mb-8 text-center" data-aos="fade-left" data-aos-delay="200">
                    <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 mb-2">Selamat Datang Kembali</h2>
                    <p class="text-gray-600">Silakan masuk untuk mengakses sistem</p>
                </div>
                {{-- @if ($errors->any())
                    <div id="notification-popup" class="fixed inset-0 flex items-center justify-center z-50 p-4">
                        <div class="bg-white rounded-lg shadow-xl p-6 md:p-8 max-w-sm w-full mx-auto transform transition-all duration-300 scale-95 opacity-0" id="popup-content">
                            <div class="flex flex-col items-center justify-center text-center">
                                <div class="w-16 h-16 flex items-center justify-center rounded-full bg-red-100 text-red-500 mb-4">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Login Gagal!</h3>
                                <p class="text-sm text-gray-600 mb-4">{{ $errors->first() }}</p>
                                <button id="close-popup" class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                @endif --}}
                <form class="space-y-6" data-aos="fade-up" method="post" action="{{ route('login.process') }}" data-aos-delay="300">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username / Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-user"></i>
                            </div>
                            <input type="text" id="username" name="username"
                                   class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 py-3 px-4 border transition-all duration-200"
                                   placeholder="Masukkan username atau Email">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <i class="fas fa-lock"></i>
                            </div>
                            <input type="password" id="password" name="password"
                                   class="pl-10 block w-full rounded-xl border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 py-3 px-4 border transition-all duration-200"
                                   placeholder="Masukkan password">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <i class="fas fa-eye-slash text-gray-400 cursor-pointer transition-colors duration-200 hover:text-blue-500" id="togglePassword"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between" data-aos="fade-up" data-aos-delay="400">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="font-medium text-blue-600 hover:text-blue-500 transition-all">Lupa password?</a>
                        </div>
                    </div>

                    <div data-aos="fade-up" data-aos-delay="500">
                        <button type="submit" class="w-full flex justify-center items-center bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-4 rounded-xl shadow-md transition-all duration-300">
                            <span>Login </span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: @json($errors->first()),
                    confirmButtonColor: '#3085d6',
                });
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-out-quad',
                once: true,
                offset: 50
            });

            // Toggle password visibility
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.classList.toggle('fa-eye-slash');
                    this.classList.toggle('fa-eye');
                });
            }
        });
    </script>
</body>
</html>
