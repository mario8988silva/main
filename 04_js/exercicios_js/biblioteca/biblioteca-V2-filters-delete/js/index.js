
console.log(livros); // verifica array de livros;
console.log(filters); // verifica array de filtros;

// DEFINIÇÃO DAS VARIÁVEIS LOCAIS : 
//let grid = document.querySelector('section.grid');
let body = document.getElementsByTagName('body');
let filterContainer = document.getElementById('filterContainer');
let searchContainer = document.getElementById('searchContainer');
let grid = document.getElementById('grid');




// LIVROS : 
//showBooks(livros);
showBooks(getBooks());
//showBooks(getReadBooks());
//showBooks(getNotReadBooks());

// FILTERS :
/*
showFilters(getFilters());
*/

// traduz para HTML os conteúdos da Array data.js > Filters :
/*
function showFilters(arrayFilters){
    arrayFilters.map( filters => {
        filterContainer.innerHTML += `
            <button class="btn filter" id="filter ${filters.value}">${filters.value}</button>
        `;  
    })
}
*/

// EVENTOS DA APLICAÇÃO :
filterContainer.addEventListener('click', filterEvents, false);
searchContainer.addEventListener('input', searchEvents, false);
grid.addEventListener('click', gridEvents, false);


// LISTENERS :
//qualquer conteudo aqui dentro clicado, tem resposta. estas liinhas atalham bastante em termos de codigo, pois nao necessita de um codgigo de reposta para cada um dos elementos:
function filterEvents(e){
    let el = e.target;    
    

    if (el.id == 'allBtn'){
        showBooks(getBooks());
    }

    if (el.id == 'readBtn'){
        showBooks(getReadBooks());
    }

    if (el.id === 'notReadBtn'){
        showBooks(getNotReadBooks());
    }

    console.log(e.target.id);
}

function searchEvents(e){
    let el = e.target;
    /*
    if ((el.id === 'searchTxt') && (e.type === 'input')){
        let text = el.value.toLowerCase();
        showBooks ( getBooksByTitle ( text ) )
    };
    */
    
    if ((el.id === 'searchTxt') && (e.type === 'input')){
        let text = el.value.toLowerCase();
        showBooks ( getBooksByTitleAndAuthor ( text ));
    }
   
    
    console.log(e.target.id);
}

// FILTROS ALREADY READ + DELETE
function gridEvents(e){
    console.log(e);

    if ((e.target.nodeName === 'P') && (e.target.textContent.search('✅') > -1)  ){
        showBooks(getReadBooks());
    }

    if ((e.target.nodeName === 'P') && (e.target.textContent.search('❌') > -1)  ){
        showBooks(getNotReadBooks());
    }

    if (e.target.dataset.type === 'deleteBtn'){
        showBooks(deleteBook(e.target.dataset.idbook))
    }   
    
    /*/
    if (e.target.id === 'bookCover'){
        console.log(e.target.id);

        arrayBooks.map( book => {
            grid.innerHTML += `
                <picture class="imgContainer" id="imgContainer">
                <img src="livros/angularGr.png" alt="nome" class="imgBig" id="imgBig">
                </picture>
            `;
        })
    }
    */

}




// traduz para HTML os conteúdos da Array data.js > Livros :
function showBooks(arrayBooks){

    // serve para limpar a grid, a modos de aplicar a filtragem :
    grid.innerHTML = '';

    // faz o layout de cad uma das cards :
    arrayBooks.map( book => {
        grid.innerHTML += `
            <article>
                <h1>${book.title}</h1>
                <h2>${book.author}</h2>
                <!-- id deveria ser o nome do ficheiro da imagem, sem a extensão -->
                <img src="livros/${book.imageUrl}" alt="${book.title}" class="bookCover" id="bookCover">
                <p class="alreadyRead">Already read: ${book.alreadyRead ? '✅' : '❌' }  </p>
                <!-- insere um botão para eliminar a devida card -->
                <button class="btn del" id="del" data-type='deleteBtn' data-idbook=${book.id}>Delete</button>
                <button class="btn edit" id="edit" data-type='editBtn' data-idbook=${book.id}>Edit</button>
            </article>
        `;
    })
}

// faz picture:
/*
// function para remover parte do nome do ficheiro da imagem:
function coverName(arrayBooks){}
arrayBooks.map( book => {
    let name = book.imageUrl.slice(0,-4);
});
*/

/*
// faz container + imagem: o nome do ficheiro terá de aproveitar o nome do ficheiro da imagem pequena até ao .jpg, acrescendo Gr.png
function popUp(){
    innerHTML = `
        <picture class="imgContainer" id="imgContainer">
        <img src="livros/${coverName}Gr.png" alt="nome" class="imgBig" id="imgBig">
        </picture>
    `
*/



