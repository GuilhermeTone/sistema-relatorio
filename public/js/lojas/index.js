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
                data: "idLoja",
                sClass: "text-center"
            },
            {
                data: "Nome",
                sClass: "text-center"
            },

            {
                data: function (row, type, val, meta) {

                    var botoes = '';
                    botoes += `
                    <button type="button" class="text-white bg-gray-800 mt-2 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-5 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 rounded-lg" data-modal-toggle="default-modal" style="width:150px; height: 35px;" onclick="editarLoja('`+ row["idLoja"] + `')">
                        <i class="fa fa-trash"></i>
                            Editar produto
                    </button><br>
                    <button type="button" class="text-white bg-red-800 mt-2 hover:bg-red-900 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium text-sm px-5 mb-2 dark:bg-red-800 dark:hover:bg-red-700 dark:focus:ring-red-700 dark:border-red-700 rounded-lg" style="width:150px; height: 35px;" onclick="excluirLoja('`+ row["idLoja"] + `')">
                        <i class="fa fa-trash"></i>
                            Excluir produto
                    </button><br>`
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
    });
    tabela.rows.add(JSON.parse(lojas)).draw()



});
function editarLoja(idLoja) {

    $('#idLoja').val('');
    $('#Nome').val('');

    $.ajax({
        type: `POST`,
        url: `http://127.0.0.1:8000/listaLoja`,
        data: {
            idLoja: idLoja,
            _token: TOKEN_CSRF,
        },
        success: (response) => {
            $('#idLoja').val(idLoja);
            $('#Nome').val(response[0].Nome);
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
function desabilita() {
    $('#btnsubmit').prop('disabled', true);
}
function excluirLoja(idLoja){
    swal({
        Title: "Atenção!",
        text: "Deseja realmente excluir a Loja?",
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
                url: `http://127.0.0.1:8000/excluirLoja`,
                data: {
                    idLoja: idLoja,
                    _token: TOKEN_CSRF,
                },
                success: (response) => {
                    if (response) {
                        swal({
                            text: "Sucesso, Loja deletado",
                            icon: "success",
                            buttons: false,
                            timer: 2000
                        })
                        location.reload();
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