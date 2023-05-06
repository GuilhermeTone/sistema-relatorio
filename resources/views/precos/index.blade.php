<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Preços') }}
        </h2>
    </x-slot>


    <body class="antialiased font-sans bg-gray-200">
        <div class="w-full shadow bg-white rounded mt-2">
            <div class="border-gray-200 w-full rounded bg-white overflow-x-auto">
                @if (isset($retornos))
                    <div class="flex p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                        role="alert">
                        <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            @foreach ($retornos as $retorno)
                                <p class="font-medium">{{ $retorno }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
                <form method="POST" action="{{ route('cadastrarPrecos') }}" onsubmit="desabilita()">
                    @csrf
                    <table class="w-full leading-normal ">
                        <thead
                            class="text-gray-600 text-xs font-semibold border-gray tracking-wider text-left px-5 py-3 bg-gray-100 uppercase border-b-2 border-gray-200">
                            <tr class="border-b border-gray">
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider bg-white text-center">

                                    Produto
                                </th>
                                <th scope="row"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider bg-white text-center">
                                    <!---->
                                    Valor por unidade
                                </th>
                            </tr>
                        </thead>
                        <tbody class="inputs-body">
                            @foreach ($produtos as $index => $produto)
                                <tr class="">
                                    <input type="hidden" id="idProduto[{{ $index }}]"
                                        name="idProduto[{{ $index }}]" value="{{ $produto->idProduto }}">
                                    <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                        <p
                                            class="text-gray-dark py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider bg-white text-center">
                                            {{ $produto->Nome }}</p>
                                    </td>

                                    <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm">
                                        <div class="flex justify-evenly">
                                        <x-text-input class="valorProduto" id="valorProduto[Caixa][{{ $index }}]"
                                            class="block mt-1 produto" type="text"
                                            name="valorProduto[Caixa][{{ $index }}]" placeholder="Caixa" />
                                        <x-text-input class="valorProduto"
                                            id="valorProduto[Unidade][{{ $index }}]"
                                            class="block mt-1 produto" type="text"
                                            name="valorProduto[Unidade][{{ $index }}]" placeholder="Unidade" />
                                        <x-text-input class="valorProduto" id="valorProduto[Saco][{{ $index }}]"
                                            placeholder="Maço" class="block mt-1 produto" type="text"
                                            name="valorProduto[Saco][{{ $index }}]" placeholder="Saco" />
                                        <x-text-input class="valorProduto" id="valorProduto[Maco][{{ $index }}]"
                                            class="block mt-1 produto" type="text"
                                            name="valorProduto[Maco][{{ $index }}]" placeholder="Maço" />
                                        <x-text-input class="valorProduto" id="valorProduto[Kilo][{{ $index }}]"
                                            class="block mt-1 produto" type="text"
                                            name="valorProduto[Kilo][{{ $index }}]" placeholder="Kilo" />
                                            </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" id="btnsubmitprecos" style="width: 10rem; height:2rem; margin-left: 15px"
                        class="text-white bg-gray-800 mt-2 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-5 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 rounded-lg">Salvar</button>
                </form>
            </div>
        </div>
    </body>


</x-app-layout>
<script src="{{ asset('js/precos/index.js') }}"></script>
