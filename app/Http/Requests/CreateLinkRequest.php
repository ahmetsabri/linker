<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class CreateLinkRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'links' => ['required','array'],
            'links.*.url' => ['required','url'],
            'links.*.title' => ['required','string','max:255'],
        ];
    }

    public function prepareForValidation()
    {
        $links = ['links'=>json_decode($this->links, true)];

        data_set($links, 'links.*.user_id', auth()->id());

        $this->merge([
            'links' => $links['links'],
        ]);
    }
}
