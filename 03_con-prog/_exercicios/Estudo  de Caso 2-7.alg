inicio

    inteiro nota_1
    inteiro nota_2
    inteiro soma
    inteiro media
    
     escrever "Insira a primeira nota: "
    ler nota_1
    
    escrever "Insira a segunda nota: "
    ler nota_2
    
//  soma <- nota_1 + nota_2  
//  escrever  "* A soma é ", soma,"       "
    
//  media <- soma / 2 
//  escrever "* A média é ", media, " *"
    
    escolhe media
        caso "media <- < 4" :
            escrever "Chumba"
            
        caso "media <- >= 4 ou < 7" :
            escrever "Repete"
            
        caso "media <- > 7" :
            escrever "Passa"           

    fimescolhe
fim
