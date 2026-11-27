<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Imperial Nasi Kuning Wagyu A5',
                'category' => 'Signature Platter',
                'price' => 285000,
                'description' => 'Nasi kuning santan pandan beraroma rempah pilihan dengan potongan Wagyu A5 seared, serundeng kelapa sangrai, dan sambal kecombrang.',
                'image' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Royal Golden Tumpeng For Two',
                'category' => 'Royal Tasting',
                'price' => 340000,
                'description' => 'Sajian tumpeng mini eksklusif dengan ayam kampung panggang madu, perkedel kentang truffle, dan telur balado.',
                'image' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Saffron Rempah Nasi Kuning & Bebek Crispy',
                'category' => 'Main Course',
                'price' => 165000,
                'description' => 'Perpaduan nasi kuning hangat dengan bebek renyah kulit emas, lalapan muda, dan sambal matah jeruk purut.',
                'image' => null,
                'is_available' => true,
            ],
            [
                'name' => 'Es Pandan Gula Aren & Emas Murni',
                'category' => 'Artisanal Drink',
                'price' => 68000,
                'description' => 'Minuman dingin menyegarkan dari ekstrak pandan asli, gula aren organik, dan sentuhan edible gold leaf.',
                'image' => null,
                'is_available' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::firstOrCreate(
                ['name' => $menu['name']],
                $menu
            );
        }
    }
}