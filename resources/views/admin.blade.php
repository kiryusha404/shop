@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Админка</h1>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Товары</h3>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="bi bi-plus-lg"></i> Добавить товар
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Название</th>
                        <th>Цена</th>
                        <th class="text-end">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price, 2) }} ₽</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-primary">Изменить</button>
                                <button type="button" class="btn btn-danger">Удалить</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Модальное окно добавления товара -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('product.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalLabel">Добавить товар</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">


                        <div class="row g-3">
                            <div class="col-12">
                                <label for="name" class="form-label">Название</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name" name="name"
                                       value="{{ old('name') }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="img" class="form-label">Изображение (файл)</label>
                                <input type="file"
                                       class="form-control @error('img') is-invalid @enderror"
                                       id="img" name="img"
                                       accept="image/*" required>
                                @error('img')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="price" class="form-label">Цена</label>
                                <input type="number" step="0.01"
                                       class="form-control @error('price') is-invalid @enderror"
                                       id="price" name="price"
                                       value="{{ old('price') }}" required>
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="country" class="form-label">Страна</label>
                                <input type="text"
                                       class="form-control @error('country') is-invalid @enderror"
                                       id="country" name="country"
                                       value="{{ old('country') }}" required>
                                @error('country')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="year" class="form-label">Год</label>
                                <input type="number"
                                       class="form-control @error('year') is-invalid @enderror"
                                       id="year" name="year"
                                       value="{{ old('year') }}" required>
                                @error('year')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="model" class="form-label">Модель</label>
                                <input type="text"
                                       class="form-control @error('model') is-invalid @enderror"
                                       id="model" name="model"
                                       value="{{ old('model') }}">
                                @error('model')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="quantity" class="form-label">Количество</label>
                                <input type="number"
                                       class="form-control @error('quantity') is-invalid @enderror"
                                       id="quantity" name="quantity"
                                       value="{{ old('quantity') }}" min="0">
                                @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="id_category" class="form-label">Категория</label>
                                <select class="form-select @error('id_category') is-invalid @enderror"
                                        id="id_category" name="id_category" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('id_category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_category')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Сохранить товар</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Автоматически открыть модалку при ошибках валидации --}}
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = new bootstrap.Modal(document.getElementById('addProductModal'));
                modal.show();
            });
        </script>
    @endif

@endsection
