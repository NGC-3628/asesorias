<?php

namespace App\Http\Requests\heroesRequest;

use Illuminate\Foundation\Http\FormRequest;

class HeroCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // 👈 Asegúrate de que esté en true
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string',
            'vida' => 'required|integer',
            'habilidad' => 'required|string',
            'rol_id' => 'required|exists:roles,id',
        ];
    }
}