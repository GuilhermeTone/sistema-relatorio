$(document).ready(function () {
    $('.produto').mask('#.##0,00', { reverse: true });
});

function desabilita() {
    $('#btnsubmitprecos').prop('disabled', true)
}