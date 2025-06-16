@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Calendari de Partits</h1>

    @if($partits->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500 text-lg">No hi ha partits programats per a vosté en aquest moment.</p>
        </div>
    @else
        <div class="flex justify-center space-x-2 mb-6">
            @for ($i = 1; $i <= $totalJornades; $i++)
                <a href="{{ route('calendari.index', ['jornada' => $i]) }}" 
                   class="px-4 py-2 rounded-lg {{ $jornada == $i ? 'bg-blue-600 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">
                    {{ $i }}
                </a>
            @endfor
        </div>

        @foreach($partits as $jornadaPartits)
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Jornada {{ $jornada }}</h2>
                
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    @foreach($jornadaPartits as $partit)
                        <div class="p-4 border-b last:border-b-0 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 text-right">
                                    <span class="font-medium">{{ $partit->equip_local->nom }}</span>
                                    <span class="inline-block w-8"></span>
                                </div>
                                
                                <div class="flex items-center justify-center space-x-4 min-w-[120px] mx-4">
                                    @if(isset($partit->gol_local) && isset($partit->gol_visitant))
                                        <span class="text-xl font-bold">{{ $partit->gol_local }}</span>
                                        <span class="text-gray-500 px-2">-</span>
                                        <span class="text-xl font-bold">{{ $partit->gol_visitant }}</span>
                                    @else
                                        <span class="text-gray-500">vs</span>
                                    @endif
                                </div>

                                <div class="flex-1">
                                    <span class="inline-block w-8"></span>
                                    <span class="font-medium">{{ $partit->equip_visitant->nom }}</span>
                                </div>
                            </div>

                            <div class="text-center text-sm text-gray-500 mt-2">
                                {{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y H:i') }}
                                <span class="mx-2">·</span>
                                <span>Àrbitre: {{ $partit->arbitre->name }}</span>
                                
                                @if(Auth::user() && Auth::user()->role === 'arbitre' && 
                                    Auth::id() === $partit->arbitre_id)
                                    <a href="{{ route('calendari.edit', $partit) }}" 
                                       class="ml-4 text-blue-600 hover:text-blue-800">
                                        Editar resultat
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

