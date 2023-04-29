
$(document).ready(function () {

    $('#tabela').hide();



});
var tabela = jQuery('.table').DataTable({

    "rowCallback": function (row, data, index) {
        $('td', row).css('border-top', '1px solid #ccc');
        $('td', row).css('border-left', '1px solid #ccc');
        $('td', row).css('border-bottom', '1px solid #ccc');
    },
    dom: 'Blfrtip',

    "pageLength": -1,

    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],

    buttons: [
        {
            extend: "excel",
            text: "<i class=''></i> Download Excel",
        },
    ],

    columns: [
        {

            data: "Nome",
            sClass: "text-center"

        },
        {
            data: "Quantidade",
            sClass: "text-center"
        },
        {
            data: "Unidade",
            sClass: "text-center"
        },
        {
            data: function (row, type, val, meta) {

                var input = '';
                var valorUnidade = row['Valor'].toFixed(2) / row['Quantidade'];
                input += `
                    <p>` + valorUnidade.toFixed(2)  +`</p>
                    `
                    ;

                return input;
            },
            sClass: "text-center",
        },
        {
            data: "Valor",
            sClass: "text-center",
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
// tabela.rows.add(JSON.parse(produtosPedido)).draw()

function pesquisar() {
    $('#tabela').hide();
    var dataPedido = $('#dataPedido').val();
    var idLoja = $('#loja').val();

    $.ajax({
        type: `POST`,
        url: `${APP_URL}/listarPedidosConfirmados`,
        data: {
            dataPedido: dataPedido,
            idLoja: idLoja,
            _token: TOKEN_CSRF,
        },
        success: (response) => {
            console.log(response);
            if (response.erro == 'semPedido') {
                swal({
                    title: "Erro!",
                    text: `Não há pedidos confirmados nesta loja no dia selecionado`,
                    icon: "error",
                    timer: 1500,
                    buttons: false,
                });

            } else {
                tabela.clear();
                tabela.rows.add(response.Pedidos).draw()

                var valorTotal = response.ValorTotal[0].ValorTotal;
                var novaLinha = '<tr><th class="centralizar">Valor Total Pedido:</th><th></th><th></th><th></th><th class="centralizar">' + valorTotal + '</th></tr>';

                var tfoot = $('.table').find('tfoot');
                tfoot.empty();
                tfoot.append(novaLinha);
                tabela.draw();
                $('#tabela').show();

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
}

function imprimir() {

    printJS({
        printable: 'datatable-search',
        type: 'html',
        // header: 'Exemplo de tabela impressa com print.js',
        style: 'table {border-collapse: collapse; width: 100%;} th, td {border: 1px solid black; padding: 0px; font-size:12px; text-align:center}',
    });
}