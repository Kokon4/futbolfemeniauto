@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Classificació</h1>
    @livewire('classificacio-table')
</div>
@endsection

