<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExemploRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'data.nome' => 'required|max:255',
            'data.quantidade' => 'nullable|integer',
            'data.dt_exemplo' => 'nullable|date',
            'data.valor_real' => 'nullable|numeric',
            'data.created_at' => 'nullable|date',
            'data.updated_at' => 'nullable|date',
        ];
    }
}
