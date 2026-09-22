<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $primaryKey = null;

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'id_product',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'integer',
    ];

}
