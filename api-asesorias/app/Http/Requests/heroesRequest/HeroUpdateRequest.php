<?php

namespace App\Http\Requests\heroesRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class HeroUpdateRequest extends FormRequest
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
        $heroId = $this->route('id');

        return [
            "nombre" => [
                "nullable",
                Rule::unique("heroes", "nombre")
                ->ignore($heroId),
                "max:30"
            ],
            "vida" => "nullable|min:10|max:30000",
            "habilidad" => "nullable",
            "poderes" => "nullable|array",
            "rol_id" => "required|exists:roles,id",
            "poderes.*.id" => "required|exists:poderes,id",
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
