<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
     public function run()
    {
         // Load helper
        helper('common');
        
        $data = [
            ['name' => 'Laptop', 'price' => 50000, 'stock' => 250, 'created_at' => current_timestamp()],
            ['name' => 'Mouse', 'price' => 600, 'stock' => 50, 'created_at' => current_timestamp()],
            ['name' => 'Keyboard', 'price' => 900, 'stock' => 50, 'created_at' => current_timestamp()],
            ['name' => 'RAM', 'price' => 1200, 'stock' => 50, 'created_at' => current_timestamp()],
            ['name' => 'SMPS', 'price' => 5000, 'stock' => 20, 'created_at' => current_timestamp()],
            ['name' => 'PEN DRIVE', 'price' => 399, 'stock' => 100, 'created_at' => current_timestamp()],
            ['name' => 'ROUTER', 'price' => 1599, 'stock' => 50, 'created_at' => current_timestamp()],
            ['name' => 'PRINTER', 'price' => 10200, 'stock' => 10, 'created_at' => current_timestamp()],
        ];

        foreach ($data as $product) {
            $this->db->table('products')->insert($product);
        }
    }
}
