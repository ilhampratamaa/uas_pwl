<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name'        => 'Akun PUBG Mobile Gold',
                'price'       => 150000,
                'photo'       => 'pubg.jpeg',
                'stock'       => 5,
                'description' => 'Akun PUBG dengan skin lengkap.'
            ],
            [
                'name'        => 'Akun Mobile Legends Epic',
                'price'       => 200000,
                'photo'       => 'mole.jpg',
                'stock'       => 3,
                'description' => 'Akun ML rank Mythic full hero.'
            ]
        ];

        $this->db->table('products')->insertBatch($products);
    }
}
