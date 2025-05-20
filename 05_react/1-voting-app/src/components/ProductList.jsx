import Product from "./Product";
import {products} from '../seeds';
import { useState } from "react";


function ProductList(){

    // prods é o initial state; setProds é a actualização do state
    const[prods, setProds] = useState (products);
    const [descendent, setDescendent] = useState(false); // fazemos um booleano para definir a visualização de valores de forma ascendente ou descendente, metemos enquanto falso, por defeito

    //
    const handleProductVote = (id, vote) => {
        console.log(`Foi votado o producto com id: ${id}`);

        const updatedProducts = prods.map( p => {
            // caso o id do produto for igual a 
            if(p.id === id){
                
                return{...p, votes: p.votes + vote} //chama todos os conteudos de p e disponibiliza-os como estão. quando ao valor de votes, incrementa o valor de vote
            } else {
                // caso contrário, retorna o produto tal como está
                return p;
            }
        })

        setProds(updatedProducts); // faz variável para disponibilizar os conteudos actualizados
    }

    const changeSort = () => {
            setDescendent(!descendent)
    }

    /*
    const handleProductDownVote = (id) => {
        console.log(`Foi votado o producto com id: ${id}`);

        const updateProducts = prods.map( p => {
            // caso o id do produto for igual a 
            if(p.id === id){
                // retorna todos os valores dentro do produto tal como estão, aquele valor de votes, decrementa menos um
                return{...p, votes: p.votes - 1}

            } else {
                // caso contrário, retorna o produto tal como está
                return p;
            }
        })

        setProds(updatedProducts);
    }
    */

    // 
    const sortedProducts = prods.sort((a,b) => (descendent ? (a.votes - b.votes) : (b.votes - a.votes)));

    const productComponents = sortedProducts.map( product => (
        <Product 
                /* {...product} */
                key = {'prod-'+product.id}
                id = {product.id}
                title = {product.title}
                description = {product.description}
                url = {product.url}
                votes = {product.votes}
                productImageUrl = {product.productImageUrl}
                submitterAvatarUrl = {product.submitterAvatarUrl}
                /*
                changeUpVote = {handleProductUpVote}
                changeDownVote = {handleProductDownVote}
                */
               changeVote = {handleProductVote}
            />
    ));

    // extrai os conteúdos:
    return (
        <section className="ui unstackable items">
            <button onClick={changeSort}>UP / DOWN</button>
            {productComponents}
        </section>
    );
}

export default ProductList;