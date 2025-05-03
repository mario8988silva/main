/*
1 - esconder o form, e deixar visivel somente o botao NewItem
2 - Ao clicar no botao NewItem mostrar o form e esconder o botao
3 - escrevendo um novo produto e clicando no boto "Add", acrescentar novo item á lista, voltar a esconder o form e mostrar botao NovoItem
4 - ao clicar num item, verificar se tem a class 'complete', se tiver eliminar o item, senao aplicar a class complete, e mover para o final da lista
5 - apresentar no H2, inserindo dentro de uma tag <span> o numero de items por comprar
6- depois de apagar se fizer ctrl->Z , repoe o item eliminado
*/


// 1 - esconder o form, e deixar visivel somente o botao NewItem:
let newItemForm = document.getElementById('newItemForm');

newItemForm.style.visibility = "hidden";


//2 - Ao clicar no botao NewItem mostrar o form e esconder o botao:

let newItemButton = document.getElementById('newItemButton');

showForm.addEventListener('click', hiddesButton, false);

function hiddesButton(){
    newItemButton.style.visibility = "hidden";
    newItemForm.style.visibility = "visible";
}

// 3 - escrevendo um novo produto e clicando no boto "Add", acrescentar novo item á lista, voltar a esconder o form e mostrar botao NovoItem:

let addButton = document.getElementById('addButton');

addButton.addEventListener('click', addToList, false);

function addToList(){
    newItemButton.style.visibility = "visible";
    newItemForm.style.visibility = "hidden";
}