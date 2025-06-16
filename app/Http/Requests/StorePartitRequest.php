<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Partit;


class StorePartitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Partit::class);
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
            'arbitre_id' => 'required|exists:arbitres,id',
            'data' => 'required|date|after:today', 
            'gol_local' => 'required|integer|min:0',
            'gol_visitant' => 'required|integer|min:0'
        ];
    }
}
