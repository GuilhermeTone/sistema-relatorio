<style>
    #datatable-search_length>label>select {
        width: 30%;
    }

    #datatable-search_length {
        width: 25%;
    }

    .ocultar-elementos *:not(table) {
        display: none !important;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listagem Pedidos') }}
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
            <div class="w-100 flex justify-end">
                <button type="button" style="width: 10rem; height:2rem; margin-right: 15px"
                    class="text-white bg-gray-800 mt-2 ml-2 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-5 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 rounded-lg"
                    onclick=imprimir()>Imprimir</button>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6 flex justify-center pb-5">
                <div class=" md:w-2/12 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-first-name">
                        Data do pedido
                    </label>
                    <input id="dataPedido" type="date" name="dataPedido" value="{{date('Y-m-d')}}"
                        class="block w-full text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class=" md:w-2/12 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-first-name">
                        Tipo
                    </label>
                    <select id="tipo" name="tipo" required
                        class="block w-full px-2 py-2 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected >Todos</option>
                        <option value="Legumes">Legumes</option>
                        <option value="Verduras">Verduras</option>
                        <option value="Frutas">Frutas</option>
                    </select>
                </div>
                <div class=" md:w-2/12 px-3 mb-6 md:mb-0 mt-2">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-first-name"></label>
                    <button type="button" style="width: 10rem; height:2.5rem; margin-right: 15px"
                    class="text-white bg-gray-800 mt-2 ml-2 px-2 py-2 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 rounded-lg"
                    onclick=pesquisar()>Pesquisar</button>
                </div>

            </div>
            <div
                class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border" id="tabela">
                <div class="table-responsive py-3 px-3">
                    <table class="table table-flush text-slate-500 w-100" datatable id="datatable-search"
                        style="width: 100% !important">
                        <thead class="thead-light">
                            <tr>
                                <th class="centralizar">Produtos</th>
                                @foreach ($lojas as $loja)
                                    @if($loja->idLoja != 1)
                                        <th class="centralizar">{{ $loja->Nome }}</th>
                                    @endif
                                   
                                @endforeach

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>

</x-app-layout>
<script>
     var arrayPedido = ('<?php echo json_encode($arrayPedido); ?>');
</script>
<script src="{{ asset('js/listagemPedidos/index.js') }}"></script>
