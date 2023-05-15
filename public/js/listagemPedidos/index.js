
$(document).ready(function () {

    $('#tabela').hide();



});
var colunas = [];
$.each(JSON.parse(arrayPedido), function (indexInArray, valueOfElement) {
    
    if (valueOfElement != "Quantidade_Loja1"){
        colunas.push({
            data: valueOfElement,
            sClass: "esquerda",
        });
    }
    
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

    columns: colunas,

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
    var tipo = $('#tipo').val();
    
    $.ajax({
        type: `POST`,
        url: `${APP_URL}/listarPedido`,
        data: {
            dataPedido: dataPedido,
            tipo: tipo,
            _token: TOKEN_CSRF,
        },
        success: (response) => {
            console.log(response);
            if (response.erro == 'semPedido') {
                swal({
                    title: "Erro!",
                    text: `Não há pedidos no dia selecionado`,
                    icon: "error",
                    timer: 1500,
                    buttons: false,
                });

            }else{
                console.log(response)
                tabela.clear()
                tabela.columns(colunas)
                tabela.rows.add(response.produtosPedido).draw()
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
    
    var dataPedido = $('#dataPedido').val();
    var componentesData = dataPedido.split("-");

    // Reorganize os componentes da data
    var dataFormatada = componentesData[2] + "/" + componentesData[1] + "/" + componentesData[0];
    printJS({
        printable: 'datatable-search',
        type: 'html',
        documentTitle: dataFormatada,
        style: 'table {border-collapse: collapse; width: 50% !important; margin: 0 auto;text-align: center;} th, td {border: 1px solid black; padding: 0px; margin: 0px; font-size:10px; text-align:center} body { text-align: center; }',
    });
}
