@extends('layouts.app')

@section('content')

    <div class="container my-4">
        <div class="card shadow-sm">
            <div class="row g-0">

                <div class="col-md-4">
                    <div style="width: 100%; height: 100%; min-height: 300px; overflow: hidden;">
                        <img src="{{ asset('assets/img/' . $product->img) }}"
                             class="object-fit-cover"
                             alt="{{ $product->name }}">
                    </div>
                </div>


                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title mb-3">{{ $product->name }}</h5>

                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Категория:</span>
                                <span>{{ $product->category->name ?? '—' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Модель:</span>
                                <span>{{ $product->model ?? '—' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Страна:</span>
                                <span>{{ $product->country ?? '—' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Год выпуска:</span>
                                <span>{{ $product->year ?? '—' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Количество на складе:</span>
                                <span>
                                    @if($product->quantity > 0)
                                        {{ $product->quantity }} шт.
                                    @else
                                        <span class="text-danger">Нет в наличии</span>
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="text-muted">Цена:</span>
                                <span class="fw-bold fs-5">{{ number_format($product->price, 2, ',', ' ') }} ₽</span>
                            </li>
                        </ul>

                        <form method="POST" action="{{ route('add.cart') }}">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="id_product">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-cart-plus"></i> Добавить в корзину
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
