$(document).ready(function () {
    $('.quantidadeVerduras').mask('999999');
    $('.quantidadeFrutas').mask('999999');
    $('.quantidadeLegumes').mask('999999');
});
function desabilita(){
    $('#btnsubmitpedido').prop('disabled', true);
}