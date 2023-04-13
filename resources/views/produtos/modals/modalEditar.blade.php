<!-- Main modal -->
<div id="default-modal" aria-hidden="true"
    class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
        <!-- Modal content -->
        <div class="bg-white rounded-lg shadow relative dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-gray-900 text-xl lg:text-2xl font-semibold dark:text-white">
                    Editar Produto
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="default-modal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="{{ route('editarProduto') }}" onsubmit="desabilita()">
            @csrf
            <div class="p-6 space-y-6">
                <input type="hidden" name="idProduto" id="idProduto" required>
                    <div class="mt-4">
                        <x-input-label for="Produto" :value="__('Produto')" required/>
                        <x-text-input id="Produto" class="block mt-3 w-full quantidadeVerduras" type="text"
                            name="Produto" />
                    </div>
                    
                    <div class="mt-4">
                        <x-input-label for="tipo" :value="__('Tipo')" />
                        <select id="tipo" name="tipo" required
                            class="block w-full px-4 mt-3 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected disabled>Selecion o Tipo</option>
                            <option value="Legumes">Legumes</option>
                            <option value="Verduras">Verduras</option>
                            <option value="Frutas">Frutas</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="unidade" :value="__('Padrao')" />
                        <select id="unidade" name="unidade" required
                            class="block w-full text-base text-gray-900 border mt-3 border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="Caixa">Caixa</option>
                            <option value="Unidade">Unidade</option>
                            <option value="Saco">Saco</option>
                            <option value="Maco">Maço</option>
                            <option value="Kilo">Kilo</option>
                        </select>
                     </div>
                     <div class="mt-4">
                        <x-input-label for="ocultar" :value="__('Ocultar')" />
                        <select id="ocultar" name="ocultar" required
                            class="block w-full text-base text-gray-900 border mt-3 border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="S">Sim</option>
                            <option value="N">Não</option>
                        </select>
                     </div>

            </div>
            
            <!-- Modal footer -->
            <div class="flex space-x-2 items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" id="btnsubmit" style="width: 10rem; height:2rem; margin-left: 15px" class="text-white bg-gray-800 mt-2 hover:bg-gray-900 focus:outline-none focus:ring-4 mb-2 focus:ring-gray-300 font-medium text-sm px-5 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 rounded-lg">Salvar</button>
            </div>
            </form>
        </div>
    </div>
</div>
