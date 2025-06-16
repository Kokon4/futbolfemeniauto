@extends('layouts.futbolFemeni')

@section('title', "Guia d'Equips")

@section('content')
<h1 class="text-3xl font-bold text-blue-800 mb-6">Guia d'Equips</h1>
<table class="w-full border-collapse border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="border border-gray-300 p-2">Nom</th>
            <th class="border border-gray-300 p-2">Estadi</th>
            <th class="border border-gray-300 p-2">Títols</th>
            <th class="border border-gray-300 p-2">Operacions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($equips as $equip)
        <tr class="hover:bg-gray-100">
            <td class="border border-gray-300 p-2">
                <a href="{{ route('equips.show', $equip->id) }}" class="text-blue-700 hover:underline">{{ $equip->nom }}</a>
            </td>
            <td class="border border-gray-300 p-2">{{ $equip->estadi->nom ?? 'Sense Estadi'}}</td>
            <td class="border border-gray-300 p-2">{{ $equip->titols }}</td>

            @auth
            <td class="border border-gray-300 p-2 flex space-x-2">
                <a href="{{ route('equips.show', $equip->id) }}" class="text-green-600 hover:underline"> Mostrar </a>
                @can('update', $equip)
                <a href="{{ route('equips.edit', $equip->id) }}" class="text-yellow-600 hover:underline">Editar</a>
                @endcan
                 @can('delete', $equip)
                <form action="{{route('equips.destroy',$equip->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Esborrar</button>
                </form>
                @endcan
            </td>
            @endauth
        </tr>
        @endforeach
    </tbody>
    @auth
    @if(Auth::user()->role === 'administrador')
        <a href="{{ route('equips.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700">
            Afegir Nou Equip
        </a>
    @endif
@endauth
</table>
{{$equips->links()}}
@endsection