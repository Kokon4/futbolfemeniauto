<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $equip = $this->route('equip');
        return $this->user()->can('update', $equip);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $equipId = $this->route('equip')->id; 

    return [
        'nom' => 'required|unique:equips,nom,' . $equipId,
        'titols' => 'integer|min:0',
        'estadi_id' => 'required|exists:estadis,id',
        'escut' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ];
    }
}
