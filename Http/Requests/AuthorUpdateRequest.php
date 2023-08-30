<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class AuthorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('edit_authors');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:255',
            'bio'       => 'required|max:255',
            'facebook'  => 'max:255',
            'instagram' => 'max:255',
            'twitter'   => 'max:255',
        ];
    }
}
