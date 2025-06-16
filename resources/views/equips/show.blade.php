@extends('layouts.futbolFemeni')

@section('title', "Pàgina equip Femení")

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <x-equip
            :nom="$equip->nom"
            :estadi="$equip->estadi->nom ?? 'Sense Estadi'"
            :titols="$equip->titols"
            :escut="$equip->escut"
        />
    </div>

    <h2 class="text-2xl font-bold text-blue-800 mb-4">Jugadores</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
        @forelse($jugadores as $jugadora)
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                @if($jugadora->foto)
                    <img src="{{ asset('storage/' . $jugadora->foto) }}" class="w-full h-48 object-cover" alt="Foto de {{ $jugadora->nom }}">
                @else
                    <img src="{{ asset('images/default-player.jpg') }}" class="w-full h-48 object-cover" alt="Foto per defecte">
                @endif
                <div class="p-4">
                    <h5 class="font-bold text-lg mb-2">{{ $jugadora->nom }}</h5>
                    <p class="text-sm text-gray-600">
                        <strong>Posició:</strong> {{ $jugadora->posicio }}<br>
                        <strong>Dorsal:</strong> {{ $jugadora->dorsal }}<br>
                        <strong>Data de Naixement:</strong> {{ \Carbon\Carbon::parse($jugadora->data_naixement)->format('d-m-Y') }}<br>
                        <strong>Edat:</strong> {{ \Carbon\Carbon::parse($jugadora->data_naixement)->age }}
                    </p>
                </div>
            </div>
        @empty
            <p class="text-gray-600 col-span-3">No hi ha jugadores assignades a aquest equip.</p>
        @endforelse
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Edat Mitjana de l'Equip</h3>
                <p class="text-3xl font-bold text-blue-600">{{ number_format($edatMitjana, 1) }} anys</p>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Últims 5 partits jugats</h3>
                @if($ultims5Partits->isNotEmpty())
                    <ul class="space-y-2">
                        @foreach($ultims5Partits as $partit)
                            <li class="flex items-center justify-between bg-gray-100 rounded-md p-3">
                                <span class="text-gray-800">{{ $partit['rival'] }}</span>
                                <div class="flex flex-col items-end">
                                    <span class="font-semibold 
                                        {{ $partit['estat'] === 'victoria' ? 'text-green-600' : 
                                            ($partit['estat'] === 'empat' ? 'text-yellow-600' : 'text-red-600') }}">
                                        {{ $partit['resultat'] }}
                                    </span>
                                    <span class="text-xs text-gray-600">
                                        {{ \Carbon\Carbon::parse($partit['data'])->format('d/m/Y') }}, 
                                        Jornada: {{ $partit['jornada'] }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600">No hi ha partits jugats recentment.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

