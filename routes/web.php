<?php

use Illuminate\Support\Facades\Route;
use App\Models\Car;
use App\Models\TourPackage;
use App\Models\Contact;
use App\Models\Faq;
use App\Models\Gallery;

Route::get('/', function () {
    $featuredCars = Car::where('is_featured', true)->get();
    $tourPackages = TourPackage::all();
    $contact = Contact::first();
    $faqs = Faq::where('is_active', true)->orderBy('order')->get();

    return view('welcome', compact('featuredCars', 'faqs', 'tourPackages', 'contact'));
});

Route::get('/armada', function (\Illuminate\Http\Request $request) {
    $query = Car::query();
    $contact = Contact::first();
    // Filter berdasarkan merek
    if ($request->has('brand') && $request->brand != '') {
        $query->where('brand', $request->brand);
    }

    // Filter berdasarkan tipe
    if ($request->has('type') && $request->type != '') {
        $query->where('category', $request->type);
    }

    // Filter berdasarkan kapasitas
    if ($request->has('capacity') && $request->capacity != '') {
        $query->where('passenger_capacity', $request->capacity);
    }

    // Ambil semua merek unik untuk dropdown filter
    $brands = Car::select('brand')->distinct()->orderBy('brand')->pluck('brand');

    $cars = $query->orderBy('brand')->paginate(9);

    return view('cars', compact('cars', 'brands', 'contact'));
});

Route::get('/paket-wisata', function () {
    $tourPackages = TourPackage::all();
    $contact = Contact::first();

    return view('tour-packages', compact('tourPackages', 'contact'));
});

Route::get('/kontak', function () {
    $contact = Contact::first();

    return view('contact', compact('contact'));
});

Route::get('/galeri', function () {
    $contact = Contact::first();

    $galleries = App\Models\Gallery::where('is_active', true)
                ->orderBy('order')
                ->get();
    return view('gallery', compact('galleries', 'contact'));
});