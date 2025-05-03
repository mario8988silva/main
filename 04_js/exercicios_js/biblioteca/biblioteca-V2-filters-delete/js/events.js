// FILTRAR CARDS :
// aproveitando os conteúdos do ficheiro utils.js
/*
const buttonTest = document.querySelector('#filter');
buttonTest.addEventListener('click', filterTest, false);
function filterTest (event){
    console.log(event)
};
*/

// ELIMINAR CARD :

// APENAS AFECTA A PRIMEIRA CARD...
let buttonDelete = document.querySelector('#del');
buttonDelete.addEventListener('click', deleteCard, false);

function deleteCard (event){ 
    let itemAEliminar = event.target.parentElement;
    itemAEliminar.remove();

    console.log(event.target);
}

/*
// com ajuda do chat gpt:
let removeButtons = document.querySelectorAll('#del');
removeButtons.forEach(button => {
    button.addEventListener('click', function() {
      const card = this.closest('article');
      if (card) {
        const confirmDelete = confirm("Tem a certeza que deseja remover este livro da sua biblioteca?");
        if (confirmDelete) {
            card.remove();
        }
      }
    });
  });
*/
/*
// POP-UP IMAGE:
let imgBig = document.getElementById('imgBig');
let img = document.getElementById('bookcover');

imgBig.addEventListener('click', popUp, false);
img.addEventListener('click', popUp, false);

function popUp (event) {
    let opens = imgContainer.style.display = 'flex';
}
*/