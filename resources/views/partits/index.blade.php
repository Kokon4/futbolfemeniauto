@extends('layouts.futbolFemeni')

@section('title', "Guia d'Equips")

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Llistat de partits</h1>

@auth
<a href="{{ route('partits.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700">
    Afegir Nou Partit
</a>
@endauth

<table class="w-full border-collapse border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="border border-gray-300 p-2">Local</th>
            <th class="border border-gray-300 p-2">Visitant</th>
            <th class="border border-gray-300 p-2">Data</th>
            <th class="border border-gray-300 p-2">Resultat</th>
            <th class="border border-gray-300 p-2">Accions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($partits as $partit)
        <tr class="hover:bg-gray-100">
            <td class="border border-gray-300 p-2">
                <a href="{{ route('partits.show', $partit->id) }}" class="text-blue-700 hover:underline">{{ $partit->equip_local->nom }}</a>
            </td>
            <td class="border border-gray-300 p-2">{{ $partit->equip_visitant->nom }}</td>
            <td class="border border-gray-300 p-2">
                <div class="text-sm text-gray-500 mb-2">{{ $partit->data }}</div>
                <div class="text-sm text-gray-500 mb-2">Àrbitre: {{ $partit->arbitre->name }}</div>
            </td>
            <td class="border border-gray-300 p-2">
            <div class="font-bold text-xl mt-2">
                    @if(isset($partit->gol_local) && isset($partit->gol_visitant))
                        {{ $partit->gol_local }} - {{ $partit->gol_visitant }}
                    @else
                        Pendent
                    @endif
                </div>
            </td>
            <td class="border border-gray-300 p-2">
                <a href="{{ route('partits.show', $partit->id) }}" class="text-blue-600 hover:underline mr-2">Mostrar</a>
                @auth
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'arbitre' && auth()->user()->id === $partit->arbitre_id)
                        <a href="{{ route('partits.edit', $partit->id) }}" class="text-green-600 hover:underline mr-2">Editar</a>
                        <form action="{{ route('partits.destroy', $partit->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Estàs segur que vols eliminar aquest partit?')">Eliminar</button>
                        </form>
                    @endif
                @endauth
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
