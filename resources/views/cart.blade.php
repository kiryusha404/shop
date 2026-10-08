@extends('layouts.app')

@section('content')

    <div class="container my-4">
        <h1 class="mb-4">Корзина</h1>

        <div class="row g-4">

            <div class="col-12 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th style="width: 100px;">Изображение</th>
                                <th>Название</th>
                                <th>Цена</th>
                                <th style="width: 180px;" class="text-center">Количество</th>
                            </tr>
                            </thead>
                            <tbody>
                @foreach($carts as $product)
                            <tr>
                                <td>
                                    <div style="width: 80px; height: 80px; overflow: hidden;">
                                        <img src="{{ asset('/assets/img/' . $product->img) }}"
                                             alt="Товар"
                                             class="object-fit-cover">
                                    </div>
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }} ₽</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <form action="{{ route('minus.cart') }}" method="POST" class="d-inline">
                                            @method('PATCH')
                                            @csrf
                                            <input type="hidden" name="id_product" value="{{$product->id}}">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm">−</button>
                                        </form>

                                        <span class="fw-bold">{{ $product->quantity }}</span>

                                        <form action="{{ route('plus.cart') }}" method="POST" class="d-inline">
                                            @method('PATCH')
                                            @csrf
                                            <input type="hidden" name="id_product" value="{{$product->id}}">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

@endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-12 col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Итог</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Товаров:</span>
                            <span>{{ $count }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-bold">Общая стоимость:</span>
                            <span class="fw-bold">{{ $total_price }} ₽</span>
                        </div>

                        <button type="button"
                                class="btn btn-primary w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#confirmOrderModal">
                            Оформить заказ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="confirmOrderModal" tabindex="-1"
         aria-labelledby="confirmOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="#" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmOrderModalLabel">Подтверждение заказа</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <p>Для оформления заказа подтвердите свой пароль.</p>

                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Пароль</label>
                            <input type="password"
                                   class="form-control"
                                   id="confirmPassword"
                                   name="password"
                                   placeholder="Введите пароль"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Подтвердить заказ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
