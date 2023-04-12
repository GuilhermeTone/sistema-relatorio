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
            {{ __('Cadastrar Produtos') }}
        </h2>
    </x-slot>


    <body class="antialiased font-sans bg-gray-200">
        <div class="w-full max-w-full w-full shadow bg-white rounded mt-2">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="table-responsive py-3 px-3">
                    <table class="table table-flush text-slate-500" datatable id="datatable-search">
                        <thead class="thead-light">
                            <tr>
                                <th class="centralizar">idProduto</th>
                                <th class="centralizar">Nome</th>
                                <th class="centralizar">Tipo</th>
                                <th class="centralizar">Padrao</th>
                                <th class="centralizar">Ocultar</th>
                                <th class="centralizar">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>

@include('produtos.modals.modalEditar')

</x-app-layout>

<script>
    var produtos = ('<?php echo json_encode($produtos); ?>');
</script>
<script src="{{ asset('js/produtos/editar.js') }}"></script>
