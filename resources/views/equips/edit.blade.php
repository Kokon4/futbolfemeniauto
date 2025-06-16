@extends('layouts.futbolFemeni')

@section('title', "Guia d'Equips")

@section('content')
<form action="{{ route('equips.update', $equip->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom:</label>
        <input type="text" name="nom" id="nom" value="{{ old('nom', $equip->nom) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('nom') border-red-500 @enderror">
        @error('nom')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="titols" class="block text-sm font-medium text-gray-700 mb-1">Títols:</label>
        <input type="number" name="titols" id="titols" value="{{ old('titols', $equip->titols) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('titols') border-red-500 @enderror">
        @error('titols')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="estadi_id" class="block text-sm font-medium text-gray-700 mb-1">Estadi:</label>
        <select name="estadi_id" id="estadi_id" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 
            @error('estadi_id') border-red-500 @enderror">
            @foreach ($estadis as $estadi)
                <option value="{{ $estadi->id }}" {{ $estadi->id == $equip->estadi_id ? 'selected' : '' }}>
                    {{ $estadi->nom }}
                </option>
            @endforeach
        </select>
        @error('estadi_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
    <label for="escut" class="block text-sm font-medium text-gray-700 mb-1">Escut:</label>
    <input type="file" name="escut" id="escut" 
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
    @if ($equip->escut)
        <p class="mt-2 text-sm text-gray-500">Escut actual:</p>
        <img src="{{ asset('storage/' . $equip->escut) }}" alt="Escut de {{ $equip->nom }}" class="h-16 mt-2">
    @endif
</div>
    
    <button type="submit"
        class="w-full bg-blue-500 text-black font-medium py-2 px-4 rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300">
        Actualitzar Equip
    </button>
</form>
@endsection