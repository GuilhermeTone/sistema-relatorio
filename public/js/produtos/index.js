$(document).ready(function () {
     $('.produto').mask('SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS');
    
});

var index = 1;
function adicionaProduto(){
    var html2 = '';
    html2 = '';
    var html = ` <tr class="produto-` + index +`">
                           
                            <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                <input id="produto[` + index +`]" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full produto" type="text" name="produto[` + index +`]"
                                    required />
                            </td>
                             <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                <div class="flex items-center">
                                    <select id="tipo[` + index +`]" name="tipo[` + index +`]" required
                                        class="block w-full px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected disabled>Selecion o Tipo</option>
                                            <option value="Legumes">Legumes</option>
                                            <option value="Verduras">Verduras</option>
                                            <option value="Frutas">Frutas</option>
                                    </select>
                                </div>
                            </td>
                            <td class="py-4 px-6 border-b border-gray-200 text-gray-900 text-sm ">
                                <div class="flex items-center justify-center">
                                    <button type="button" style="width: 10rem; height:2rem; margin-right: 15px; background-color:rgb(151, 5, 5)" class="text-white focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-5 mb-2 rounded-lg" onclick="excluirproduto('` + index +`')">Excluir produto</button>
                                </div>
                            </td>
                           
                        </tr>`
       
        // console.log('#produto['+ index + ']')
       
        $(".inputs-body").append(html);
        $('select[name="produto[' + index + ']"]').append(html2);
        index++
        
        $('.produto').mask('SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS');

       
}

function desabilita(){
    $('#btnsubmitproduto').prop('disabled', true)
}
function excluirproduto(index){
    $('tr[class="produto-' + index + '"]').remove();
}