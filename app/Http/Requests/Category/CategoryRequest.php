<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $category = $this->route('category');

        if (is_string($category) || is_int($category)) {
            $category = Category::find($category);
        }

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Category::class)->ignore($category?->id),
            ],


        ];
    }
}
