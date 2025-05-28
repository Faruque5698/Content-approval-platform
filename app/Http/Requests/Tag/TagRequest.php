<?php

namespace App\Http\Requests\Tag;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
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
        $tag = $this->route('tag');

        if (is_string($tag) || is_int($tag)) {
            $tag = Tag::find($tag);
        }

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Tag::class)->ignore($tag?->id),
            ],


        ];
    }
}
