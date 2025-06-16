<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreJugadoraRequest;
use App\Http\Requests\UpdateJugadoraRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class JugadoraController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $jugadores = Jugadora::all();
        return view('jugadores.index', compact('jugadores'));
    }


    // Un manager (Usuari) a l'hora de crear una jugadora l'assignara directament
    // al seu equip

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create');
        $jugadores = Jugadora::with('equip')->get();
        return view('jugadores.create', compact('equip'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJugadoraRequest $request)
    {
        $this->authorize('create');
        $validated = $request->validated();
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fotos', 'public');
            $validated['foto'] = $path;
        }
        Jugadora::create($validated);
        return redirect()->route('jugadores.index')->with('success', 'Jugadora creada correctament');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jugadora $jugadore)
    {
        $jugadora = $jugadore;
        return view('jugadores.show', compact('jugadora'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jugadora $jugadore)
    {   
        $jugadora = $jugadore;
        $this->authorize('update', $jugadora);
        $equips = Equip::all();
        return view('jugadores.edit', compact('jugadora','equips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJugadoraRequest $request, Jugadora $jugadore)
    {
        $validated = $request->validated();
        $jugadora= $jugadore;
        //$this->authorize('update', $jugadora);
        if ($request->hasFile('foto')) {
            if ($jugadora->foto) {
                Storage::disk('public')->delete($jugadora->foto);
            }
            $path = $request->file('foto')->store('fotos', 'public');
            $validated['foto'] = $path;
        }
        $jugadora->update($validated);
        return redirect()->route('jugadores.index')->with('success', 'Jugadora actualitzada correctament!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jugadora $jugadora)
    {
        $this->authorize('delete', $jugadora);
    
        if($jugadora->foto){
            Storage::disk('public')->delete($jugadora->foto);
        }
        $jugadora->delete();
    }
}
