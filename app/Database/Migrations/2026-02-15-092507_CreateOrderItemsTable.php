<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true],
            'order_id' => ['type' => 'INT', 'constraint' => 11],
            'product_id' => ['type' => 'INT', 'constraint' => 11],
            'qty' => ['type' => 'INT', 'constraint' => 11, 'default' => 1],
            'price' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'subtotal' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'payment_status' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'dell_status' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('order_items');
    }

    public function down()
    {
        //
    }
}
