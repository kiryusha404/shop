<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'img',
        'price',
        'country',
        'year',
        'model',
        'quantity',
        'id_category',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'year' => 'integer',
        'quantity' => 'integer',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'id_category');
    }
}
