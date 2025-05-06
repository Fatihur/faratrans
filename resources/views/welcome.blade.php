@extends('layouts.app')

@section('title', 'FaraTrans - Rental Mobil & Paket Wisata Sumbawa')
@section('meta_description', 'Rental mobil, paket wisata, dan layanan terbaik di Sumbawa. Armada terawat, harga kompetitif, driver profesional, dan layanan 24 jam.')
@section('og_title', 'FaraTrans - Rental Mobil & Paket Wisata Sumbawa')
@section('og_description', 'Rental mobil, paket wisata, dan layanan terbaik di Sumbawa. Armada terawat, harga kompetitif, driver profesional, dan layanan 24 jam.')
@section('og_image', asset('logo.png'))

@section('content')
<!-- AOS Initialization -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    });
</script>

<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-primary to-secondary text-white py-20 md:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="container mx-auto px-4 relative">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0" data-aos="fade-right">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Rental Mobil & Paket Wisata Terbaik</h1>
                <p class="text-xl mb-8 opacity-90">Nikmati perjalanan nyaman dengan armada terbaik dan harga terjangkau.</p>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                    <a href="/armada" 
                       class="bg-white hover:bg-gray-100 text-primary font-bold py-3 px-6 rounded-lg transition duration-300 text-center transform hover:scale-105"
                       data-aos="fade-up" data-aos-delay="200">
                        Lihat Armada
                    </a>
                    <a href="https://wa.me/{{ $contact->phone }}" 
                       class="border-2 border-white hover:bg-white hover:text-primary font-bold py-3 px-6 rounded-lg transition duration-300 text-center transform hover:scale-105"
                       data-aos="fade-up" data-aos-delay="300">
                        <i class="fab fa-whatsapp mr-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
            <div class="md:w-1/2" data-aos="fade-left" data-aos-delay="200">
                <img src="{{asset('mobil.png')}}"
                    alt="Hero Image"
                    class="rounded-lg w-full h-auto object-cover transform transition duration-500 hover:scale-105">
            </div>
        </div>
    </div>
</section>

<!-- About Us -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-4">Tentang Kami</h2>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
        </div>

        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-8 md:mb-0 flex items-center justify-center" data-aos="fade-right">
                <img src="{{ asset('logo.png') }}"
                    alt="About Us"
                    class="max-w-sm w-full h-auto object-cover mx-auto bg-transparent hover:rotate-2 transition duration-500">
            </div>
            <div class="md:w-1/2 md:pl-12" data-aos="fade-left" data-aos-delay="200">
                <h3 class="text-2xl font-semibold mb-4">Fara Trans - Agen Tour and Travel</h3>
                <p class="text-gray-700 mb-4">Kami adalah perusahaan rental mobil dan agen tour and travel yang berkomitmen untuk memberikan pelayanan terbaik kepada pelanggan.</p>
                <p class="text-gray-700 mb-6">Dengan pengalaman bertahun-tahun di industri ini, kami memahami kebutuhan Anda dan siap memberikan solusi terbaik untuk perjalanan Anda.</p>
                <ul class="space-y-3">
                    <li class="flex items-start" data-aos="fade-up" data-aos-delay="300">
                        <i class="fas fa-check text-primary mr-3 mt-1"></i>
                        <span>Armada terawat dan nyaman</span>
                    </li>
                    <li class="flex items-start" data-aos="fade-up" data-aos-delay="350">
                        <i class="fas fa-check text-primary mr-3 mt-1"></i>
                        <span>Harga kompetitif</span>
                    </li>
                    <li class="flex items-start" data-aos="fade-up" data-aos-delay="400">
                        <i class="fas fa-check text-primary mr-3 mt-1"></i>
                        <span>Driver profesional</span>
                    </li>
                    <li class="flex items-start" data-aos="fade-up" data-aos-delay="450">
                        <i class="fas fa-check text-primary mr-3 mt-1"></i>
                        <span>Layanan 24/7</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Our Services -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-4">Layanan Kami</h2>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Kami menyediakan berbagai layanan berkualitas untuk memenuhi kebutuhan perjalanan Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition duration-300 text-center transform hover:-translate-y-2"
                 data-aos="fade-up" data-aos-delay="100">
                <div class="text-primary text-5xl mb-6">
                    <i class="fas fa-car"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Rental Mobil Lepas Kunci</h3>
                <p class="text-gray-700">Sewa mobil tanpa driver untuk kebutuhan pribadi atau bisnis Anda dengan harga terjangkau.</p>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition duration-300 text-center transform hover:-translate-y-2"
                 data-aos="fade-up" data-aos-delay="200">
                <div class="text-primary text-5xl mb-6">
                    <i class="fas fa-car-side"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Rental Mobil + Driver</h3>
                <p class="text-gray-700">Nikmati perjalanan dengan driver profesional yang sudah berpengalaman dan ramah.</p>
            </div>

            <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-lg transition duration-300 text-center transform hover:-translate-y-2"
                 data-aos="fade-up" data-aos-delay="300">
                <div class="text-primary text-5xl mb-6">
                    <i class="fas fa-umbrella-beach"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Paket Wisata</h3>
                <p class="text-gray-700">Paket wisata lengkap dengan transportasi, akomodasi, dan itinerary yang menarik.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Cars -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-4">Pilihan Mobil</h2>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Armada terbaik kami siap menemani perjalanan Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredCars as $index => $car)
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition duration-300 transform hover:-translate-y-2"
                 data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('storage/' . $car->image) }}"
                        alt="{{ $car->brand }} {{ $car->type }}"
                        class="w-full h-full object-cover transition duration-500 hover:scale-110">
                    @if($car->is_available)
                    <span class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded text-xs">
                        Tersedia
                    </span>
                    @else
                    <span class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded text-xs">
                        Tidak Tersedia
                    </span>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $car->brand }} {{ $car->type }}</h3>
                    <div class="flex items-center text-gray-600 mb-4 gap-2 flex-wrap">
                        <span class="flex items-center text-sm"><i class="fas fa-cog mr-1"></i> {{ $car->category }}</span>
                        <span class="flex items-center text-sm"><i class="fas fa-users mr-1"></i> {{ $car->passenger_capacity }} Seat</span>
                        <span class="flex items-center text-sm"><i class="fas fa-gas-pump mr-1"></i> {{ $car->fuel_type }}</span>
                    </div>
                    <div class="mb-3">
                        <span class="font-semibold">Lepas Kunci:</span>
                        <span class="text-primary">Rp {{ number_format($car->self_drive_price, 0, ',', '.') }}/hari</span>
                    </div>
                    <div class="mb-4">
                        <span class="font-semibold">Dengan Driver:</span>
                        <span class="text-primary">Rp {{ number_format($car->with_driver_price, 0, ',', '.') }}/hari</span>
                    </div>
                    
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="/armada" class="inline-block bg-secondary hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-lg transition duration-300 transform hover:scale-105">
                Lihat Semua Armada
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-4">Mengapa Memilih Kami?</h2>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Keunggulan yang membuat kami berbeda dari yang lain</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-2"
                 data-aos="fade-up" data-aos-delay="100">
                <div class="bg-primary bg-opacity-10 text-primary w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4 transition duration-300 transform hover:scale-110">
                    <i class="fas fa-thumbs-up text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Terpercaya</h3>
                <p class="text-gray-700">Sudah melayani banyak pelanggan dengan reputasi yang baik dan banyak testimoni positif.</p>
            </div>

            <div class="text-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-2"
                 data-aos="fade-up" data-aos-delay="200">
                <div class="bg-primary bg-opacity-10 text-primary w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4 transition duration-300 transform hover:scale-110">
                    <i class="fas fa-car text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Armada Terawat</h3>
                <p class="text-gray-700">Mobil selalu dalam kondisi prima, bersih, dan nyaman untuk perjalanan Anda.</p>
            </div>

            <div class="text-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-2"
                 data-aos="fade-up" data-aos-delay="300">
                <div class="bg-primary bg-opacity-10 text-primary w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4 transition duration-300 transform hover:scale-110">
                    <i class="fas fa-money-bill-wave text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Harga Kompetitif</h3>
                <p class="text-gray-700">Harga terjangkau dengan kualitas pelayanan terbaik dan transparan tanpa biaya tersembunyi.</p>
            </div>

            <div class="text-center p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-2"
                 data-aos="fade-up" data-aos-delay="400">
                <div class="bg-primary bg-opacity-10 text-primary w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4 transition duration-300 transform hover:scale-110">
                    <i class="fas fa-headset text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-2">Layanan 24/7</h3>
                <p class="text-gray-700">Siap melayani Anda kapan saja dengan respon cepat dan solusi terbaik untuk kebutuhan Anda.</p>
            </div>
        </div>
    </div>
</section>



<!-- FAQ Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-4">Pertanyaan Umum</h2>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Temukan jawaban atas pertanyaan yang sering diajukan</p>
        </div>
        
        <div class="max-w-3xl mx-auto" x-data="{ activeFaq: null }">
            <div class="space-y-4">
                @foreach($faqs as $index => $faq)
                <div class="border border-gray-200 rounded-lg overflow-hidden transition-all duration-300"
                     data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                    <button 
                        @click="activeFaq === {{ $index }} ? activeFaq = null : activeFaq = {{ $index }}"
                        class="w-full flex justify-between items-center p-4 bg-white hover:bg-gray-50 transition-all"
                        :class="{ 'bg-gray-50': activeFaq === {{ $index }} }"
                    >
                        <h3 class="text-lg font-semibold text-left">{{ $faq->question }}</h3>
                        <svg 
                            class="w-5 h-5 transform transition-transform duration-300" 
                            :class="{ 'rotate-180': activeFaq === {{ $index }} }"
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div 
                        x-show="activeFaq === {{ $index }}"
                        x-collapse
                        class="px-4 pb-4 bg-white transition-all duration-300"
                    >
                        <div class="text-gray-700">
                            {!! nl2br(e($faq->answer)) !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary text-white">
    <div class="container mx-auto px-4 text-center">
        <div data-aos="fade-up">
            <h2 class="text-3xl font-bold mb-6">Siap Memesan?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Hubungi kami sekarang untuk informasi lebih lanjut atau langsung melakukan pemesanan. Tim kami siap membantu Anda 24 jam.</p>
        </div>
        <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
            <a href="https://wa.me/{{ $contact->phone }}"
                class="bg-white text-primary hover:bg-gray-100 font-bold py-3 px-8 rounded-lg text-lg transition duration-300 inline-block transform hover:scale-105"
                data-aos="fade-up" data-aos-delay="100">
                <i class="fab fa-whatsapp mr-2"></i> Hubungi via WhatsApp
            </a>
            <a href="tel:{{ $contact->phone }}"
                class="border-2 border-white hover:bg-white hover:text-primary font-bold py-3 px-8 rounded-lg text-lg transition duration-300 inline-block transform hover:scale-105"
                data-aos="fade-up" data-aos-delay="200">
                <i class="fas fa-phone mr-2"></i> Telepon Kami
            </a>
        </div>
    </div>
</section>

<!-- Include AOS CSS & JS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endsection