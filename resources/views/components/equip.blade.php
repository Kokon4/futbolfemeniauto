<div class="equip border rounded-lg shadow-md p-4 bg-white">
        @if ($escut)
            <td class="border border-gray-300 p-2">
                <img src="{{ asset('storage/' . $escut) }}" alt="Escut de {{ $nom }}" class="h-8 w-8 object-cover rounded-full">
            </td>
        @endif
    <h2 class="text-xl font-bold text-blue-800">{{ $nom }}</h2>
    <p><strong>Estadi:</strong> {{ $estadi }}</p>
    <p><strong>Títols:</strong> {{ $titols }}</p>
</div>