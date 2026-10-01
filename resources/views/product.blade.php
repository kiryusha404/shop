@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('assets/img/' . $product->img) }}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Категория: {{ $product->category->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
