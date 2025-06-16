<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CalendariController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $user = Auth::user();
        $jornada = $request->query('jornada', 1);
        
        $query = $user && $user->role === 'arbitre' 
            ? Partit::where('arbitre_id', $user->id)
            : Partit::query();

        $totalJornades = $query->distinct('jornada')->count('jornada');
        
        $partits = $query->where('jornada', $jornada)
            ->with(['equip_local', 'equip_visitant', 'arbitre'])
            ->orderBy('data')
            ->get()
            ->groupBy('jornada');

        return view('calendari.index', compact('partits', 'jornada', 'totalJornades'));
    }

    public function edit(Partit $partit)
    {
        $this->authorize('update', $partit);
        return view('calendari.edit', compact('partit'));
    }

    public function update(Request $request, Partit $partit)
    {
        $this->authorize('update', $partit);
        
        $validated = $request->validate([
            'gol_local' => 'required|integer|min:0',
            'gol_visitant' => 'required|integer|min:0',
        ]);

        $partit->update($validated);

        return redirect()->route('calendari.index')->with('success', 'Resultat actualitzat correctament');
    }
}
