<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['string', 'required', 'max:255'],
            'description' => ['string', 'required', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'title.string' => 'タイトルは文字にしてください',
            'title.required' => 'タイトルの入力は必須です',
            'title.max' => 'タイトルの文字制限を超過しています',
        ];
    }
}
