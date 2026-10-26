<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function make(): Product;
    public function findOrFail($id): Product;
    public function save(Product $product): Product;
    public function delete(Product $product): bool;
    public function findNotNull(int $id_product): Product;
    public function findQuantity(int $id_product): Product;
}
