<?php

namespace App\Http\Requests\heroesRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class HeroCreateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nombre" => [
                Rule::unique("heroes", "nombre"),
                "required",
                "max:30"
            ],
            "vida" => "required|integer|min:10|max:30000",
            "habilidad" => "required",
            "rol_id" => "required|exists:roles,id",
            "poderes" => "required|array|min:1",
            "poderes.*.nombre" => [
                "required",
                "max:30"
            ],
            "poderes.*.descripcion" => [
                "required"
            ]
        ];
    }

    public function messages() : array
    {
        return [
            "*.required" => "el campo es requerido",
            "*.min" => "el campo debe tener el valor minimo solicitado",
            "*.max" => "la vida debe tener un valor maximo de 30000"
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'message' => "validation failed",
                'errors' => $validator->errors()
            ],422
        ));
    }
}
