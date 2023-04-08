<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Excluir Usuario') }}
        </h2>
    </x-slot>

    <x-guest-layout>
        <form method="POST" action="{{ route('excluirUsuario') }}">
            @csrf

            <label for="idUsuario" class="block mt-1 text-sm font-medium text-gray-900 dark:text-white">Selecione o usuario para excluir</label>
            <select id="idUsuario" name="idUsuario"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected disabled>Selecione o Usuario</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->idUsuario }}">{{ $usuario->name }}</option>
                @endforeach

            </select>
            <x-primary-button class="mt-2">
                {{ __('Excluir') }}
            </x-primary-button>
        </form>
    </x-guest-layout>

</x-app-layout>
