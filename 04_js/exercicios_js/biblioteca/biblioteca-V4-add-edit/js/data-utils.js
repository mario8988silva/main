

let myBooks = [...livros];

/// metodo ler TODOS os livros
const getBooks = () => myBooks;

// metodo para mostrar livros ja LIDOS
const getReadBooks = () => myBooks.filter( livro => livro.alreadyRead === true);

// metodo para mostrar livros POR LER
const getNotReadBooks = () => myBooks.filter( livro => livro.alreadyRead === false);

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
const getBooksByTitle = (text) => myBooks.filter (livro => {
    let title = livro.title.toLowerCase();
    return title.search(text) > -1
});


// PESQUISA POR AUTOR :
const getBooksByAuthor = (text) => myBooks.filter (livro => {
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
const getBooksByTitleAndAuthor = (text) => myBooks.filter( livro => {
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
const deleteBook = (id) => myBooks = myBooks.filter( livro => livro.id !== Number(id));

// ACRESCENTAR UM LIVRO :
const addBook = (book) => {
    myBooks.push(book);
    return myBooks;
};

// SELECCIONAR LIVRO POR ID :
const getBookById = (id) => myBooks.find( b => b.id === Number(id));

// ACTUALIZAR UM LIVRO :
const updateBooks = book => myBooks = myBooks.map ( b => {
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



