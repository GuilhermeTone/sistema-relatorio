<style>
    #datatable-search_length>label>select {
        width: 30%;
    }

    #datatable-search_length {
        width: 25%;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Produtos') }}
        </h2>
    </x-slot>


    <body class="antialiased font-sans bg-gray-200">
        <div class="w-full max-w-full w-full shadow bg-white rounded mt-2">
            @if (isset($mensagem))
                <div class="flex p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ $mensagem }}
                    </div>
                </div>
            @endif
            <button type="button" style="width: 10rem; height:2rem; margin-right: 15px"
                        class="text-white bg-gray-800 mt-2 ml-2 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-5 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 rounded-lg" data-modal-toggle="default-modal-cadastra">Cadastrar Loja</button>
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="table-responsive py-3 px-3">
                    <table class="table table-flush text-slate-500" datatable id="datatable-search">
                        <thead class="thead-light">
                            <tr>
                                <th class="centralizar">idLoja</th>
                                <th class="centralizar">Nome</th>
                                <th class="centralizar">Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    @include('lojas.modals.modalEditarLoja')
    @include('lojas.modals.modalCadastrarLoja')
</x-app-layout>
<script>
    var lojas = ('<?php echo json_encode($lojas); ?>');
</script>
<script src="{{ asset('js/lojas/index.js') }}"></script>
