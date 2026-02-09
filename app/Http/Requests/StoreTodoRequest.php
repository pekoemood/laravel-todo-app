<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTodoRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'due_date' => ['nullable','date', Rule::date()->afterToday()],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'タイトルは必須やで！',
            'title.string' => 'タイトルは文字やで！',
            'title.max' => 'タイトルは255文字までやで!',
            'description.required' => '内容は必須やで!',
            'due_date.date' => '日付である必要があるよ！',
            'due_date.afterToday' => '期限は明日行こうの日付にしてね',
        ];
    }
}
