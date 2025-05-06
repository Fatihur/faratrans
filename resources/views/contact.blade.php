@extends('layouts.app')

@section('title', 'Kontak | FaraTrans')
@section('meta_description', 'Hubungi FaraTrans untuk rental mobil, paket wisata, dan informasi layanan terbaik di Sumbawa. Tersedia kontak telepon, email, alamat, dan peta lokasi.')
@section('og_title', 'Kontak FaraTrans')
@section('og_description', 'Hubungi FaraTrans untuk rental mobil, paket wisata, dan informasi layanan terbaik di Sumbawa. Tersedia kontak telepon, email, alamat, dan peta lokasi.')
@section('og_image', asset('logo.png'))

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-primary to-secondary text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Hubungi Kami</h1>
            <p class="text-xl max-w-2xl mx-auto">Tim kami siap membantu Anda 24 jam</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Contact Info -->
                <div class="md:w-1/3">
                    <div class="bg-gray-50 p-8 rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold mb-6">Informasi Kontak</h2>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold">Telepon/WhatsApp</h3>
                                    <p class="text-gray-700">{{ $contact->phone }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold">Email</h3>
                                    <p class="text-gray-700">{{ $contact->email }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold">Alamat Kantor</h3>
                                    <p class="text-gray-700">{{ $contact->address }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-full mr-4">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold">Jam Operasional</h3>
                                    <p class="text-gray-700">Senin - Minggu: 24 Jam</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8">
                            <h3 class="font-semibold mb-4">Media Sosial</h3>
                            <div class="flex space-x-4">
                                <a href="{{ $contact->facebook }}" class="w-10 h-10 rounded-full bg-gray-200 hover:bg-primary hover:text-white flex items-center justify-center transition">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{{ $contact->instagram }}" class="w-10 h-10 rounded-full bg-gray-200 hover:bg-primary hover:text-white flex items-center justify-center transition">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="{{ $contact->twitter }}" class="w-10 h-10 rounded-full bg-gray-200 hover:bg-primary hover:text-white flex items-center justify-center transition">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" class="w-10 h-10 rounded-full bg-gray-200 hover:bg-primary hover:text-white flex items-center justify-center transition">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Map Section -->
                <div class="md:w-2/3">
                    <div class="bg-white p-4 rounded-lg shadow-md border border-gray-200 h-full">
                        <div style="width:100%; height:100vh;">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3946.1500927501106!2d117.41128697441683!3d-8.484783391556434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcbecd402a2ef7b%3A0x3ecef0d4f95e7941!2sFarra%20Rent%20car!5e0!3m2!1sid!2sid!4v1746411220772!5m2!1sid!2sid" style="border:0; width:100%; height:100vh;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection