<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProduct extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255', 'regex:/^[а-яА-ЯёЁ0-9\s]+$/iu'],
            'price'       => ['required', 'numeric', 'min:1', 'max:9999999999.99'],
            'id_category' => ['required', 'integer', 'min:1'],
            'quantity'    => ['nullable', 'integer', 'min:0'],
            'img'         => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'model'       => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z0-9\s]+$/i'],
            'year'        => ['required', 'integer', 'min:2000', 'max:2100'],
            'country'     => ['required', 'string', 'max:100', 'regex:/^[а-яА-ЯёЁ\s]+$/iu'],
        ];
    }

    public function messages(): array
    {
        return [
            // ===== name =====
            'name.required' => 'Поле «Название» обязательно для заполнения.',
            'name.string'   => 'Название должно быть текстом.',
            'name.max'      => 'Название не должно превышать 255 символов.',
            'name.regex'    => 'Название может содержать только русские буквы, цифры и пробелы.',

            // ===== price =====
            'price.required' => 'Поле «Цена» обязательно для заполнения.',
            'price.numeric'  => 'Цена должна быть числом.',
            'price.min'      => 'Цена не может быть меньше 1.',
            'price.max'      => 'Цена не может превышать 9 999 999 999.99.',

            // ===== id_category =====
            'id_category.required' => 'Необходимо выбрать категорию.',
            'id_category.integer'  => 'Категория должна быть целым числом.',
            'id_category.min'      => 'Некорректная категория.',

            // ===== quantity =====
            'quantity.integer' => 'Количество должно быть целым числом.',
            'quantity.min'     => 'Количество не может быть отрицательным.',

            // ===== img =====
            'img.required' => 'Необходимо загрузить изображение.',
            'img.image'    => 'Файл должен быть изображением.',
            'img.mimes'    => 'Изображение должно быть в формате: jpeg, png, jpg, gif или svg.',
            'img.max'      => 'Размер изображения не должен превышать 2 МБ.',

            // ===== model =====
            'model.required' => 'Поле «Модель» обязательно для заполнения.',
            'model.string'   => 'Модель должна быть текстом.',
            'model.max'      => 'Модель не должна превышать 100 символов.',
            'model.regex'    => 'Модель может содержать только латинские буквы, цифры и пробелы.',

            // ===== year =====
            'year.required' => 'Поле «Год» обязательно для заполнения.',
            'year.integer'  => 'Год должен быть целым числом.',
            'year.min'      => 'Год не может быть меньше 2000.',
            'year.max'      => 'Год не может быть больше 2100.',

            // ===== country =====
            'country.required' => 'Поле «Страна» обязательно для заполнения.',
            'country.string'   => 'Страна должна быть текстом.',
            'country.max'      => 'Страна не должна превышать 100 символов.',
            'country.regex'    => 'Страна может содержать только русские буквы и пробелы.',
        ];
    }
}
