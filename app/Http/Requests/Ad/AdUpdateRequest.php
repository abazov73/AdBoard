<?php

namespace App\Http\Requests\Ad;

class AdUpdateRequest extends AdCreateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string',
            'description' => 'string',
            'available' => 'boolean'
        ];
    }
}
