<?php

namespace App\Pepositories;
use Illuminate\Http\Request;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function make(): Product;
    public function findOrFail($id): Product;
    public function save(Product $product): Product;
    public function delete(Product $product): bool;
}
