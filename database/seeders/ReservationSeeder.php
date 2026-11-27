<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $reservations = [
            [
                'guest_name' => 'Nadia Kusuma',
                'guest_phone' => '081223344556',
                'reservation_date' => now()->addDays(1)->toDateString(),
                'seating_time' => '19:30 WIB (Prime Dinner)',
                'guest_count' => 4,
                'notes' => 'Perayaan anniversary, meja dekat jendela jika memungkinkan.',
                'status' => 'Dikonfirmasi',
            ],
            [
                'guest_name' => 'Bima Santoso',
                'guest_phone' => '081398765432',
                'reservation_date' => now()->addDays(2)->toDateString(),
                'seating_time' => '12:00 WIB (Lunch Seating)',
                'guest_count' => 2,
                'notes' => 'Jamuan makan siang klien.',
                'status' => 'Pending',
            ],
            [
                'guest_name' => 'Clarissa Wijaya',
                'guest_phone' => '085611223344',
                'reservation_date' => now()->subDays(1)->toDateString(),
                'seating_time' => '17:30 WIB (Early Dinner)',
                'guest_count' => 3,
                'notes' => null,
                'status' => 'Selesai',
            ],
        ];

        foreach ($reservations as $res) {
            Reservation::firstOrCreate(
                [
                    'guest_name' => $res['guest_name'],
                    'reservation_date' => $res['reservation_date'],
                    'seating_time' => $res['seating_time'],
                ],
                $res
            );
        }
    }
}