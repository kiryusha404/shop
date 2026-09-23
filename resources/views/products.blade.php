@extends('layouts.app')

@section('content')

    <div class="container">

        <form class="row g-2">
            <div class="col">
                <label for="sort" class="form-label">Вид сортировки</label>
                <select class="form-select" name="sort" id="sort" onchange="this.form.submit()">
                    <option value="1">По умолчанию</option>
                    <option value="2">По цене: от большего к меньшему</option>
                    <option value="3">По цене: от меньшего к большему</option>
                    <option value="2">По количеству: от большего к меньшему</option>
                    <option value="3">По количеству: от меньшего к большему</option>
                </select>
            </div>
            <div class="col">
                <label for="category" class="form-label">Категория</label>
                <select class="form-select" name="category" id="category" onchange="this.form.submit()">
                    <option value="0">Все</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach

                </select>
            </div>
        </form>

        <hr class="my-4">
        <div class="row row-cols-1 row-cols-md-3 g-4">

            @foreach($products as $product)
            <div class="col">
                <a href="{{ route('product', $product->id) }}" class="text-decoration-none">
                    <div class="card h-100 ">
                        <img src="{{ asset('/assets/img/' . $product->img) }}" class="card-img-top object-fit-cover" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Цена: {{ $product->price }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach



        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>

@endsection
