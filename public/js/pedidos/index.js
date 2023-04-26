$(document).ready(function () {
    $('.quantidadeVerduras').mask('999999');
    $('.quantidadeFrutas').mask('999999');
    $('.quantidadeLegumes').mask('999999');
});
$('#formPedido').on('submit', function (event) {
    event.preventDefault();
    var form = $('#formPedido').get(0);
    console.log(form)
    if (form.checkValidity()) {
        swal({
            Title: "Atenção!",
            text: "Deseja realmente Enviar o Pedido",
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
                $('#formPedido').submit();
            }
        });
       
    } else {
        // Se o formulário for inválido, acione a validação
        form.reportValidity();
    }
    
});

// const frutasDiv = document.querySelector('.Frutas');
// const inputsFrutas = frutasDiv.querySelectorAll('.grid-cols-3 input[name^="quantidadeFrutas["]');

// inputsFrutas.forEach(input => {
//     input.addEventListener('keydown', (event) => {
//         if (event.key === 'Tab') {
//             event.preventDefault(); // impede o comportamento padrão do "Tab"
//             const nextInput = input.nextElementSibling; // obtém o próximo elemento abaixo
//             console.log(nextInput)
//             if (nextInput) {
//                 nextInput.focus({ preventScroll: true }); // define o foco no próximo elemento abaixo
//             }
//         }
//     });
// });