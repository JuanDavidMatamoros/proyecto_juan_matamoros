<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">
                    {{ __("¡Usted está conectado!") }}

                    <div class="mt-6">
                        <a href="{{ route('equipos.index') }}"
                           class="text-black underline text-lg me-6 hover:text-green-400">
                            Ir a Equipos
                        </a>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('jugadores.index') }}"
                           class="text-black underline text-lg hover:text-green-400">
                            Ir a Jugadores
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

