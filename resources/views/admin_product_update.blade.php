@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Редактировать товар</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="name" class="form-label">Название</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name"
                                   value="{{ old('name', $product->name) }}"
                                   required>
                            @error('name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="img" class="form-label">Изображение (файл)</label>
                            @if($product->img)
                                <div class="mb-2">
                                    <img src="{{ asset('assets/img/' . $product->img) }}" alt="Текущее фото" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            @endif
                            <input type="file"
                                   class="form-control @error('img') is-invalid @enderror"
                                   id="img" name="img"
                                   accept="image/*"
                                   aria-describedby="imgHelp">
                            <small id="imgHelp" class="text-muted">Оставьте пустым, чтобы не менять фото. Допустимые форматы: jpeg, png, webp.</small>
                            @error('img')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="price" class="form-label">Цена</label>
                            <input type="number" step="0.01"
                                   class="form-control @error('price') is-invalid @enderror"
                                   id="price" name="price"
                                   value="{{ old('price', $product->price) }}"
                                   required>
                            @error('price')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="country" class="form-label">Страна</label>
                            <input type="text"
                                   class="form-control @error('country') is-invalid @enderror"
                                   id="country" name="country"
                                   value="{{ old('country', $product->country) }}"
                                   required>
                            @error('country')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="year" class="form-label">Год</label>
                            <input type="number"
                                   class="form-control @error('year') is-invalid @enderror"
                                   id="year" name="year"
                                   value="{{ old('year', $product->year) }}"
                                   required>
                            @error('year')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="model" class="form-label">Модель</label>
                            <input type="text"
                                   class="form-control @error('model') is-invalid @enderror"
                                   id="model" name="model"
                                   value="{{ old('model', $product->model) }}">
                            @error('model')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="quantity" class="form-label">Количество</label>
                            <input type="number"
                                   class="form-control @error('quantity') is-invalid @enderror"
                                   id="quantity" name="quantity"
                                   value="{{ old('quantity', $product->quantity) }}"
                                   min="0">
                            @error('quantity')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="id_category" class="form-label">Категория</label>
                            <select class="form-select @error('id_category') is-invalid @enderror"
                                    id="id_category" name="id_category"
                                    required>
                                <option value="" disabled {{ empty(old('id_category')) && empty($product->id_category) ? 'selected' : '' }}>Выберите категорию</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('id_category', $product->id_category) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_category')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Отмена</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
