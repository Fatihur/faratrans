@extends('layouts.app')

@section('title', 'Galeri | FaraTrans')
@section('meta_description', 'Kumpulan foto dan momen terbaik dari FaraTrans, rental mobil dan paket wisata Sumbawa.')
@section('og_title', 'Galeri FaraTrans')
@section('og_description', 'Kumpulan foto dan momen terbaik dari FaraTrans, rental mobil dan paket wisata Sumbawa.')
@section('og_image', asset('logo.png'))

@section('content')
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h1 class="text-3xl font-bold mb-4">Galeri Kami</h1>
            <div class="w-20 h-1 bg-primary mx-auto"></div>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Kumpulan momen terbaik dari layanan dan perjalanan kami</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($galleries as $gallery)
            <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition duration-300">
                <img src="{{ asset('storage/' . $gallery->image) }}" 
                     alt="{{ $gallery->caption ?? 'Galeri FaraTrans' }}"
                     class="w-full h-64 object-cover transition duration-300 group-hover:scale-105">
                
                @if($gallery->caption)
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-4 opacity-0 group-hover:opacity-100 transition duration-300">
                    <p class="text-white">{{ $gallery->caption }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection