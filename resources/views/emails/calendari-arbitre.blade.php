<x-mail::message>
# Hola, bon dia {{ $arbitre->name }}

Ací tens el teu calendari anual de partits:

<x-mail::table>
| Data | Equip Local | Equip Visitant | Estadi |
| :--- | :---------- | :------------- | :----- |
@foreach($partits as $partit)
| {{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y H:i') }} | {{ $partit->equip_local->nom }} | {{ $partit->equip_visitant->nom }} | {{ $partit->equip_local->estadi->nom }} |
@endforeach
</x-mail::table>

Gràcies pel teu servei com a àrbitre.

Salutacions,<br>
{{ config('app.name') }}
</x-mail::message>

