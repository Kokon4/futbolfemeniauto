@extends('layouts.futbolFemeni')
@section('title', "Pagina equip Femení" )
@section('content')
<x-partit
   :local="$partit->equip_local->nom"
   :visitant="$partit->equip_visitant->nom"
   :date="$partit->data"
   :gol_local="$partit->gol_local"
   :gol_visitant="$partit->gol_visitant"
/>

<p>Gols Locals: {{ $partit->gol_local }}</p>
<p>Gols Visitants: {{ $partit->gol_visitant }}</p>

@endsection