<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],


            'avatar' => [
                'nullable',
                'file',
                File::types(['jpg', 'png', 'webp'])->max(10 * 1024),
                'dimensions:min_width=50,min_height=50,max_width=1024,max_height=1024,ratio=1',
            ],
        ];
    }

    public function messages()
    {
        return [
            'avatar.dimensions' => '请上传长宽50-1024像素内的正方形图片',
        ];
    }
}
