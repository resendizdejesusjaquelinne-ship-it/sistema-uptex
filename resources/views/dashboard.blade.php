<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    
                    <form action="{{ route('reportes.csv') }}" method="POST" style="margin-top: 20px;">
                        @csrf
                        <button type="submit" style="background-color: #2563eb; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold; cursor: pointer;">
                            Generar Reporte CSV
                        </button>
                    </form>

                    <hr style="margin: 30px 0; border-color: #e5e7eb;">

                    <h3 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 20px;">Práctica 19: Componentes Livewire</h3>
                    
                    {{-- Aquí integramos los 3 componentes juntos --}}
                    <div style="display: flex; flex-wrap: wrap; gap: 40px; background-color: #f9fafb; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb;">
                        
                        <div style="flex: 1; min-width: 250px;">
                            @livewire('buscador-productos')
                        </div>

                        <div style="flex: 1; min-width: 250px;">
                            @livewire('contador-favoritos')
                        </div>

                        <div style="flex: 1; min-width: 250px;">
                            @livewire('formulario-contacto')
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>