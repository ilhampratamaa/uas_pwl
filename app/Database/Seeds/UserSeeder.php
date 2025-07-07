<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'     => 'admin'
            ],
            [
                'username' => 'budi',
                'email'    => 'budi@gmail.com',
                'password' => password_hash('budi123', PASSWORD_DEFAULT),
                'role'     => 'buyer'
            ]
        ];

        // Simple insert multiple rows
        $this->db->table('users')->insertBatch($data);
    }
}
