<style>
    #datatable-search_length > label > select {
        width: 30%;
    }
    #datatable-search_length {
        width: 25%;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Produtos') }}
        </h2>
    </x-slot>


    <body class="antialiased font-sans bg-gray-200">
        <div class="w-full max-w-full w-full shadow bg-white rounded mt-2">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border py-5 px-5">
                <form method="POST" action="{{ route('excluirUsuario') }}" class="">
                    @csrf

                    <label for="idUsuario" class="block mt-1 text-sm font-medium text-gray-900 dark:text-white">Selecione
                        o usuario para excluir</label>
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
            </div>
        </div>
    </body>

</x-app-layout>


<script src="{{ asset('js/produtos/editar.js') }}"></script>
