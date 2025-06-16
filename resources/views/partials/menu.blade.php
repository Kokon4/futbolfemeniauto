<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('equips.index')" :active="request()->routeIs('equips.index')">
        {{ __('Guia Equips') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('estadis.index')" :active="request()->routeIs('estadis.index')">
        {{ __('Estadis') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('jugadores.index')" :active="request()->routeIs('jugadores.index')">
        {{ __('Llista Jugadores') }}
    </x-nav-link>
</div>

<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('partits.index')" :active="request()->routeIs('partits.index')">
        {{ __('Llista Partits') }}
    </x-nav-link>
</div>

<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('classificacio.index')" :active="request()->routeIs('classificacio.index')">
        {{ __('Classificació') }}
    </x-nav-link>
</div>

<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
<x-nav-link :href="route('calendari.index')" :active="request()->routeIs('calendari.index')">
    {{ __('Calendari') }}
</x-nav-link>
</div>
