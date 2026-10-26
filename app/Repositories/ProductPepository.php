<?php

namespace App\Repositories;
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
    public function findNotNull(int $id_product): Product
    {
        return Product::select('id', 'quantity')->where('quantity', '>', 0)->findOrFail($id_product);
    }
    public function findQuantity(int $id_product): Product
    {
       return Product::select('id', 'quantity')->findOrFail($id_product);
    }
}
