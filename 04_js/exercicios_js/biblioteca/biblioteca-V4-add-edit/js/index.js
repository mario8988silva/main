

// DEFINIÇÃO DAS VARIÁVEIS LOCAIS : 
//let grid = document.querySelector('section.grid');
//let body = document.getElementsByTagName('body');
//let filterContainer = document.getElementById('filterContainer');
//let searchContainer = document.getElementById('searchContainer');
let filters = document.getElementById('filters');
let grid = document.getElementById('grid');
let popup = document.getElementById('popup');

console.log(livros); // verifica array de livros;
console.log(filters); // verifica array de filtros;
console.log(grid); // verifica cards;


//DEFINIR AS VARIÁVEIS DO FORMULÁRIO :
let addEditForm = document.querySelector('.addEditForm');
let form = addEditForm.querySelector('form');
let title = form.title;
let author = form.author;
let alreadyRead = form.alreadyRead;
let imageUrl = form.imageUrl;
let imageUrlGr = form.imageUrlGr;
let selectedBook;
let addBookBtn = document.querySelector('#addBookBtn');
let updateBookBtn = document.querySelector('#updateBookBtn');


// LIVROS : 
//showBooks(livros);

//showBooks(getReadBooks());
//showBooks(getNotReadBooks());

// EVENTOS DA APLICAÇÃO :
//filterContainer.addEventListener('click', filterEvents, false);
//searchContainer.addEventListener('input', searchEvents, false);
filters.addEventListener('click', filterEvents, false);
filters.addEventListener('input', filterEvents, false);
grid.addEventListener('click', gridEvents, false);
popup.addEventListener('click', closePopup, false);


// SUBMIT DO FORM :
addBookBtn.addEventListener('click', addBookForm, false);
updateBookBtn.addEventListener('click', updateBookForm, false);


// LISTENERS :
//qualquer conteudo aqui dentro clicado, tem resposta. estas liinhas atalham bastante em termos de codigo, pois nao necessita de um codgigo de reposta para cada um dos elementos:
/*
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
*/

// MELHORIA:
function filterEvents( {target:{id, value}, type} ){

    if (id == 'allBtn'){
        showBooks(getBooks());
    }

    if (id == 'readBtn'){
        showBooks(getReadBooks());
    }

    if (id === 'notReadBtn'){
        showBooks(getNotReadBooks());
    }

    if ((id === 'searchTxt') && (type === 'input')){
        let text = value.toLowerCase();
        showBooks(getBooksByTitleAndAuthor(text))
    }

    if( id === 'showForm'){
        form.reset();
        addEditForm.classList.toggle('open');
        addBookBtn.classList.remove('hide');
        updateBookBtn.classList.add('hide');
        addEditForm.classList.remove('softGreen');
    }

    console.log(id);
}
/*
function searchEvents(e){
    let el = e.target;
    /*
    if ((el.id === 'searchTxt') && (e.type === 'input')){
        let text = el.value.toLowerCase();
        showBooks ( getBooksByTitle ( text ) )
    };
    *//*
    
    if ((el.id === 'searchTxt') && (e.type === 'input')){
        let text = el.value.toLowerCase();
        showBooks ( getBooksByTitleAndAuthor ( text ));
    }
    
    console.log(e.target.id);
}
*/
// FILTROS ALREADY READ + DELETE
/*
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

    if (e.target.dataset.type === 'thumbnail'){
        showPopup(e.target.dataset.popup)
    }

    if (e.target.dataset.type === 'popup'){
        closePopup(e.target.dataset.popup)
    }
}
*/
// MELHORIA:
function gridEvents( {target:{nodeName, textContent, dataset:{type, popup, idbook}}} ){

    if ((nodeName === 'P') && (textContent.search('✅') > -1)  ){
        showBooks(getReadBooks());
    }

    if ((nodeName === 'P') && (textContent.search('❌') > -1)  ){
        showBooks(getNotReadBooks());
    }

    if (type === 'deleteBtn'){
        showBooks(deleteBook(idbook))
    }   

    if (type === 'thumbnail'){
        showPopup(popup)
    }

    if( type === 'editBtn'){
        fillBookForm(idbook);

        form.reset();
        addEditForm.classList.add('softGreen');
        addBookBtn.classList.add('hide');
        updateBookBtn.classList.remove('hide');
    }
}

function addBookForm (e){
    let id = Date.now();
    let book = new Book(id, title.value, author.value, alreadyRead.checked, imageUrl.value, imageUrlGr.value);

    console.log(book);
    showBooks(addBook(book));
    form.reset();

    e.preventDefault();
    addEditForm.classList.remove('open');
}

function fillBookForm(id) {
    
    addEditForm.classList.add('open');

    selectedBook = getBookById(id);
    let {title: editTitle, author: editAuthor, alreadyRead: editAlreadyread, imageUrl: editimageUrl, imageUrlGr:editimageUrlGr} = selectedBook;

    title.value = editTitle;
    author.value = editAuthor;
    alreadyRead.checked = editAlreadyread;
    imageUrl.value = editimageUrl;
    imageUrlGr.value = editimageUrlGr;
}

function updateBookForm(e){
    
    let updatedBook = {
        id : selectedBook.id,
        title: title.value,
        author: author.value,
        alreadyRead: alreadyRead.checked,
        imageUrl: imageUrl.value,
        imageUrlGr: imageUrlGr.value,
    }

    showBooks(updateBooks(updatedBook));
    form.reset();
    // fechar o form conforme finaliza a actualização;
    addEditForm.classList.remove('open');
    addEditForm.classList.remove('softGreen');

    e.preventDefault();
}

// BUSINESS LOGIC :
showBooks(getBooks());

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
                <img src="livros/${book.imageUrl}" 
                    alt="${book.title}" 
                    data-type='thumbnail' 
                    data-popup='livros/${book.imageUrlGr}'>
                <p class="alreadyRead">Already read: ${book.alreadyRead ? '✅' : '❌' }  </p>
                <!-- insere um botão para eliminar a devida card -->
                <button class="btn del" id="del" data-type='deleteBtn' data-idbook=${book.id}>Delete</button>
                <button class="btn edit" id="editBtn" data-type='editBtn' data-idbook=${book.id}>Edit</button>
            </article>
        `;
    })
}

