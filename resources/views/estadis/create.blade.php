@extends('layouts.futbolFemeni')

@section('title', 'Afegir Nou Estadi')

@section('content')
<div class="container mx-auto mt-6">
    <h1 class="text-3xl font-bold text-blue-800 mb-4">Afegir Nou Estadi</h1>

    <!-- Missatge de confirmació -->
    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('estadis.store') }}" method="POST" class="bg-gray-100 p-6 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label for="nom" class="block text-gray-700">Nom de l'Estadi</label>
            <input type="text" id="nom" name="nom" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="ciutat" class="block text-gray-700">Ciutat</label>
            <input type="text" id="ciutat" name="ciutat" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="capacitat" class="block text-gray-700">Capacitat</label>
            <input type="number" id="capacitat" name="capacitat" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="equip_principal" class="block text-gray-700">Equip Principal</label>
            <input type="text" id="equip_principal" name="equip_principal" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        
        <input type="submit" value ="Afegir nou estadi">
    </form>
</div>
@endsection

