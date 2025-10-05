INSERT INTO medicos (nome, cedula, email)
VALUES
	('Zebedeu Silva', '008', 'zebedeu.silva@example.com'),
    ('Maria Oliveira', '009', 'maria@example.com'),
    ('Serafim Costa', '010', 'serafim@example.com'),
    ('Isabel das Dores', '011', 'isabel@example.com');
    
UPDATE medicos
SET 
	-- email = 'dores@example.com',
    cedula = concat(cedula, '-2025')
WHERE id >= 11 AND id < 15;

DELETE FROM medicos WHERE id = 15;
    
SELECT id, nome FROM medicos WHERE id = 1;

SELECT * FROM medicos WHERE nome LIKE 'jo__ velez';

SELECT * FROM medicos WHERE criado_em BETWEEN '2025-09-03 00:00:00' AND '2025-09-03 23:59:59';

SELECT * FROM medicos;
SELECT id, nome FROM medicos;
SELECT * FROM medicos WHERE nome NOT LIKE '%maria%';
SELECT * FROM medicos WHERE nome LIKE '%silva';