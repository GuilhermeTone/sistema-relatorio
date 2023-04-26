
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
        {
            text: 'Preencher Tabela',
            action: function () {
                // Chame a função Ajax para buscar os valores do banco de dados
                $.ajax({
                    url: `${APP_URL}/inserirValores`,
                    data: {
                        _token: TOKEN_CSRF,
                    },
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        for (var i = 0; i < response.length; i++) {
                            

                            // percorre as linhas da tabela
                            tabela.rows().every(function (rowIdx, tableLoop, rowLoop) {
                                var produto = response[i].Nome;
                                var tipoPreco = response[i].tipoPreco;
                                var valor = response[i].Valor;
                                var data = this.data();
                                var rowNode = this.node();
                                var rowIndex = tabela.row(rowNode).index();

                                // verifica se a linha corresponde ao produto e tipo do banco de dados
                                if (data.Nome === produto && data.Unidade === tipoPreco) {

                                    var Quantidade = $(rowNode).find('.Quantidade').val();

                                    valor = valor * Quantidade;
                                    
                                    $(rowNode).find('.Valor').val(valor.toFixed(2));
                                }
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        }
    ],

    columns:[
        {

            data: "Nome",
            sClass: "text-center"

        },
        {
            data: function (row, type, val, meta) {

                var input = '';
                input += `
                    <input type="hidden" id="idProduto[` + meta.row + `]" name="idProduto[` + meta.row + `]" value="` + row['idProduto'] + `">
                    <input type="hidden" id="idPedido[` + meta.row + `]" name="idPedido[` + meta.row + `]" value="` + row['idPedido'] + `">
                    <input type="hidden" id="Unidade[` + meta.row + `]" name="Unidade[` + meta.row + `]" value="` + row['Unidade'] + `">
                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full Quantidade" id="Quantidade[` + meta.row + `]" type="text" name="Quantidade[` + meta.row + `]" maxlength="6" value="` + row['Quantidade'] + `" required>
                    `
                    ;

                return input;
            },
            sClass: "text-center",
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
            data: function (row, type, val, meta) {

                var input = '';
                input += `
                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full Valor" id="Valor[` + meta.row + `]" type="text" name="Valor[` + meta.row + `]" maxlength="6" value="" required>
                    `
                    ;

                return input;
            },
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
    var tipo = $('#tipo').val();

    $.ajax({
        type: `POST`,
        url: `${APP_URL}/listarPedidoPosCompra`,
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

            } else {
                console.log(response)
                tabela.clear();
                tabela.rows.add(response.produtosPedido).draw()
                $('.Valor').mask('#.##0,00', { reverse: true });
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
$('#formposcompra').on('submit', function (event) {
    event.preventDefault();
    var form = $('#formposcompra').get(0);
    console.log(form)
    if (form.checkValidity()) {
        swal({
            Title: "Atenção!",
            text: "Deseja realmente confirmar o pedido",
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
                $('#formposcompra').submit();
            }
        });

    } else {
        // Se o formulário for inválido, acione a validação
        form.reportValidity();
    }

});