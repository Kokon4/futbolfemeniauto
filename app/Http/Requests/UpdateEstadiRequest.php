<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstadiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $estadi = $this->route('estadi'); // Obté l'equip de la ruta
        return $this->user()->can('update', $estadi);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $estadiId = $this->route('estadi')->id; // Obté l'ID de l'equip actual
        return [
            'nom' => 'required|unique:estadis,nom,' . $estadiId,
            'ciutat' => 'required|string|max:255',
            'capacitat' => 'required|integer|min:1',
        ];
    }
    public function messages(): array
    {
        return [
            'nom.required' => 'El camp "Nom" és obligatori.',
            'nom.string' => 'El camp "Nom" ha de ser text.',
            'nom.max' => 'El camp "Nom" no pot tenir més de 255 caràcters.',
            'nom.unique' => 'Aquest nom ja està en ús per un altre estadi. Si us plau, tria un altre.',

            'ciutat.required' => 'El camp "Ciutat" és obligatori.',
            'ciutat.string' => 'El camp "Ciutat" ha de ser text.',
            'ciutat.max' => 'El camp "Ciutat" no pot tenir més de 255 caràcters.',

            'capacitat.required' => 'El camp "Capacitat" és obligatori.',
            'capacitat.integer' => 'El camp "Capacitat" ha de ser un número enter.',
            'capacitat.min' => 'El camp "Capacitat" ha de ser un número positiu.',
        ];
    }
}
