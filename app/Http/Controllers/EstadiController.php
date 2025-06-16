<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Equip;
use App\Models\Estadi;
use App\Http\Requests\StoreEstadiRequest;
use App\Http\Requests\UpdateEstadiRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class EstadiController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estadis = Estadi::paginate(10);
        return view('estadis.index', compact('estadis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Estadi::class);
        $equips = Equip::all();
        $estadis = Estadi::all();
        return view('estadis.create',compact('equips','estadis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstadiRequest $request) 
    {
        $this->authorize('create');
        $validatedData = $request->validated();
        Estadi::create($validatedData);
        return redirect()->route('estadis.index')->with('success', 'Estadi creat correctament!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Estadi $estadi)
    {
        return view('estadis.show', compact('estadi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('update');
        $estadis = Estadi::all();
        $estadi = Estadi::findOrFail($id);
        return view('estadis.edit', compact('estadi','estadis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEstadiRequest $request, Estadi $estadi)  // Usant UpdateEstadiRequest
    {
        // Les dades seran validades automàticament pel UpdateEstadiRequest
        $this->authorize('update', $estadi);
        $validatedData = $request->validated();
        $estadi->update($validatedData);
        return redirect()->route('estadis.show', $estadi->id)->with('success', 'Estadi actualitzat correctament!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estadi $estadi)
    {
        $this->authorize('delete', $estadi);
        $estadi->delete();
        return redirect()->route('estadis.index')->with('success', 'Estadi esborrat correctament!');
    }
}
