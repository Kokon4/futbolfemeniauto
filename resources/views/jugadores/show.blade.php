@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">{{ $jugadora->nom }} {{ $jugadora->cognom }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 mb-4 md:mb-0">
                @if($jugadora->foto)
                    <img src="{{ asset('storage/' . $jugadora->foto) }}" alt="Foto de {{ $jugadora->nom }}" class="w-full rounded-lg">
                @else
                    <div class="w-full h-64 bg-gray-300 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500">Sense foto</span>
                    </div>
                @endif
            </div>
            <div class="md:w-2/3 md:pl-6">
                <h2 class="text-2xl font-semibold mb-4">Informació de la Jugadora</h2>
                <p><strong>Equip:</strong> {{ $jugadora->equip->nom }}</p>
                <p><strong>Dorsal:</strong> {{ $jugadora->dorsal }}</p>
                <p><strong>Posició:</strong> {{ $jugadora->posicio }}</p>
                <p><strong>Data de naixement:</strong> 
    @php
        $dataNaixement = $jugadora->data_naixement instanceof \Carbon\Carbon 
            ? $jugadora->data_naixement 
            : \Carbon\Carbon::parse($jugadora->data_naixement);
    @endphp
    {{ $dataNaixement->format('d/m/Y') }}
</p>
<p><strong>Edat:</strong> {{ $dataNaixement->age }} anys</p>

                @if(Auth::user() && Auth::user()->role === 'manager' && Auth::user()->equip_id === $jugadora->equip_id)
                    <div class="mt-6">
                        <a href="{{ route('jugadores.edit', $jugadora) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mr-2">Editar</a>
                        <form action="{{ route('jugadores.destroy', $jugadora) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="return confirm('Estàs segur que vols eliminar aquesta jugadora?')">Eliminar</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

