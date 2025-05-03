
inicio
    inteiro x
    inteiro y
    inteiro z
    
    escrever "Insira valor X: "
        ler x
    escrever "Insira valor Y: "
        ler y
    
    se x >= y entao
        z <- x - y
        
        senao
        z <- y - x
    fimse
        
    escrever "A diferença é de: ", z
fim
