<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Partit;

class UpdatePartitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return $this->user() && $this->user()->role === 'arbitre';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'equip_local_id' => 'required|exists:equips,id',
            'equip_visitant_id' => 'required|exists:equips,id',
            'estadi_id' => 'required|exists:estadis,id',
            'data' => 'required|date|after:today',
            'gol_local' => 'required|integer|min:0',
            'gol_visitant' => 'required|integer|min:0'
        ];
    }
    public function messages()
    {
        return [
            'gol_local.required' => 'El camp "Gols Local" és obligatori.',
            'gol_local.integer' => 'El camp "Gols Local" ha de ser un número enter.',
            'gol_local.min' => 'El nombre de gols no pot ser inferior a zero.',
            'gol_visitant.required' => 'El camp "Gols Visitant" és obligatori.',
            'gol_visitant.integer' => 'El camp "Gols Visitant" ha de ser un número enter.',
            'gol_visitant.min' => 'El nombre de gols no pot ser inferior a zero.',
        ];
    }
}
