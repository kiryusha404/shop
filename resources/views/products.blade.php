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
                    <option value="1">Категория 1</option>
                    <option value="2">Категория 2</option>
                    <option value="3">Категория 3</option>
                </select>
            </div>
        </form>

        <hr class="my-4">
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <div class="col">
                <a href="{{ route('product', 1) }}" class="text-decoration-none">
                    <div class="card h-100 object-fit-cover">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Заголовок карточки</h5>
                            <p class="card-text">Это более длинная карта С вспомогательным текстом ниже в качестве естественного перехода к дополнительному контенту. Этот контент немного длиннее.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('product', 1) }}" class="text-decoration-none">
                    <div class="card h-100 object-fit-cover">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Заголовок карточки</h5>
                            <p class="card-text">Это более длинная карта С вспомогательным текстом ниже в качестве естественного перехода к дополнительному контенту. Этот контент немного длиннее.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('product', 1) }}" class="text-decoration-none">
                    <div class="card h-100 object-fit-cover">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Заголовок карточки</h5>
                            <p class="card-text">Это более длинная карта С вспомогательным текстом ниже в качестве естественного перехода к дополнительному контенту. Этот контент немного длиннее.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('product', 1) }}" class="text-decoration-none">
                    <div class="card h-100 object-fit-cover">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Заголовок карточки</h5>
                            <p class="card-text">Это более длинная карта С вспомогательным текстом ниже в качестве естественного перехода к дополнительному контенту. Этот контент немного длиннее.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>

@endsection
