<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Cadastrar Pedidos') }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{"Hoje é " . date("d/m/Y")}}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{$Loja[0]->Nome}}
            </h2>
        </div>
    </x-slot>


    <body class="antialiased font-sans bg-gray-200">
        <div class="w-full shadow bg-white rounded mt-2">
            <div class="border-gray-200 w-full rounded bg-white overflow-x-auto">
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
                            {{$mensagem}}
                        </div>
                    </div>
                @endif
                <form method="POST" id="formPedido" action="{{ route('cadastrarPedido') }}">
                    @csrf
                    <div class="grid lg:grid-cols-3 gap-4 mt-2">
                        <div class="grid-rows-1 justify-center Frutas">
                            <div class="flex justify-center">Frutas - F1</div>
                            <div class="grid grid-cols-3 mt-3">
                                <div class="flex justify-center">
                                    <div class="flex justify-center">Produto</div>
                                </div>
                                 <div class="flex justify-center">
                                    <div class="flex justify-center">Quantidade</div>
                                </div>
                                 <div class="flex justify-center">
                                    <div class="flex justify-center">Volume</div>
                                </div>
                            </div>
                            @foreach ($Frutas as $key => $value)
                                <input type="hidden" id="idProdutoFrutas[{{$key}}]" name="idProdutoFrutas[{{$key}}]" value="{{$value->idProduto}}">
                                <div class="grid grid-cols-3 mt-3">
                                    <div class="flex justify-center">
                                        <div class="flex justify-center items-center">{{$value->Nome}}</div>
                                    </div>
                                    <div class="flex justify-center">
                                        <div class="flex justify-center">
                                            <x-text-input id="quantidadeFrutas[{{$key}}]" class="block mt-1 w-full quantidadeFrutas" tabindex="{{(int)$key + 1}}" type="text" name="quantidadeFrutas[{{$key}}]" />
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <div class="flex justify-center">
                                            <select id="unidadeFrutas[{{$key}}]" name="unidadeFrutas[{{$key}}]" class="block w-full text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="{{ $value->Padrao}}">{{ ($value->Padrao == 'Caixa') ? 'CX' : (($value->Padrao == 'Unidade') ? 'UN' : (($value->Padrao == 'Saco') ? 'SC' : (($value->Padrao == 'Maco') ? 'MC' : 'Kg')))}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                       <div class="grid-rows-1 justify-center Legumes">
                            <div class="flex justify-center">Legumes - F2</div>
                            <div class="grid grid-cols-3 mt-3">
                                <div class="flex justify-center">
                                    <div class="flex justify-center">Produto</div>
                                </div>
                                 <div class="flex justify-center">
                                    <div class="flex justify-center">Quantidade</div>
                                </div>
                                 <div class="flex justify-center">
                                    <div class="flex justify-center">Volume</div>
                                </div>
                            </div>
                            @foreach ($Legumes as $key => $value)
                                <input type="hidden" id="idProdutoLegumes[{{$key}}]" name="idProdutoLegumes[{{$key}}]" value="{{$value->idProduto}}">
                                <div class="grid grid-cols-3 mt-3">
                                    <div class="flex justify-center">
                                        <div class="flex justify-center items-center">{{$value->Nome}}</div>
                                    </div>
                                    <div class="flex justify-center">
                                        <div class="flex justify-center">
                                            <x-text-input id="quantidadeLegumes[{{$key}}]" class="block mt-1 w-full quantidadeLegumes" tabindex="{{(int)$key + 10000}}" type="text" name="quantidadeLegumes[{{$key}}]" />
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <div class="flex justify-center">
                                            <select id="unidadeLegumes[{{$key}}]" name="unidadeLegumes[{{$key}}]" class="block w-full text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="{{ $value->Padrao}}">{{ ($value->Padrao == 'Caixa') ? 'CX' : (($value->Padrao == 'Unidade') ? 'UN' : (($value->Padrao == 'Saco') ? 'SC' : (($value->Padrao == 'Maco') ? 'MC' : 'Kg')))}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                       <div class="grid-rows-1 justify-center Verduras">
                            <div class="flex justify-center">Verduras - F2</div>
                            <div class="grid grid-cols-3 mt-3">
                                <div class="flex justify-center">
                                    <div class="flex justify-center">Produto</div>
                                </div>
                                 <div class="flex justify-center">
                                    <div class="flex justify-center">Quantidade</div>
                                </div>
                                 <div class="flex justify-center">
                                    <div class="flex justify-center">Volume</div>
                                </div>
                            </div>
                            @foreach ($Verduras as $key => $value)
                                <input type="hidden" id="idProdutoVerduras[{{$key}}]" name="idProdutoVerduras[{{$key}}]" value="{{$value->idProduto}}">
                                <div class="grid grid-cols-3 mt-3">
                                    <div class="flex justify-center">
                                        <div class="flex justify-center items-center">{{$value->Nome}}</div>
                                    </div>
                                    <div class="flex justify-center">
                                        <div class="flex justify-center">
                                            <x-text-input id="quantidadeVerduras[{{$key}}]" class="block mt-1 w-full quantidadeVerduras" tabindex="{{(int)$key + 20000}}" type="text" name="quantidadeVerduras[{{$key}}]" />
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <div class="flex justify-center">
                                            <select id="unidadeVerduras[{{$key}}]" name="unidadeVerduras[{{$key}}]" class="block w-full text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option value="{{ $value->Padrao}}">{{ ($value->Padrao == 'Caixa') ? 'CX' : (($value->Padrao == 'Unidade') ? 'UN' : (($value->Padrao == 'Saco') ? 'SC' : (($value->Padrao == 'Maco') ? 'MC' : 'Kg')))}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="px-5 md:w-2/12">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-first-name">
                        Coloque a data do pedido
                    </label>
                     <input id="dataPedido" type="date" name="dataPedido" value="{{date('Y-m-d')}}"
                        class="block w-full text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                        <button type="submit" id="btnsubmitpedido" style="width: 10rem; height:2rem; margin-left: 15px" onclick="desabilita()"
                    
                        class="text-white bg-gray-800 mt-2 hover:bg-gray-900 focus:outline-none focus:ring-4 mb-2 focus:ring-gray-300 font-medium text-sm px-5 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 rounded-lg">Salvar</button>
                </form>
            </div>
        </div>
    </body>

</x-app-layout>

<script src="{{ asset('js/pedidos/index.js') }}"></script>
