@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Llista d'Estadis</h1>

    @can('create', App\Models\Estadi::class)
        <a href="{{ route('estadis.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
            Crear Nou Estadi
        </a>
    @endcan

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border-b">Nom</th>
                    <th class="py-2 px-4 border-b">Ciutat</th>
                    <th class="py-2 px-4 border-b">Capacitat</th>
                    <th class="py-2 px-4 border-b">Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estadis as $estadi)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $estadi->nom }}</td>
                        <td class="py-2 px-4 border-b">{{ $estadi->ciutat }}</td>
                        <td class="py-2 px-4 border-b">{{ $estadi->capacitat }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('estadis.show', $estadi) }}" class="text-blue-500 hover:underline mr-2">Veure</a>
                            @can('update', $estadi)
                                <a href="{{ route('estadis.edit', $estadi) }}" class="text-yellow-500 hover:underline mr-2">Editar</a>
                            @endcan
                            @can('delete', $estadi)
                                <form action="{{ route('estadis.destroy', $estadi) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Estàs segur que vols eliminar aquest estadi?')">Eliminar</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
