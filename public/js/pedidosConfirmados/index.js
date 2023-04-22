
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
            data: "NomeLoja",
            sClass: "text-center"
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

    $.ajax({
        type: `POST`,
        url: `${APP_URL}/listarPedidosConfirmados`,
        data: {
            dataPedido: dataPedido,
            _token: TOKEN_CSRF,
        },
        success: (response) => {
            console.log(response);
            if (response.erro == 'semPedido') {
                swal({
                    title: "Erro!",
                    text: `Não há pedidos não confirmados no dia selecionado`,
                    icon: "error",
                    timer: 1500,
                    buttons: false,
                });

            } else {
                tabela.clear();
                tabela.rows.add(response).draw()
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
    // // Cria uma variável que contém a tabela
    // var tabela = document.getElementById('datatable-search');

    // // Salva o HTML da tabela em uma variável
    // var tabela_html = tabela.outerHTML;

    // // Abre uma nova janela com o HTML da tabela
    // var nova_janela = window.open('', 'Imprimir Tabela');

    // // Escreve o HTML da tabela na nova janela
    // nova_janela.document.write('<html><head><title>Imprimir Tabela</title></head><body>');
    // nova_janela.document.write(tabela_html);
    // nova_janela.document.write('</body></html>');

    // // Fecha o documento atual
    // nova_janela.document.close();

    // // Espera a janela ser carregada e imprime a tabela
    // setTimeout(function () {
    //     nova_janela.print();
    //     nova_janela.close();
    // }, 1000);
    printJS({
        printable: 'datatable-search',
        type: 'html',
        // header: 'Exemplo de tabela impressa com print.js',
        style: 'table {border-collapse: collapse; width: 100%;} th, td {border: 1px solid black; padding: 0px; font-size:12px; text-align:center}',
    });
}