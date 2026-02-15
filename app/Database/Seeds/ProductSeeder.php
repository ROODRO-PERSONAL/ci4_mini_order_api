<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
     public function run()
    {
        $data = [
            ['name' => 'RAM', 'price' => 1200, 'stock' => 50],
            ['name' => 'SMPS', 'price' => 5000, 'stock' => 20],
            ['name' => 'PEN DRIVE', 'price' => 399, 'stock' => 100],
            ['name' => 'ROUTER', 'price' => 1599, 'stock' => 50],
            ['name' => 'PRINTER', 'price' => 10200, 'stock' => 10],
        ];

        foreach ($data as $product) {
            $this->db->table('products')->insert($product);
        }
    }
}
