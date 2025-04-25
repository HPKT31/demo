<?php

namespace App\Models;

use CodeIgniter\Model;

class Orders extends Model
{
    protected $table      = 'orders';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'payment_type', 'payment_status', 'message', 'phone', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
}
