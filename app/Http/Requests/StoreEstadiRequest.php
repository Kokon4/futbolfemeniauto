<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Estadi;
class StoreEstadiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Estadi::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
          'nom' => 'required|string|max:255', 
            'capacitat' => 'required|integer|min:1',
            'ciutat' => 'required|string|max:255', 
        ];
    }
    public function messages(): array
    {
        return [
            'nom.required' => 'El camp "Nom" és obligatori.',
            'nom.string' => 'El camp "Nom" ha de ser text.',
            'nom.max' => 'El camp "Nom" no pot tenir més de 255 caràcters.',

            'capacitat.required' => 'El camp "Capacitat" és obligatori.',
            'capacitat.integer' => 'El camp "Capacitat" ha de ser un número enter.',
            'capacitat.min' => 'El camp "Capacitat" ha de ser un número positiu.',

            'ciutat.required' => 'El camp "Ciutat" és obligatori.',
            'ciutat.string' => 'El camp "Ciutat" ha de ser text.',
            'ciutat.max' => 'El camp "Ciutat" no pot tenir més de 255 caràcters.',
        ];
    }
}
