@extends('layouts.futbolFemeni')

@section('title', 'Editar Jugadora')

@section('content')
<div class="container mx-auto mt-6 px-4">
    <h1 class="text-3xl font-bold text-blue-800 mb-4">Editar Jugadora</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('jugadores.update', $jugadora->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nom" class="block text-gray-700 font-bold mb-2">Nom de la Jugadora</label>
            <input type="text" id="nom" name="nom" value="{{ old('nom', $jugadora->nom) }}" class="w-full p-2 border border-gray-300 rounded @error('nom') border-red-500 @enderror" required>
            @error('nom')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="equip_id" class="block text-gray-700 font-bold mb-2">Equip</label>
            <select name="equip_id" id="equip_id" class="w-full p-2 border border-gray-300 rounded @error('equip_id') border-red-500 @enderror" required>
                @foreach ($equips as $equip)
                    <option value="{{ $equip->id }}" {{ (old('equip_id', $jugadora->equip_id) == $equip->id) ? 'selected' : '' }}>
                        {{ $equip->nom }}
                    </option>
                @endforeach
            </select>
            @error('equip_id')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="posicio" class="block text-gray-700 font-bold mb-2">Posició</label>
            <select name="posicio" id="posicio" class="w-full p-2 border border-gray-300 rounded @error('posicio') border-red-500 @enderror" required>
                @foreach(['portera', 'defensa', 'migcampista', 'davantera'] as $posicio)
                    <option value="{{ $posicio }}" {{ (old('posicio', $jugadora->posicio) == $posicio) ? 'selected' : '' }}>
                        {{ ucfirst($posicio) }}
                    </option>
                @endforeach
            </select>
            @error('posicio')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="dorsal" class="block text-gray-700 font-bold mb-2">Dorsal</label>
            <input type="number" id="dorsal" name="dorsal" value="{{ old('dorsal', $jugadora->dorsal) }}" class="w-full p-2 border border-gray-300 rounded @error('dorsal') border-red-500 @enderror" required min="1" max="99">
            @error('dorsal')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="data_naixement" class="block text-gray-700 font-bold mb-2">Data de Naixement</label>
            <input type="date" id="data_naixement" name="data_naixement" value="{{ old('data_naixement', $jugadora->data_naixement instanceof \Carbon\Carbon ? $jugadora->data_naixement->format('Y-m-d') : $jugadora->data_naixement) }}" class="w-full p-2 border border-gray-300 rounded @error('data_naixement') border-red-500 @enderror" required>
            @error('data_naixement')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="foto" class="block text-gray-700 font-bold mb-2">Foto</label>
            <input type="file" name="foto" id="foto" accept="image/*" class="w-full p-2 border border-gray-300 rounded @error('foto') border-red-500 @enderror">
            @error('foto')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
            @enderror
            @if($jugadora->foto)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $jugadora->foto) }}" alt="Foto de {{ $jugadora->nom }}" class="mt-2 max-w-xs rounded-lg shadow-md">
                    <p class="text-sm text-gray-600 mt-1">Foto actual</p>
                </div>
            @endif
        </div>

        <div class="flex items-center justify-between mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Actualitzar Jugadora
            </button>
            <a href="{{ route('jugadores.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Cancel·lar
            </a>
        </div>
    </form>
</div>
@endsection
