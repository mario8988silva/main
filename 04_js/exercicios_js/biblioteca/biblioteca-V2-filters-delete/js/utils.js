/*  Bilioteca-2
 1 - acrescentar uma seccao,  de filtros, para poder filtrar por ja lidos, nao lidos, todos, e por titulo ou autor do livro
 2 - dentro de cada card, acrescentar um botao de delete, para apagar o respectivo livro
 3 - ao clicar no thumbnail mostrar popup
*/


/// metodo ler TODOS os livros
const getBooks = () => livros;

// metodo para mostrar livros ja LIDOS
const getReadBooks = () => livros.filter( livro => livro.alreadyRead === true);

// metodo para mostrar livros POR LER
const getNotReadBooks = () => livros.filter( livro => livro.alreadyRead === false);

// metodo para mostrar livros por TITULO
/*
const getBooksByTitle = () => livros.filter( livro => livro.title === x});
*/

/*
const getBooksByAuthor = () => livros.filter( livro => livro.author === x});
*/

// filtros :
const getFilters = () => filters;

// PESQUISA POR TITULO :
// const getBooksByTitle = (text) => livros.filter( livro => livro.title.toLowerCase().search(text) > -1);
// ou, para evitar linhas demasiado compridas, fazer em bloco:
const getBooksByTitle = (text) => livros.filter (livro => {
    let title = livro.title.toLowerCase();
    return title.search(text) > -1
});


// PESQUISA POR AUTOR :
const getBooksByAuthor = (text) => livros.filter (livro => {
    let title = livro.author.toLowerCase();
    return title.search(text) > -1
});

/*
const getBooksByTitleAndAuthor = (text) => livros.filter (livro => {
    let title = livro.title.toLowerCase() || livro.author.toLowerCase();
    return title.search(text) > -1
});
*/

// para pesquisarmos dois parametros dentro do object, metemos as filtragens dentro para que ele trabahe os dois, depois, o OU fica no return
const getBooksByTitleAndAuthor = (text) => livros.filter( livro => {
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

const deleteBook = (id) => livros = livros.filter( livro => livro.id !== Number(id));