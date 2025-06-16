@extends('layouts.futbolFemeni')

@section('title', "Editar Estadi")

@section('content')
<form action="{{ route('estadis.update', $estadi->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom:</label>
        <input type="text" name="nom" id="nom" value="{{ old('nom', $estadi->nom) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('nom') border-red-500 @enderror">
        @error('nom')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="ciutat" class="block text-sm font-medium text-gray-700 mb-1">Ciutat:</label>
        <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat', $estadi->ciutat) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('ciutat') border-red-500 @enderror">
        @error('ciutat')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="capacitat" class="block text-sm font-medium text-gray-700 mb-1">Capacitat:</label>
        <input type="number" name="capacitat" id="capacitat" value="{{ old('capacitat', $estadi->capacitat) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('capacitat') border-red-500 @enderror">
        @error('capacitat')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="equip_principal" class="block text-sm font-medium text-gray-700 mb-1">Equip Principal:</label>
        <input type="text" name="equip_principal" id="equip_principal" value="{{ old('equip_principal', $estadi->equip_principal) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('equip_principal') border-red-500 @enderror">
        @error('equip_principal')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit"
        class="w-full bg-blue-500 text-black font-medium py-2 px-4 rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
        Actualitzar Estadi
    </button>
</form>
@endsection

