<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Produtos') }}
        </h2>
    </x-slot>

    <div class="">

        <body class="antialiased font-sans bg-gray-200">
            <div class="w-full shadow bg-white rounded">
                <div class="border-gray-200 w-full rounded bg-white overflow-x-auto">
                    <table class="w-full leading-normal ">
                        <thead
                            class="text-gray-600 text-xs font-semibold border-gray tracking-wider text-left px-5 py-3 bg-gray-100 hover:cursor-pointer uppercase border-b-2 border-gray-200">
                            <tr class="border-b border-gray">
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                  
                                    Unidade
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    
                                    Produto
                                </th>
                                <th scope="col"
                                    class="text-gray-dark border-gray border-b-2 border-t-2 border-gray-200 py-3 px-3 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    <!---->
                                    Quantidade
                                </th>
                            </tr>
                        </thead>
                        <tbody class="inputs-body">
                            <tr class="hover:bg-gray-100 hover:cursor-pointer">
                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    <div class="flex items-center" classes="[object Object]">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img src="https://faces.design/faces/m/m11.png" alt=""
                                                class="w-full h-full rounded-full" />
                                        </div>
                                       <select id="cargo" name="cargo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option selected disabled>Selecione o cargo</option>
                                            <option value="admin">Administrador</option>
                                            <option value="gerente">Gerente</option>
                                            <option value="secretaria">Secretaria</option>
                                            <option value="quantificador">Quantificador</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    <x-text-input id="unidade[0]" class="block mt-1 w-full" type="text" name="unidade[0]" required />
                                </td>
                                <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                    <x-text-input id="unidade[0]" class="block mt-1 w-full" type="text" name="unidade[0]" required />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </body>
    </div>

</x-app-layout>
