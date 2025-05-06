@extends('layouts.app')

@section('title', 'Armada Mobil | FaraTrans')
@section('meta_description', 'Daftar armada mobil FaraTrans. Pilihan mobil terbaik, terawat, dan siap menemani perjalanan Anda di Sumbawa.')
@section('og_title', 'Armada Mobil FaraTrans')
@section('og_description', 'Daftar armada mobil FaraTrans. Pilihan mobil terbaik, terawat, dan siap menemani perjalanan Anda di Sumbawa.')
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
<section class="relative bg-gradient-to-r from-primary to-secondary text-white py-20">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Armada Kami</h1>
        <p class="text-xl max-w-2xl mx-auto">Pilih mobil terbaik untuk kebutuhan perjalanan Anda</p>
    </div>
</section>

<!-- Filter Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="bg-white p-6 rounded-lg shadow-md" data-aos="fade-up">
            <h2 class="text-xl font-semibold mb-4">Filter Armada</h2>
            <form action="{{ url('/armada') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Merek</label>
                    <select name="brand" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">Semua Merek</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Mobil</label>
                    <select name="type" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">Semua Tipe</option>
                        <option value="sedan" {{ request('type') == 'sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="suv" {{ request('type') == 'suv' ? 'selected' : '' }}>SUV</option>
                        <option value="mpv" {{ request('type') == 'mpv' ? 'selected' : '' }}>MPV</option>
                        <option value="hatchback" {{ request('type') == 'hatchback' ? 'selected' : '' }}>Hatchback</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                    <select name="capacity" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary">
                        <option value="">Semua</option>
                        <option value="4" {{ request('capacity') == '4' ? 'selected' : '' }}>4 Penumpang</option>
                        <option value="6" {{ request('capacity') == '6' ? 'selected' : '' }}>6 Penumpang</option>
                        <option value="8" {{ request('capacity') == '8' ? 'selected' : '' }}>8 Penumpang</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="w-full bg-primary hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md transition transform hover:scale-105">
                        Cari Mobil
                    </button>
                    @if(request()->has('brand') || request()->has('type') || request()->has('capacity'))
                    <a href="{{ url('/armada') }}" class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md transition transform hover:scale-105">
                        Reset
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Cars Listing -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        @if($cars->isEmpty())
        <div class="text-center py-12" data-aos="fade-up">
            <div class="text-gray-500 text-5xl mb-4">
                <i class="fas fa-car"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">Tidak ada mobil yang ditemukan</h3>
            <p class="text-gray-600 mb-4">Coba gunakan filter yang berbeda atau <a href="{{ url('/armada') }}" class="text-primary hover:underline">reset filter</a></p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($cars as $index => $car)
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition duration-300 transform hover:-translate-y-2"
                 data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                <div class="relative h-56 overflow-hidden">
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
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                            <i class="fas fa-car mr-1"></i> {{ ucfirst($car->category) }}
                        </span>
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                            <i class="fas fa-users mr-1"></i> {{ $car->passenger_capacity }} Orang
                        </span>
                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">
                            <i class="fas fa-gas-pump mr-1"></i> {{ $car->fuel_type }}
                        </span>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Harga Sewa:</h4>
                        <div class="flex justify-between mb-2">
                            <span>Lepas Kunci:</span>
                            <span class="font-semibold text-primary">Rp {{ number_format($car->self_drive_price, 0, ',', '.') }}/hari</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Dengan Driver:</span>
                            <span class="font-semibold text-primary">Rp {{ number_format($car->with_driver_price, 0, ',', '.') }}/hari</span>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Spesifikasi:</h4>
                        <ul class="text-sm text-gray-700 space-y-1 max-h-20 overflow-y-auto">
                            @foreach(explode("\n", $car->specifications) as $spec)
                                @if(trim($spec))
                                <li class="flex items-start">
                                    <i class="fas fa-check text-primary mr-2 mt-1 text-xs"></i>
                                    <span>{{ trim($spec) }}</span>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    
                    <a href="https://wa.me/{{$contact->phone}}?text=Saya%20tertarik%20dengan%20mobil%20{{ $car->brand }}%20{{ $car->type }}%20(%20{{ $car->category }}%20)"
                       class="block w-full bg-primary hover:bg-green-600 text-white text-center font-bold py-2 px-4 rounded transition duration-300 transform hover:scale-105 {{ !$car->is_available ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}"
                       @if(!$car->is_available) disabled aria-disabled="true" tabindex="-1" @endif>
                        <i class="fab fa-whatsapp mr-2"></i> Pesan Sekarang
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($cars->hasPages())
        <div class="mt-12" data-aos="fade-up">
            {{ $cars->appends(request()->query())->links() }}
        </div>
        @endif
        @endif
    </div>
</section>

<!-- Include AOS CSS & JS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endsection