<!-- Main modal -->
<div id="default-modal" aria-hidden="true"
    class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto">
        <!-- Modal content -->
        <div class="bg-white rounded-lg shadow relative dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-gray-900 text-xl lg:text-2xl font-semibold dark:text-white">
                    Editar Preço Produto
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="default-modal" id="fecharModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            {{-- <form method="POST" action="{{ route('editarPrecoProduto') }}" onsubmit="desabilita()">
            @csrf --}}
            <div class="p-6 space-y-6">
                <input type="hidden" name="idPrecoProduto" id="idPrecoProduto" required>
                    <div class="mt-4 flex">
                       <h4 class="text-2xl font-medium dark:text-white block text-gray-700" >Nome Produto:</h4><span class="text-2xl font-bold dark:text-white block text-gray-700 ml-2"   id="nomeProduto">Produto:</span>
                    </div>
                    <div class="mt-4 flex">
                       <h4 class="text-2xl font-medium dark:text-white block text-gray-700" >Tipo:</h4><span class="text-2xl font-bold dark:text-white block text-gray-700 ml-2"  id="tipoProduto">Tipo:</span>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="valorProduto" :value="__('Valor Produto')" required/>
                        <x-text-input id="valorProduto" class="block mt-3 w-full quantidadeVerduras" type="text"
                            name="valorProduto" />
                    </div>
    
            </div>
            
            <!-- Modal footer -->
            <div class="flex space-x-2 items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="submit" onclick="editarPrecoProduto()" style="width: 10rem; height:2rem; margin-left: 15px" class="text-white bg-gray-800 mt-2 hover:bg-gray-900 focus:outline-none focus:ring-4 mb-2 focus:ring-gray-300 font-medium text-sm px-5 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 rounded-lg">Salvar</button>
            </div>
            {{-- </form> --}}
        </div>
    </div>
</div>
