<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partit;
use App\Models\Equip;
use App\Http\Requests\StorePartitRequest;
use App\Http\Requests\UpdatePartitRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class PartitController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partits = Partit::with(['equip_local', 'equip_visitant', 'arbitre'])
            ->orderBy('jornada')
            ->orderBy('data')
            ->paginate(9);
        return view('partits.index', compact('partits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create');
        $equips = Equip::all();
        return view('partits.create', compact('equips'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartitRequest $request)
    {
        $this->authorize('create');
        Partit::create($request->validated());
        return redirect()->route('partits.index')->with('success', 'Partit creat correctament!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partit $partit)
    {
        return view('partits.show', compact('partit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partit $partit)
    {
        $this->authorize('update', 'partit');
        $equips = Equip::all();
        return view('partits.edit', compact('partit', 'equips'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartitRequest $request, Partit $partit)
    {
        $this->authorize('update', 'partit');
        $partit->update($request->validated());
        return redirect()->route('partits.index')->with('success', 'Partit actualitzat amb èxit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partit $partit)
    {
        $this->authorize('delete', 'partit');
        $partit->delete();
        return redirect()->route('partits.index')->with('success', 'Partit eliminat amb èxit.');
    }

    public function editResult(Partit $partit)
    {
        if (!Auth::user() || Auth::user()->role !== 'arbitre' || Auth::id() !== $partit->arbitre_id) {
            abort(403, 'No tens permís per editar aquest partit.');
        }

        return view('partits.edit-result', compact('partit'));
    }

    public function updateResult(Request $request, Partit $partit)
    {
        if (!Auth::user() || Auth::user()->role !== 'arbitre' || Auth::id() !== $partit->arbitre_id) {
            abort(403, 'No tens permís per editar aquest partit.');
        }

        $validated = $request->validate([
            'gol_local' => 'required|integer|min:0',
            'gol_visitant' => 'required|integer|min:0',
        ]);

        $partit->update($validated);

        return redirect()->route('partits.index')
            ->with('success', 'Resultat actualitzat correctament');
    }
}
