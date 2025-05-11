//utilizar os novos metodos de arrays para iterar a array de objectos, usar destructuring para a criação (mapeamento) de variaveis.

//usar um json dos posts do randomuser, ir buscar aleatoriamente 30 users (https://randomuser.me/api/?results=30),
fetch ('https://randomuser.me/api/?results=30')
    .then(response => response.json())
    //apresentar numa pagina somente os users "femininos",
    // feito com ajuda do chatgtpt: estava a tentar fazer a chamada de todos e só depois a filtragem. além de complicar, dava-me erro.
    .then(data => {femaleUsers = data.results.filter(user => user.gender === 'female');
        mostrarUsers(femaleUsers);
    })
    .catch(() => console.log('Ocorreu um erro de comunicação'));


    function mostrarUsers(users) {
        console.log(users);
        //criando uma lista de de posts formatados, como "Cards", que deverão incluir:
        //imagem do avatar
        //nome completo
        //email 
        //telephone
        //cidade, com indicação da "timezone"
        users.map(user => {
            let{picture:{medium}, name:{title, first, last}, email, phone, location:{city, state, timezone:{offset}}} = user;

            main.innerHTML += `
                <article>            
                    <img src="${medium}" alt="">
                    <h1>${title} ${first} ${last}</h1>
                    <address>
                        <a href="mailto${email}">${email}</a>
                        <br>
                        <a href="tel${phone}">Contact: ${phone}</a>
                        <p>City: ${city}, ${state}</p>
                        <p>GMT: ${offset}</p>
                    </address>
                </article>
            `
        })
      }  

    
       
 

    
    

