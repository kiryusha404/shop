<?php

namespace App\Services;

use App\Http\Requests\CreateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminServices
{
    public function newProduct()
    {
        $this->products = new Product();
        return $this;
    }

    public function findProduct($id)
    {
        $this->products = Product::findOrFail($id);
        return $this;
    }

    public function createImg(Request $request)
    {
        if($request->hasFile('img')){
            $file = $request->file('img');

            $name_img = time() . '_' . uniqid() . $file->getClientOriginalName();

            $file->move(public_path('assets/img') ,  $name_img);
            $this->products->img = $name_img;
        }
        return $this;
    }

    public function deleteImg()
    {
        $img_path = public_path('assets/img/' . $this->products->img);
        if (File::exists($img_path)) {
            File::delete($img_path);
        }
        return $this;
    }

    public function createOrUpdate(Request $request)
    {
        $this->products->name = $request->input('name');
        $this->products->price = $request->input('price');
        $this->products->country = $request->input('country');
        $this->products->year = $request->input('year');
        $this->products->model = $request->input('model');
        if(!empty($request->input('quantity'))) {
            $this->products->quantity = $request->input('quantity');
        }
        $this->products->id_category = $request->input('id_category');
        return $this;
    }

    public function delete()
    {
        $this->products->delete();
        return $this->products;
    }
    public function save()
    {
        $this->products->save();
        return $this->products;
    }


}
