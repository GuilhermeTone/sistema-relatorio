$(document).ready(function () {
    var tabela = jQuery('.table').DataTable({
        dom: 'Blfrtip',

        buttons: [
            {
                extend: "excel",
                text: "<i class=''></i> Download Excel",
            },
        ],

        columns: [
            {
                data: "idProduto",
                sClass: "text-center"
            },
            {
                data: "Nome",
                sClass: "text-center"
            },

            {
                data: "Tipos",
                sClass: "text-center"
            },

            {
                data: "Padrao",
                sClass: "text-center"
            },
            {
                data: function (row, type, val, meta) {
                    
                    if(row['Ocultar'] == 'N'){
                        return 'Não';
                    }else{
                        return 'Sim';
                    }
                },
                sClass: "text-center"
            },
            {
                data: function (row, type, val, meta) {
                    
                    var botoes = '';
                    botoes += `
                    <button type="button" class="text-white bg-gray-800 mt-2 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-5 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 rounded-lg" data-modal-toggle="default-modal" style="width:150px; height: 35px;" onclick="editarProduto('`+ row["idProduto"] +`')">
                        <i class="fa fa-trash"></i>
                            Editar produto
                    </button><br>`;

                    return botoes;
                },
                sClass: "text-center"
            },
        ],

        language: {
            "lengthMenu": "Exibindo _MENU_ linhas por página",
            "sInfo": "Mostrando _START_ até _END_ de _TOTAL_ registros.",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "zeroRecords": "Nenhum registro encontrado",
            "info": "Exibindo página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro encontrado",
            "infoFiltered": "(filtrando  de _MAX_ linhas)",
            "search": "Filtro geral:",
            "loadingRecords": "Carregando ...",
        paginate: {
                "first": "Primeiro",
                "last": "Ultimo",
                "next": "Próximo",
                "previous": "Anterior"
            },
        },
    });
    tabela.rows.add(JSON.parse(produtos)).draw()


    
});

function editarProduto(idProduto){

    $('#idProduto').val('');
    $('#Produto').val('');
    $('#tipo').val('');
    $('#unidade').val('');
    
     $.ajax({
        type: `POST`,
        url: `http://localhost:8000/listarinfoProduto`,
        data: {
            idProduto: idProduto,
            _token: TOKEN_CSRF,
        },
        success: (response) => {
            $('#idProduto').val(idProduto);
            $('#Produto').val(response[0].Nome);
            $('#tipo').val(response[0].Tipos);
            $('#unidade').val(response[0].Padrao);
            $('#ocultar').val(response[0].Ocultar);
        },
        error: (error) => {
            swal({
                title: "Erro!",
                text: `Houve um erro interno`,
                icon: "error",
                timer: 1500,
                buttons: false,
            });
        }
    })

}
function desabilita(){
    $('#btnsubmit').prop('disabled', true);
}