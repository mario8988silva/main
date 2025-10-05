USE hospital;



-- Mostrar a especialidade com mais médicos:
/*
SELECT * FROM medicos;
SELECT especialidades.designacao, COUNT(especialidades_dos_medicos.id_medico) AS total_medicos
FROM especialidades
JOIN especialidades_dos_medicos ON especialidades.id = especialidades_dos_medicos.id_especialidade
GROUP BY especialidades.designacao
ORDER BY total_medicos DESC
LIMIT 1;
*/
-- CORRECÇÃO:
SELECT
	especialidade_id,
    COUNT (*) AS total_medicos
FROM medicos
GROUP BY esoecialidade_id
ORDER BY total_medicos DESC
LIMIT 1;

/*
-- Mostrar as especialidades com média de idades > 45:
-- seleccionar tabela médicos, criar uma coluna de formato data-nascimento random, ver idade de cada um; chamar a tabela especialidades_dos_medicos, acrescentar coluna com media da idade em cada especialidade, apresentar apenas aqueles que sejam superiores a 45
SELECT nome, criado_em, timestampdiff(YEAR, criado_em, CURDATE()) AS tempo_carreira
FROM medicos;
*/
-- CALCULAR A IDADE:
SELECT nome, timestampdiff(YEAR. data_nascimento, CURDATE()) as idade FROM X;

SELECT 
	especialidade_id,
    FLOOR(AVG(TIMESTAMPDIFF(YEAR, data_nascimento, CURDATE()));
	
/*
-- Mostrar os 3 médicos mais novos:
SELECT id, nome, data_nascimento, timestampdiff(YEAR, data_nascimento, CURDATE()) AS idade 
FROM medicos
ORDER BY data_nascimento DESC
LIMIT 3;
*/

-- Mostrar o total de médicos com mais de 10 anos de diferença em relação ao mais novo:
SELECT MAX(data_nascimento) 
FROM medicos
WHERE
	TIMESTAMDIFF(
		YEAR, 
        data_nascimento,
        (SELECT MAX(data_nascimento) FROM medicos)
	) > 10;


-- Mostrar quantos médicos têm o nome a começar por “Dr.”:
SELECT COUNT(*) AS TOTAL
FROM medicos
WHERE nome REGEXP '^(Dr\\.|Dra\\.)';