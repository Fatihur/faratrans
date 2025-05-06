<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FaraTrans - Rental Mobil & Paket Wisata')</title>
    <meta name="description" content="@yield('meta_description', 'Rental mobil, paket wisata, dan layanan terbaik di Sumbawa')">
    <meta property="og:title" content="@yield('og_title', 'FaraTrans - Rental Mobil & Paket Wisata')">
    <meta property="og:description" content="@yield('og_description', 'Rental mobil, paket wisata, dan layanan terbaik di Sumbawa')">
    <meta property="og:image" content="@yield('og_image', asset('logo.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            DEFAULT: '#10B981',
                            dark: '#0B8457'
                        },
                        secondary: {
                            DEFAULT: '#1E40AF',
                            dark: '#1E3A8A'
                        },
                        dark: '#1F2937',
                        light: '#F9FAFB'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'float': 'float 6s ease-in-out infinite'
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' }
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased text-gray-800 bg-light">
    <!-- Navbar -->
    <nav class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="/" class="text-2xl font-bold text-primary flex items-center">
                    <span class="mr-1">Fara</span><span class="text-secondary">Trans</span>
                </a>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-600 hover:text-primary focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-1">
                    <a href="/" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-primary transition rounded-lg">Home</a>
                    <a href="/armada" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-primary transition rounded-lg">Armada</a>
                    <a href="/paket-wisata" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-primary transition rounded-lg">Paket Wisata</a>
                    <a href="/kontak" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-primary transition rounded-lg">Kontak</a>
                    <a href="/galeri" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-primary transition rounded-lg">Galeri</a>
                </div>

                <!-- CTA Button -->
                <div class="hidden md:block ml-4">
                    <a href="https://wa.me/6281234567890" class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-md hover:shadow-lg">
                        <i class="fab fa-whatsapp mr-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden pb-3">
                <div class="px-2 pt-2 space-y-1">
                    <a href="/" class="block px-3 py-2 rounded-lg text-base font-medium hover:bg-gray-100">Home</a>
                    <a href="/armada" class="block px-3 py-2 rounded-lg text-base font-medium hover:bg-gray-100">Armada</a>
                    <a href="/paket-wisata" class="block px-3 py-2 rounded-lg text-base font-medium hover:bg-gray-100">Paket Wisata</a>
                    <a href="/galeri" class="block px-3 py-2 rounded-lg text-base font-medium hover:bg-gray-100">Galeri</a>
                    <a href="/kontak" class="block px-3 py-2 rounded-lg text-base font-medium hover:bg-gray-100">Kontak</a>
                    <a href="https://wa.me/{{ $contact->phone }}" class="block px-3 py-2 rounded-lg text-base font-medium bg-primary text-white text-center">
                        <i class="fab fa-whatsapp mr-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="overflow-hidden">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4">FaraTrans</h3>
                    <p class="text-gray-400">Solusi transportasi dan wisata terbaik untuk perjalanan Anda dengan pelayanan profesional dan harga kompetitif.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-400 hover:text-white transition">Home</a></li>
                        <li><a href="/armada" class="text-gray-400 hover:text-white transition">Armada</a></li>
                        <li><a href="/paket-wisata" class="text-gray-400 hover:text-white transition">Paket Wisata</a></li>
                        <li><a href="/galeri" class="text-gray-400 hover:text-white transition">Galeri</a></li>
                        <li><a href="/kontak" class="text-gray-400 hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Kontak Kami</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-3"></i>
                            <span>{{ $contact->phone }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3"></i>
                            <span>{{ $contact->email }}</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3"></i>
                            <span>{{ $contact->address }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Media Sosial</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center hover:bg-primary transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center hover:bg-primary transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center hover:bg-primary transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center hover:bg-primary transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} FaraTrans. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out-quad',
            once: true,
            offset: 100
        });
    </script>
</body>
</html>