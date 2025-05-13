<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight flex items-center gap-2">
            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center items-center min-h-[60vh]">
        <div class="bg-white shadow-2xl rounded-2xl max-w-lg w-full border border-gray-200">
            <div class="p-8 flex flex-col items-center">
                <svg class="w-16 h-16 text-indigo-400 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 17v.01M9 21h6a2 2 0 002-2v-7a2 2 0 00-2-2h-1V8a3 3 0 10-6 0v2H9a2 2 0 00-2 2v7a2 2 0 002 2z"/>
                </svg>
                <h1 class="text-2xl font-bold text-indigo-700 mb-2 text-center">¡Bienvenido!</h1>
                <p class="text-gray-700 text-center mb-4">
                    Esta es mi prueba de Laravel bajo las especificaciones solicitadas.<br>
                    <span class="block font-semibold text-indigo-500 mt-2">Duración: 2 horas</span>
                </p>
                <div class="mt-4 px-6 py-3 bg-indigo-50 rounded-lg text-indigo-900 text-center font-medium shadow">
                    Has iniciado sesión correctamente.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>