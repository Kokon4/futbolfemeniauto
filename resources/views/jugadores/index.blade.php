@extends('layouts.futbolFemeni')

@section('title', "Guia de Jugadores")

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-blue-800 mb-6">Llistat de jugadores</h1>

    @if(Auth::user() && Auth::user()->role === 'manager')
        <a href="{{ route('jugadores.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700">
            Afegir Nova Jugadora
        </a>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 p-2">Nom</th>
                    <th class="border border-gray-300 p-2">Equip</th>
                    <th class="border border-gray-300 p-2">Posició</th>
                    <th class="border border-gray-300 p-2">Operacions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jugadores as $jugadora)
                    <tr class="hover:bg-gray-100">
                        <td class="border border-gray-300 p-2">
                            <a href="{{ route('jugadores.show', $jugadora) }}" class="text-blue-700 hover:underline">{{ $jugadora->nom }}</a>
                        </td>
                        <td class="border border-gray-300 p-2">{{ $jugadora->equip->nom }}</td>
                        <td class="border border-gray-300 p-2">{{ $jugadora->posicio }}</td>
                        <td class="border border-gray-300 p-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('jugadores.show', $jugadora) }}" class="text-green-600 hover:underline">Mostrar</a>
                                
                                @if(Auth::user() && Auth::user()->role === 'manager' && Auth::user()->equip_id === $jugadora->equip_id)
                                    <a href="{{ route('jugadores.edit', $jugadora) }}" class="text-yellow-600 hover:underline">Editar</a>
                                    
                                    <form action="{{ route('jugadores.destroy', $jugadora) }}" method="POST" onsubmit="return confirm('Estàs segur que vols esborrar aquesta jugadora?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Esborrar</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

