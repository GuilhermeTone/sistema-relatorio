
var tabela = jQuery('.table').DataTable({
    dom: 'Blfrtip',

    buttons: [
        {
            extend: "excel",
            text: "<i class=''></i> Download Excel",
        },
    ],

    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],

    columns: [
        {
            data: "idPrecoProduto",
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
            data: "tipoPreco",
            sClass: "text-center"
        },

        {
            data: "Valor",
            sClass: "text-center"
        },

        {
            data: function (row, type, val, meta) {

                var botoes = '';
                botoes += `
                    <button type="button" class="text-white bg-gray-800 mt-2 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-5 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 rounded-lg" data-modal-toggle="default-modal" style="width:150px; height: 35px;" onclick="editarPreco('`+ row["idPrecoProduto"] + `')">
                        <i class="fa fa-trash"></i>
                            Editar produto
                    </button>`
                    ;

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
    order: [[1, 'asc']],
});
$(document).ready(function () {
    
    tabela.rows.add(JSON.parse(precosProdutos)).draw()



});

function editarPreco(idPrecoProduto) {

    
    $('#valorProduto').val('');
    $('#idPrecoProduto').val('');
    $('#nomeProduto').empty();
    $('#tipoProduto').empty();

    $('#valorProduto').mask('#.##0,00', { reverse: true });

   

    $.ajax({
        type: `POST`,
        url: `${APP_URL}/listarinfoPreco`,
        data: {
            idPrecoProduto: idPrecoProduto,
            _token: TOKEN_CSRF,
        },
        success: (response) => {
            $('#idPrecoProduto').val(response[0].idPrecoProduto);
            $('#valorProduto').val(response[0].Valor);
            $('#nomeProduto').text(response[0].Nome);
            $('#tipoProduto').text(response[0].tipoPreco);

            $('#valorProduto').focus();
            
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
// function desabilita() {
//     $('#btnsubmit').prop('disabled', true);
// }
function editarPrecoProduto() {
    swal({
        Title: "Atenção!",
        text: "Deseja realmente editar o preço deste produto?",
        closeOnClickOutside: false,
        closeOnEsc: false,
        buttons: {
            cancel: {
                text: "Não!",
                value: false,
                visible: true,
                closeModal: true
            },
            confirm: {
                text: "Sim!",
                value: true,
                visible: true,
                className: "btn-primary",
                closeModal: true
            }
        }
    }).then((value) => {
        if (value) {
            $.ajax({
                type: `POST`,
                url: `${APP_URL}/editarPrecoProduto`,
                data: {
                    idPrecoProduto: $('#idPrecoProduto').val(),
                    ValorProduto: $('#valorProduto').val(),
                    _token: TOKEN_CSRF,
                },
                success: (response) => {
                    if (response) {
                        swal({
                            text: "Sucesso, Preço do produto editado",
                            icon: "success",
                            buttons: false,
                            timer: 2000
                        })
                        $('#fecharModal').trigger('click');
                        $('#default-modal').modal('hide');
                        pesquisar();
                        // location.reload()
                    } else {

                        swal({
                            text: 'Houve um erro interno',
                            icon: "error",
                            buttons: false,
                            timer: 2000

                        });
                    }

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

        } else {
            swal.close();
        }
    });
}
function pesquisar() {
    $.ajax({
        type: `POST`,
        url: `${APP_URL}/listarEditarPrecos`,
        data: {
            _token: TOKEN_CSRF,
        },
        success: (response) => {
            if (response) {
                tabela.clear().draw()
                tabela.rows.add(response).draw()
            }
        error: (error) => {
            swal({
                title: "Erro!",
                text: `Houve um erro interno`,
                icon: "error",
                timer: 1500,
                buttons: false,
            });
        }
        }
    })
}
function desabilita() {
    $('#btnsubmitproduto').prop('disabled', true);
}