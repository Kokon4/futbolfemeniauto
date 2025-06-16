<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJugadoraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $jugadora = $this->route('jugadore');
        return $this->user()->can('update',$jugadora);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $jugadoraId = $this->route('jugadore')->id;
        return [
           'nom' => 'required|string|max:255|unique:jugadores,nom,' . $jugadoraId, 
            'posicio' => 'required|in:defensa,migcampista,davantera,porter',
            'dorsal' => 'required|integer|min:1|max:99',
            'data_naixement' => 'required|date|before:'.now()->subYears(16)->toDateString(), 
            'equip_id' => 'required|exists:equips,id',
            'foto' => 'nullable|mimes:png|max:2048',
        ];
    }
}
