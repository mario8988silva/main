import Book from "./Book"

export default function BookList({books, deleteBook}) { // ao invés de props, e em baixo o resto. aqui fazemos o destructuring "books" a modos de poupar escrita de código

    return(
        <section className="grid">
            {
                books.map( b => <Book key={b.id} book={b} deleteBook={deleteBook}/>) // por cada livro que tira da lista ( b ) transforma num Book; key={b.id} serve para dar uma identificação a cada novo livro gerado, bebendo do id que cada um já contém na lista; faz variável book por cada b gerado;
            }
        </section>
    );
}