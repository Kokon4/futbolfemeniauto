<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Equip extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'estadi_id', 'titols', 'escut'];

    public function estadi()
    {
        return $this->belongsTo(Estadi::class, 'estadi_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class);
    }
    public function jugadores()
    {
        return $this->hasMany(Jugadora::class, 'equip_id');
    }
    public function getEdatMitjanaAttribute()
    {
        $jugadores = $this->jugadores;
        if ($jugadores->isEmpty()) {
            return 0;
        }
        $totalEdad = $jugadores->sum(function ($jugadora) {
            return Carbon::parse($jugadora->data_naixement)->age;
        });
        return round($totalEdad / $jugadores->count(), 2);
    }

    public function partits_locals()
    {
        return $this->hasMany(Partit::class, 'equip_local_id');
    }

    public function partits_visitants()
    {
        return $this->hasMany(Partit::class, 'equip_visitant_id');
    }

    public function partits()
    {
        return $this->partits_locals()->union($this->partits_visitants());
    }

    public function getUltims5PartitsAttribute()
    {
        return $this->partits()
            ->with(['equip_local', 'equip_visitant'])
            ->whereIn('jornada', [15, 14, 13, 12, 11, 10])
            ->take(5)
            ->get()
            ->map(function ($partit) {
                $isLocal = $partit->equip_local_id === $this->id;
                $golsEquip = $isLocal ? $partit->gol_local : $partit->gol_visitant;
                $golsRival = $isLocal ? $partit->gol_visitant : $partit->gol_local;
                $rival = $isLocal ? $partit->equip_visitant->nom : $partit->equip_local->nom;
                
                $resultat = "{$golsEquip} - {$golsRival}";
                
                $estat = 'empat';
                if ($golsEquip > $golsRival) {
                    $estat = 'victoria';
                } elseif ($golsEquip < $golsRival) {
                    $estat = 'derrota';
                }
                
                return [
                    'rival' => $rival,
                    'resultat' => $resultat,
                    'estat' => $estat,
                    'data' => $partit->data,
                    'jornada' => $partit->jornada,
                ];
            });
    }
}
