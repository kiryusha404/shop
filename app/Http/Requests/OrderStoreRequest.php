<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Разрешаем выполнение запроса (проверку авторизации можно оставить на уровне middleware или сервиса)
    }

    public function rules(): array
    {
        return [
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Поле пароля обязательно для заполнения.',
        ];
    }
}
