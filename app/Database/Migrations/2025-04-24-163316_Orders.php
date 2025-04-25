<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'payment_type'    => ['type' => 'VARCHAR', 'constraint' => '50'],
            'customer_info'   => ['type' => 'VARCHAR', 'constraint' => '255', 'null' => true],
            'payment_status'  => ['type' => 'TINYINT', 'default' => 0],
            'phone'         => ['type' => 'VARCHAR', 'constraint' => 15, 'null' => true],
            'message'         => ['type' => 'TEXT', 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('orders');
    }
    
    public function down()
    {
        $this->forge->dropTable('orders');
    }
    
}
