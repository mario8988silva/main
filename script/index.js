// definição de variáveis locais:
const btn = document.querySelectorAll(".btn");
const navigator_container = document.getElementById("navigator_container");

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
/*
function filterEvents(e){
    let el = e.target;

    if (el.id == 'btnCSS'){
        getCssExercises(getExercises());
    }
}*/

/*
exercises.forEach(ex => {
    const a = document.createElement("a");
    a.href = ex.urlLink;
    a.target = "_blank";
    a.className = "card";
    a.id = `card-${ex.id}`; // optional, for unique card ID

    const p = document.createElement("p");
    p.textContent = ex.name;

    a.appendChild(p);
    container.appendChild(a);
});

*/

//showExercises(getExercises());
/*
function showExercises(arrayExercises){
    navigator_container.innerHTML = "";

    arrayExercises.map(ex => {
        navigator_container.innerHTML += `
            <a href="${ex.urlLink}" target="_blank" class="card" id="card_${ex.id}">
                <p>${ex.name}</p>
            </a>
        `;
    })
}
*/

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

