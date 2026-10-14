<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function scopeRule(Builder $query, $id)
    {
        return $query->where('id_user', Auth::id())->where('id_product', $id);
    }
}
