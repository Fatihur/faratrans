<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BookingStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Hitung rata-rata durasi menggunakan DATEDIFF MySQL
        $averageDuration = Booking::query()
            ->selectRaw('AVG(DATEDIFF(end_date, start_date)) as avg_duration')
            ->first()
            ->avg_duration;

        return [
            Stat::make('Total Booking', Booking::count())
                ->description('Total semua booking')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
                
            Stat::make('Booking Aktif', Booking::where('returned', false)->count())
                ->description('Mobil belum dikembalikan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
                
            Stat::make('Pendapatan Bulan Ini', 
                'Rp ' . number_format(Booking::whereBetween('start_date', [
                    now()->startOfMonth(),
                    now()->endOfMonth()
                ])->sum('total_price'), 0, ',', '.'))
                ->description('Total pendapatan')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
                
            Stat::make('Rata-rata Durasi', 
                round($averageDuration, 1) . ' hari')
                ->description('Rata-rata lama sewa')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
        ];
    }
}