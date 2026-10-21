<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProduct extends FormRequest
{
    public function rules(){
        return ['id_product' => 'required|exists:products,id'];
    }

}
