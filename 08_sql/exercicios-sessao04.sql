## 🏥 Parte 2 — Hospital Central
-- ### Desafios
use hospital;

-- #### 🟢 Nível Básico
-- 1. 👩‍⚕️ Listar todos os pacientes com nome e data de nascimento.
select nome, data_nascimento
from pacientes;

-- 2. 🩺 Selecionar os médicos que estão ativos.
select nome, ativo
from medicos;

-- 3. 🚺 Encontrar todos os pacientes do género feminino.
select nome
from pacientes
where genero like 'f';

-- 4. 📜 Listar as especialidades disponíveis, ordenadas por nome.
select nome
from especialidades
order by nome asc;

-- 5. 📅 Mostrar todas as consultas realizadas após `2024-01-01`, ordenadas pela data.
select *
from consultas
where data_consulta >= '2024-01-01'
order by data_consulta asc;

 
-- #### 🟡 Nível Intermédio
-- 1. 🤝 Obter a lista de consultas com o nome do paciente e do médico.
select
	c.id as consulta_id,
    p.nome as paciente,
    m.nome as medico,
    c.data_consulta,
    c.motivo
from consultas c
join pacientes p on c.paciente_id = p.id
join medicos m on c.medico_id = m.id
order by c.data_consulta desc;

-- 2. 📊 Contar o número de pacientes por género.
select *
from pacientes
order by genero;

select 
	count(id) as total_genero,
    genero
from pacientes
group by genero;	

-- 3. 🏆 Mostrar os médicos com mais de 10 consultas realizadas.
/*
select
    c.medico_id as c_mid,
    m.id as m_id,
    m.nome as medico
from 
	consultas c,
    medicos m
join medicos m on m.medico_id = c_mid
where c_mid >= 10;
*/

-- correcção:
SELECT 
    m.id AS medico_id,
    m.nome AS medico,
    COUNT(c.id) AS total_consultas
FROM 
    medicos m
JOIN 
    consultas c ON m.id = c.medico_id
GROUP BY 
    m.id, m.nome
HAVING 
    COUNT(c.id) > 10
ORDER BY 
    total_consultas DESC;
    
-- 4. 🔍 Listar os pacientes cujo nome começa por “Jo”.
select id, nome
from pacientes
where nome like 'Jo%';

-- 5. 🏥 Listar os departamentos que tenham internamentos.
select *
from departamentos, internamentos
where motivo like '%internamento%';

-- 6. 📈 Para cada especialidade, mostrar quantos médicos existem e o número total de consultas realizadas.
-- correcção:
SELECT 
    e.nome,
    COUNT(DISTINCT m.id) AS total_medicos,
    COUNT(c.id) AS total_consultas
FROM 
    especialidades e
JOIN 
    medicos m ON m.especialidade_id = e.id
LEFT JOIN 
    consultas c ON c.medico_id = m.id
GROUP BY 
    e.nome
ORDER BY 
    total_consultas DESC;


-- 7. ❤️‍🩹 Encontrar pacientes que tiveram consultas em Cardiologia ou Neurologia.
-- correcção:
SELECT 
	DISTINCT p.nome AS paciente,
    e.nome AS especialidade
FROM 
    consultas c
JOIN medicos m ON c.medico_id = m.id
JOIN especialidades e ON m.especialidade_id = e.id
join pacientes p on c.paciente_id = p.id
where e.nome in ('cardiologia', 'neurologia');

 
-- #### 📊 Agregações e Cálculos
-- 1. 🧾 Calcular o total de consultas por paciente.
SELECT 
	DISTINCT p.nome AS paciente,
    COUNT(c.id) AS total_consultas
from consultas c
JOIN pacientes p ON c.paciente_id = p.id
group by p.nome
order by total_consultas;

-- 2. 📉 Obter a média, mínimo e máximo de consultas por médico.
-- 3. 💰 Calcular o total faturado por paciente e a média por consulta.
-- 4. 🏥 Contar o número de pacientes por departamento onde tiveram internamento.
-- 5. 📊 Calcular a percentagem de médicos ativos por especialidade.
-- 6. ⏳ Determinar a duração média de internamentos por departamento.
-- 7. 🧪 Listar o total de exames por tipo e quantos foram positivos.
-- 8. 💵 Mostrar os médicos com maior receita através de prescrições.
-- 9. 📈 Identificar pacientes com mais consultas do que a média geral.
-- 10. 🗓️ Mostrar o número de consultas por mês no último ano.
-- 
-- #### 🔴 Nível Avançado
-- 1. 🚫 Listar pacientes que nunca tiveram internamentos.
-- 2. 🕵️ Encontrar médicos com consultas agendadas mas sem prescrições.
-- 3. 📅 Para cada paciente, mostrar a última consulta realizada.
-- 4. 🧮 Criar um CTE que conte as consultas por paciente e filtrar os que têm mais de 3.
-- 5. 🏷️ Mostrar, numa lista de faturas, o estado “Pago” ou “Em dívida” usando `CASE`.
-- 6. 🔍 Listar os pacientes que têm pelo menos um exame com resultado contendo “positivo”.
-- 