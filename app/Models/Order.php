<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_status',
        'total_price',
        'text_reason',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'created_at' => 'datetime',
    ];
}
