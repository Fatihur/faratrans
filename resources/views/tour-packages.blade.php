@extends('layouts.app')

@section('title', 'Paket Wisata | FaraTrans')
@section('meta_description', 'Paket wisata terbaik di Sumbawa dari FaraTrans. Pilihan destinasi menarik, harga terjangkau, dan layanan profesional.')
@section('og_title', 'Paket Wisata FaraTrans')
@section('og_description', 'Paket wisata terbaik di Sumbawa dari FaraTrans. Pilihan destinasi menarik, harga terjangkau, dan layanan profesional.')
@section('og_image', asset('logo.png'))

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-secondary to-primary text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Paket Wisata</h1>
            <p class="text-xl max-w-2xl mx-auto">Temukan pengalaman liburan tak terlupakan dengan paket wisata kami</p>
        </div>
    </section>

    <!-- Packages Listing -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($tourPackages as $package)
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition duration-300">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $package->image) }}" 
                             alt="{{ $package->title }}" 
                             class="w-full h-48 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                            <h3 class="text-xl font-semibold text-white">{{ $package->title }}</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-primary font-bold text-lg">Rp {{ number_format($package->price, 0, ',', '.') }}/orang</span>
                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">Min. 4 Orang</span>
                        </div>
                        
                        <p class="text-gray-700 mb-4">{{ Str::limit($package->description, 150) }}</p>
                        
                        <div class="mb-4">
                            <h4 class="font-semibold mb-2">Fasilitas:</h4>
                            <ul class="text-sm text-gray-700 space-y-1">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-primary mr-2 mt-1 text-xs"></i>
                                    <span>Transportasi mobil AC</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-primary mr-2 mt-1 text-xs"></i>
                                    <span>Penginapan 2 malam</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-primary mr-2 mt-1 text-xs"></i>
                                    <span>Makan 6x selama trip</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-primary mr-2 mt-1 text-xs"></i>
                                    <span>Tour guide berpengalaman</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="flex space-x-2">
                            <a href="/paket-wisata/{{ $package->id }}" 
                               class="flex-1 text-center border border-primary text-primary hover:bg-primary hover:text-white font-bold py-2 px-4 rounded transition">
                                Detail
                            </a>
                            <a href="https://wa.me/6281234567890?text=Saya%20tertarik%20dengan%20paket%20{{ $package->title }}" 
                               class="flex-1 text-center bg-primary hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Butuh Paket Khusus?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Kami juga menerima permintaan paket wisata custom sesuai kebutuhan Anda</p>
            <a href="https://wa.me/{{$contact->phone}}" 
               class="inline-block bg-primary hover:bg-green-600 text-white font-bold py-3 px-8 rounded-lg text-lg transition">
                <i class="fab fa-whatsapp mr-2"></i> Konsultasi Paket Wisata
            </a>
        </div>
    </section>
@endsection