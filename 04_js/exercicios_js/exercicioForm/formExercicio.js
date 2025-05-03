/*
1 - esconder o form, e deixar visivel somente o botao NewItem
2 - Ao clicar no botao NewItem mostrar o form e esconder o botao
3 - escrevendo um novo produto e clicando no boto "Add", acrescentar novo item á lista, voltar a esconder o form e mostrar botao NovoItem
4 - ao clicar num item, verificar se tem a class 'complete', se tiver eliminar o item, senao aplicar a class complete, e mover para o final da lista
5 - apresentar no H2, inserindo dentro de uma tag <span> o numero de items por comprar
6- depois de apagar se fizer ctrl->Z , repoe o item eliminado
*/
// const CLICK = 'click' // faz uma constante com uma função que pode ser usada ao longo do código;

// Variáveis Globais :
let newItemForm = document.getElementById('newItemForm');
let newItemButton = document.getElementById('newItemButton');
let showForm = document.getElementById('showForm');
let itemDescription = document.getElementById('itemDescription');
let ul = document.querySelector('ul');
let h2 = document.querySelector('h2');
let deletedItem = null;


// 1 - esconder o form, e deixar visivel somente o botao NewItem :
newItemForm.className = 'hide';
newItemButton.className = 'show';


// definir o business logic, 5:
actualizarNumItems();


// definir eventos :
showForm.addEventListener('click', mostrarForm, false); // 2
newItemForm.addEventListener('submit', acrescentarItem, false); // 3
ul.addEventListener('click', removerItem, false); // 4
document.addEventListener('keydown', reporItem, false) // 6

//definir listeners :
// 2 :
function mostrarForm(){
    newItemForm.className = 'show';
    newItemButton.className = 'hide';
    itemDescription.focus();
}

// 3:

function acrescentarItem(event){
    let novoItem = document.createElement('li'); // faz uma li
    novoItem.textContent = itemDescription.value; // o valor que estiver no campo de input, é adicionado para dentro da li
    ul.prepend(novoItem); // adiciona essa li para dentro da ul    

    newItemForm.className = 'hide';
    newItemButton.className = 'show';

    itemDescription.value = '';
    
    // 5
    actualizarNumItems();

    event.preventDefault();
};


// 4:
function removerItem(event){
    let item = event.target;

    if(item.className === 'complete'){
        deletedItem = item;
        item.remove();
    } else {
        item.className = 'complete';
        ul.append(item);
    }

    //5
    actualizarNumItems();
};

// 5: 
function actualizarNumItems(){
    let numItems = ul.querySelectorAll('li:not(.complete)').length;
    h2.innerHTML = `
    Buy Groceries <span> ${numItems} </span>`;
};

// 6:
function reporItem(event){
    //console.log(event);
    if (deletedItem && 
        (
            (event.ctrlKey && event.key === 'z') 
            || 
            (event.metaKey && event.key === 'z')
        )
    ){
        ul.prepend(deletedItem);
        deletedItem = null;
    }
};
