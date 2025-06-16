@extends('layouts.futbolFemeni')

@section('title', 'Afegir Nou Partit')

@section('content')
<div class="container mx-auto mt-6">
    <h1 class="text-3xl font-bold text-blue-800 mb-4">Afegir Nou Partit</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('partits.store') }}" method="POST" class="bg-gray-100 p-6 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label for="equip_local_id" class="block text-sm font-medium text-gray-700 mb-1">Equip Local</label>
            <select name="equip_local_id" id="equip_local_id" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @foreach ($equips as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="equip_visitant_id" class="block text-sm font-medium text-gray-700 mb-1">Equip Visitant</label>
            <select name="equip_visitant_id" id="equip_visitant_id" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @foreach ($equips as $equip)
                    <option value="{{ $equip->id }}">{{ $equip->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="data" class="block text-gray-700">Data</label>
            <input type="date" id="data" name="data" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="resultat" class="block text-gray-700">Resultat</label>
            <input type="text" id="resultat" name="resultat" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded hover:bg-blue-600">Afegir nou Partit</button>
    </form>
</div>
@endsection

