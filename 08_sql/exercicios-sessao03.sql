USE loja_informatica;

-- Qual a cidade correspondente ao código postal 8500?
/*
SELECT cod_postal, cidade
FROM cidades
WHERE cod_postal = '8500';
*/
-- correcção:
/*
SELECT * FROM cidades WHERE cod_postal = 8500;
*/


-- O preço do produto mais caro?
/*
SELECT designacao, preco
FROM produtos
WHERE preco = (
	SELECT MAX(preco)
    FROM produtos
);
*/
-- correcção:
SELECT MAX(preco) AS preco_mais_caro FROM produtos;
SELECT preco AS preco_mais_caro FROM produtos ORDER BY preco DESC LIMIT 1;


-- Todos os produtos da categoria 2?
/*
SELECT designacao, id_categoria
FROM produtos
WHERE id_categoria = '2';
*/
-- correcção:
SELECT * FROM produtos WHERE id_categoria = 2;


-- Todos os clientes com “Oliveira” no nome?
/*
SELECT nome
FROM clientes
WHERE nome LIKE '%Oliveira%';
*/
-- correcção:
SELECT * FROM clientes WHERE nome LIKE '%oliveira%';


-- Todos os produtos existentes com a respectiva categoria.
/*
SELECT designacao, id_categoria
FROM produtos;
*/
-- correcção:
SELECT 
    p.id,
    p.designacao AS nome,
    c.designacao AS categoria
FROM produtos p
LEFT JOIN categorias c ON p.id_categoria = c.id;


-- O número de facturas por cada cliente?
-- correcção:
SELECT 
    f.id_cliente,
    c.nome, 
    COUNT(*) AS numero_faturas 
FROM facturas f
JOIN clientes c ON f.id_cliente = c.id 
GROUP BY id_cliente;


-- Os 5 produtos mais caros.
/*
SELECT designacao, preco
FROM produtos
ORDER BY preco DESC
LIMIT 5;
*/
-- correcção:
SELECT id, designacao, preco 
FROM produtos 
ORDER BY preco DESC 
LIMIT 5;


-- Todos os produtos comprados pelo cliente 5.
-- correcção:
SELECT DISTINCT p.*
FROM produtos p
JOIN linhas_de_factura ldf ON p.id = ldf.id_produto
JOIN facturas f ON f.id = ldf.id_factura
WHERE f.id_cliente = 5
ORDER BY p.id;


-- Todos os produtos da categoria 2 comprados pelo cliente 5.
-- correcção:
SELECT DISTINCT p.*
FROM produtos p
JOIN linhas_de_factura ldf ON p.id = ldf.id_produto
JOIN facturas f ON f.id = ldf.id_factura
WHERE 
    f.id_cliente = 5 AND
    p.id_categoria = 2 
ORDER BY p.id;


-- O dinheiro total gasto por cada cliente *
-- correcção:
SELECT
    f.id_cliente,
    c.nome,
    ROUND(SUM(valor), 2) AS total_gasto
FROM linhas_de_factura ldf
JOIN facturas f ON ldf.id_factura = f.id
JOIN clientes c ON f.id_cliente = c.id
GROUP BY f.id_cliente;

-- ou:

SELECT
    id_cliente,
    ROUND(SUM(total), 2) AS total_gasto
FROM (
    SELECT
        f.id_cliente,
        ROUND(SUM(ldf.valor), 2) AS total
    FROM facturas f
    JOIN linhas_de_factura ldf ON ldf.id_factura = f.id
    GROUP BY ldf.id_factura
) AS total_faturas
GROUP BY id_cliente;

-- A cidade que dá mais lucro *
-- correcção:
SELECT
    c.cidade,
    ROUND(SUM(ldf.valor), 2) AS lucro
FROM cidades c
JOIN clientes cl ON c.cod_postal = cl.cod_postal
JOIN facturas f ON f.id_cliente = cl.id
JOIN linhas_de_factura ldf ON ldf.id_factura = f.id
GROUP BY cl.cod_postal
ORDER BY lucro DESC
LIMIT 1;

-- Os 10 produtos mais vendidos.
/*unir total de quantidade por cada id_produto, ordenar asc, limitar a 10*/
/*
SELECT id_produto, quantidade
FROM linhas_de_factura
LIMIT 10;
*/
-- correcção:
SELECT
    p.id,
    p.designacao,
    COUNT(*) AS numero_vendas
FROM linhas_de_factura ldf
JOIN produtos p ON p.id = ldf.id_produto
GROUP BY ldf.id_produto
ORDER BY numero_vendas DESC
LIMIT 10;


-- A data e valor total pago por cada factura.
-- correcção:
SELECT
    f.*,
    -- ROUND(SUM(ldf.valor * ldf.quantidade), 2) AS total
    ROUND(SUM(ldf.valor), 2) AS total
FROM facturas f
JOIN linhas_de_factura ldf ON f.id = ldf.id_factura
GROUP BY ldf.id_factura;

-- A media de preços por categoria.
-- correcção:
SELECT 
    c.designacao AS categoria,
    ROUND(AVG(preco), 2) AS media_preco
FROM produtos p
JOIN categorias c ON p.id_categoria = c.id
GROUP BY id_categoria;

-- As facturas com menos de 5 produtos.
/*
SELECT id_factura, quantidade
FROM linhas_de_factura
WHERE quantidade <= '5';
*/
-- correcção:
SELECT
    id_factura,
    COUNT(*) AS total_produtos,
    SUM(quantidade) AS quantidade_produtos
FROM linhas_de_factura
GROUP BY id_factura
HAVING total_produtos < 5;
-- Os produtos que possuem “RAM” na descrição.
/*
SELECT id, designacao, descricao
FROM produtos
WHERE descricao LIKE '%ram%';
*/
-- correcção:
SELECT * FROM produtos WHERE descricao LIKE "%ram%";