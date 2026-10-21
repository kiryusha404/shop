<?php

namespace App\Pepositories;
use App\Models\Product;
class ProductPepository implements ProductRepositoryInterface
{
    public function make(): Product
    {
        return new Product();
    }

    public function findOrFail($id): Product
    {
        return Product::findOrFail($id);
    }

    public function save(Product $product): Product
    {
        $product->save();
        return $product;
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
