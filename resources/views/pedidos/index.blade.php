<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Pedidos') }}
        </h2>
    </x-slot>


    <body class="antialiased font-sans bg-gray-200">
        <div class="w-full shadow bg-white rounded mt-2">
            <div class="border-gray-200 w-full rounded bg-white overflow-x-auto">
                @if(isset($mensagem))
                   
                   
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
                        <span class="font-medium">Sucesso,</span> Pedido cadastrado com sucesso
                    </div>
                    </div>
                   
                @endif
                <div class="flex justify-end">
                    <button type="button" style="width: 10rem; height:2rem; margin-right: 15px"
                        class="text-white bg-gray-800 mt-2 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-5 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 rounded-lg"
                        onclick="adicionaProduto()">Incluir produto</button>
                </div>
                <form method="POST" action="{{ route('cadastrarPedido') }}" onsubmit="desabilita()">
                    @csrf
                    <table class="w-full leading-normal ">
                        <thead
                            class="text-gray-600 text-xs font-semibold border-gray tracking-wider text-left px-5 py-3 bg-gray-100 uppercase border-b-2 border-gray-200">
                            <tr class="border-b border-gray">
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider bg-white text-center">

                                    Unidade de medida
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider bg-white text-center">
                                    <!---->
                                    Quantidade
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider bg-white text-center">

                                    Produtos
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider bg-white text-center">

                                    Ação
                                </th>
                            </tr>
                        </thead>
                        <tbody class="inputs-body">
                            <tr class="">
                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    <div class="flex items-center">
                                        <select id="unidade[0]" name="unidade[0]" required
                                            class="block w-full chosen-select px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="" selected disabled>Selecione a medida</option>
                                            <option value="kg">KG</option>
                                            <option value="cx">CX</option>
                                            <option value="unidade">Unidade</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    <x-text-input id="quantidade[0]" class="block mt-1 w-full quantidade" type="text"
                                        name="quantidade[0]" required />
                                </td>
                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    <div class="flex items-center">
                                        <select id="produto[0]" name="produto[0]" required
                                            class="block w-full chosen-select px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="" selected disabled>Selecione o produto</option>
                                            @foreach ($produtos as $produto)
                                                <option value="{{ $produto->idProduto }}">{{ $produto->Nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    <div class="flex items-center justify-center">
                                        <button type="button"
                                            style="width: 10rem; height:2rem; margin-right: 15px; background-color:rgb(151, 5, 5)"
                                            class="text-white focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-5 mb-2 rounded-lg"
                                            onclick="excluirproduto('0')">Excluir produto</button>
                                    </div>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" id="btnsubmitproduto" style="width: 10rem; height:2rem; margin-left: 15px"
                        class="text-white bg-gray-800 mt-2 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-5 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 rounded-lg">Salvar</button>
                </form>
            </div>
        </div>
    </body>


</x-app-layout>
<script>
    var produtos = ('<?php echo json_encode($produtos); ?>');
</script>
<script src="{{ asset('js/pedidos/index.js') }}"></script>
