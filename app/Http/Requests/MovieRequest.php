<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'youtube_id' => ['required', 'string', 'max:11'],
            'title' => ['nullable', 'string', 'max:36'],
            'favorite_flag' => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'youtube_id' => 'YouTube動画ID',
            'title' => '動画タイトル',
            'favorite_flag' => 'いいねの許可',
        ];
    }
}
