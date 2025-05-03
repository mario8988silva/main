
inicio

    inteiro alunos
    escrever "Quantos Alunos?"
    ler alunos
    
    real soma_notas <- 0
    real nota <- 0
    inteiro contandor <- 1
    
    repete
        escrever "Indique a nota do aluno", contandor, ": "
        ler nota
        soma_notas <- soma_notas + nota
        contador <- contador + 1
    ate contador > alunos
    
    escrever "A média da turma é de : ", soma_notas / alunos
        
fim
