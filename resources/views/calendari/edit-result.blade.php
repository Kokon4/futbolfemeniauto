@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Resultat del Partit</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('calendari.update-result', $partit) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <p class="text-center text-gray-600 mb-4">
                    {{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y H:i') }}
                </p>

                <div class="flex items-center justify-between">
                    <div class="flex-1 text-right">
                        <p class="font-medium mb-2">{{ $partit->equip_local->nom }}</p>
                        <input type="number" 
                               name="gol_local" 
                               value="{{ old('gol_local', $partit->gol_local) }}"
                               class="border rounded px-3 py-2 w-20 text-center"
                               min="0"
                               required>
                    </div>

                    <div class="mx-4">
                        <span class="text-xl">-</span>
                    </div>

                    <div class="flex-1">
                        <p class="font-medium mb-2">{{ $partit->equip_visitant->nom }}</p>
                        <input type="number" 
                               name="gol_visitant" 
                               value="{{ old('gol_visitant', $partit->gol_visitant) }}"
                               class="border rounded px-3 py-2 w-20 text-center"
                               min="0"
                               required>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div class="bg-red-50 text-red-500 p-4 rounded mb-6">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex justify-center space-x-4">
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Guardar
                </button>
                <a href="{{ route('calendari.index') }}" 
                   class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                    Cancel·lar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection


