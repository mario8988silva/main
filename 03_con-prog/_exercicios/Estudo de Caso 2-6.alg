
inicio
    inteiro num_alunos <- 0
    real nota
    real soma_notas
    real media_notas
    
    escrever "Quantos alunos existem na turma? "
        ler num_alunos
    
    enquanto num_alunos >= 1 faz
        escrever "x"
        ler nota
        ler soma_notas <- nota + soma_notas
    fimenquanto
    
    media_notas <- soma_notas / num_alunos
    escrever "A média de notas desta turma é ", media_notas
fim
