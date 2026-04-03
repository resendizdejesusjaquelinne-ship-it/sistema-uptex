<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Historial de Actividad
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table-auto w-full text-left">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">Fecha</th>
                                <th class="px-4 py-2 border-b">Acción</th>
                                <th class="px-4 py-2 border-b">Descripción</th>
                                <th class="px-4 py-2 border-b">Usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                            <tr>
                                <td class="px-4 py-2 border-b">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2 border-b">{{ $log->accion }}</td>
                                <td class="px-4 py-2 border-b">{{ $log->descripcion }}</td>
                                <td class="px-4 py-2 border-b">{{ $log->user->name ?? 'Sistema' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>