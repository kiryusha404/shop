<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ProductServices
{
    protected Builder $query;
    public function __construct(){
        $this->query = Product::select('id', 'name', 'price', 'img', 'id_category' , 'quantity')->where('quantity', '>', 0);
    }

    public function filter(Request $request)
    {
        if($request->filled('category') && $request->category != 0) {
            $this->query->where('id_category', $request->category);
        }
        return $this;
    }

    public function sort(Request $request)
    {
        switch ($request->input('sort')) {
            case '2':
                $this->query->orderBy('price', 'desc');
                break;
            case '3':
                $this->query->orderBy('price', 'asc');
                break;
            case '4':
                $this->query->orderBy('quantity', 'desc');
                break;
            case '5':
                $this->query->orderBy('quantity', 'asc');
                break;
            default:
                $this->query->orderBy('id', 'desc');
        }
        return $this;
    }

    public function paginate(int $page = 6){
        return $this->query->paginate($page);
    }
}
