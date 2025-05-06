/*
A FAZER:
    > cards têm apenas background image;
    > quando mouse hover, atenua background e mostra type; 
    > ao clicar, type muda de cor;

    > associar cada um dos botões a modos de fazer efeito de filtro mediante os conteúdos da array;

    > acrescentar os restantes conteúdos, devidamente preenchidos;

    > fazer algo quanto aos botões, algo que mencione que o botão está activo ou não quando tem mouse:hover;
*/
// definição de variáveis locais:
const btn = document.querySelectorAll(".btn");
const navigator_container = document.getElementById("navigator_container");

document.getElementById('buttons_container').addEventListener('click', filterEvents, false);

// definição de eventos:
// ACTIVA CADA UM DOS BOTÕES:
btn.forEach(btn => {
    btn.addEventListener("click", () => {
        // MUDA A COR DO BOTÃO MEDIANTE CLIQUE:
        btn.classList.toggle("active");
        console.log(btn.textContent);
    });
});

// definição de funções:

// filtragem:
function filterEvents( {target:{id}}){

    if ( id == 'btnHTML'){
        showExercises(getHTMLExercises());
        console.log('btnHTML confirm');       
    }    

    if ( id == 'btnCSS'){
        showExercises(getCssExercises());
        console.log('btnCSS confirm');       
    }
}

showExercises(getExercises());

// fazer cards:
/*
exercises.forEach(ex => {
    const a = document.createElement("a");
    a.href = ex.urlLink;
    a.target = "_blank";
    a.className = "card";
    a.id = `card-${ex.id}`; // optional for unique card ID

    // Set the background image for each card dynamically
    a.style.backgroundImage = `url(${ex.imageLink})`;
    a.style.backgroundSize = "cover"; // Ensure the image covers the whole card
    a.style.backgroundPosition = "center"; // Center the image

    const p = document.createElement("p");
    p.textContent = ex.name;

    // Append the text (name) to the card
    a.appendChild(p);

    // Append the card to the container
    navigator_container.appendChild(a);
});
*/

function showExercises(arrayExercises){

    navigator_container.innerHTML = '';

    arrayExercises.map ( exe => {
        navigator_container.innerHTML += `
            <a 
            href="${exe.urlLink}" 
            target="_blank" 
            class="card" 
            id="card-${exe.id}"
            style="background-image: url(${exe.imageLink});">
                <p>${exe.name}</p>
            </a>
        `
    })


}


