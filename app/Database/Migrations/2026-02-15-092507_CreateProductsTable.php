<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'name'  => ['type' => 'VARCHAR', 'constraint' => 255],
            'price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'stock' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'created_at' => ['type' => 'INT', 'null' => true],
            'updated_at' => ['type' => 'INT', 'null' => true],
            'dell_status' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('products');
    }

    public function down()
    {
        //
    }
}
