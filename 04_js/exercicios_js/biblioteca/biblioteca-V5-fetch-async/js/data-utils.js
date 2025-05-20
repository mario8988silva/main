
//import {livros} from './data.js';

//let myBooks = [...livros];
//faz-se uma array vazia, a modos de preparar a chamada a partir da API
let myBooks = [];

// CRIAR EVENTO PERSONALIZADO:
const booksLoaded = new Event('booksLoaded'); //faz uma variavel que cria um novo evento
/*
const booksLoaded = new CustomEvent(
    'booksLoaded'), {detail: 
        {nome: 'joao',
        books: myBooks,
        }}
); //
*/

// CHAMADA ENDPOINT DA API :
fetch('https://my-json-server.typicode.com/JoaoGoncalves/biblio-api/books')
    .then( resp => resp.json())
    .then( data => myBooks = [...data]) // aqui faz com os conteudos da api sejam transpostos actualizando a variavel, em forma de array;
    .then( () => dispatchEvent(booksLoaded)) // chama a variavel que criámos
    .catch( (err) => console.log('ocorreu um erro: ', err));

/// metodo ler TODOS os livros
export const getBooks = () => myBooks;

// metodo para mostrar livros ja LIDOS
export const getReadBooks = () => myBooks.filter( livro => livro.alreadyRead === true);

// metodo para mostrar livros POR LER
export const getNotReadBooks = () => myBooks.filter( livro => livro.alreadyRead === false);

// metodo para mostrar livros por TITULO
/*
const getBooksByTitle = () => livros.filter( livro => myBooks.title === x});
*/

/*
const getBooksByAuthor = () => myBooks.filter( livro => livro.author === x});
*/

// PESQUISA POR TITULO :
// const getBooksByTitle = (text) => myBooks.filter( livro => livro.title.toLowerCase().search(text) > -1);
// ou, para evitar linhas demasiado compridas, fazer em bloco:
export const getBooksByTitle = (text) => myBooks.filter (livro => {
    let title = livro.title.toLowerCase();
    return title.search(text) > -1
});


// PESQUISA POR AUTOR :
export const getBooksByAuthor = (text) => myBooks.filter (livro => {
    let title = livro.author.toLowerCase();
    return title.search(text) > -1
});

/*
const getBooksByTitleAndAuthor = (text) => livros.filter (livro => {
    let title = livro.title.toLowerCase() || livro.author.toLowerCase();
    return title.search(text) > -1
});
*/

// para pesquisarmos dois parametros dentro do object, metemos as filtragens dentro para que ele trabahe os dois, depois, o OU fuca no return
export const getBooksByTitleAndAuthor = (text) => myBooks.filter( livro => {
    let title = livro.title.toLowerCase();
    let author = livro.author.toLowerCase();

    return (author.search(text) > -1 ) || (title.search(text) > -1 )
});


// ******************************************** //

/*
// se encontra algo no xp, devolve o numero da array onde encontra. caso nao encontre/coincida, devolve -1. daí metermos -1 nos return das constantes
let texto = 'ola mundo cruel';
console.log(texto.search('xp'));
*/

// DELETE DO BOOK POR ID :
export const deleteBook = (id) => myBooks = myBooks.filter( livro => livro.id !== Number(id));

// ACRESCENTAR UM LIVRO :
export const addBook = (book) => {
    myBooks.push(book);
    return myBooks;
};

// SELECCIONAR LIVRO POR ID :
export const getBookById = (id) => myBooks.find( b => b.id === Number(id));

// ACTUALIZAR UM LIVRO :
export const updateBooks = book => myBooks = myBooks.map ( b => {
    if ( b.id == book.id){
        return{
            ...b,
            title : book.title,
            author : book.author,
            alreadyRead : book.alreadyRead,
            imageUrl : book.imageUrl,
            imageUrlGr : book.imageUrlGr,
        }
    } else {
        return b;
    }
})



