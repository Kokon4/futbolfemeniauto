<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipRequest;
use App\Http\Requests\UpdateEquipRequest;
use Illuminate\Http\Request;
use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Jugadora;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EquipController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $equips = Equip::paginate(10);
        return view('equips.index', compact('equips'));
    }
    public function show(Equip $equip)
    {
        $jugadores = $equip->jugadores;
        $edatMitjana = $equip->edat_mitjana;
        $ultims5Partits = $equip->ultims_5_partits;
    
        // Ensure $ultims5Partits is a collection, even if empty
        $ultims5Partits = $ultims5Partits ?: collect();
    
        return view('equips.show', compact('equip', 'jugadores', 'edatMitjana', 'ultims5Partits'));
    }

    public function create() {
        $this->authorize('create');
        $estadis = Estadi::all();
        return view('equips.create',compact('estadis','equip'));
    }

    public function edit(Equip $equip) {
        $this->authorize('update', $equip);     
        $estadis = Estadi::all();

        return view('equips.edit', compact('estadis','equip'));
    }

    public function update(UpdateEquipRequest $request, $id, Equip $equip)
{
    $this->authorize('update', $equip);
    $validated = $request->validated();
    $equip = Equip::findOrFail($id);

    if ($request->hasFile('escut')) {
        if ($equip->escut) {
            Storage::disk('public')->delete($equip->escut); // Esborra l'escut antic
        }
        $path = $request->file('escut')->store('escuts', 'public');
        $validated['escut'] = $path;
    }

    $equip->update($validated);
    return redirect()->route('equips.index')->with('success', 'Equip actualitzat correctament!');
}

public function destroy(Equip $equip)
{
    $this->authorize('delete', $equip);
    if ($equip->escut) {
        Storage::disk('public')->delete($equip->escut);
    }
    $equip->delete();
    return redirect()->route('equips.index')->with('success', 'Equip esborrat correctament!');
}
    
    public function store(StoreEquipRequest $request)
{
    $this->authorize('create');
    $validated = $request->validated();
    if ($request->hasFile('escut')) {
        $path = $request->file('escut')->store('escuts', 'public');
        $validated['escut'] = $path;
    }
    Equip::create($validated);
    return redirect()->route('equips.index')->with('success', 'Equip creat correctament!');
}
}