<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Jugadora extends Model
{
    use HasFactory;
    protected $table = 'jugadores';
    protected $fillable = ['nom', 'posicio', 'dorsal', 'data_naixement', 'equip_id'];
    public function equip(){
        return $this->belongsTo(Equip::class, 'equip_id');
    }
}

