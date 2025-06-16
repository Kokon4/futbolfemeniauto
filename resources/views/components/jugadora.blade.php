@props(['nom', 'equip', 'posicio', 'dorsal', 'data_naixement'])
<div class="jugador border rounded-lg shadow-md p-4 bg-white">
    <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
    <p><strong>Equip:</strong> {{ $equip }}</p>
    <p><strong>Posició:</strong> {{ $posicio }}</p>
    <p><strong>Dorsal:</strong> {{ $dorsal }}</p>
    <p><strong>Data de Naixement:</strong> {{ $data_naixement }}</p>
</div>