/*
A FAZER:
    > cards têm apenas background image;
    > quando mouse hover, atenua background e mostra type; 
    > ao clicar, type muda de cor;
    > isto apenas serve cards de exercicios - os outros, dado que não têm imagem, devem ficar com o texto;

    > cada um dos botões/filtros pode ser somado a outros botões/filtros;

    > cada um dos botões deve ter toogle;

    > botão All já vem seleccionado por defeito;

    > acrescentar os restantes conteúdos, devidamente preenchidos;

    > organização dos botões:
    >> temáticas divididas em linhas;
    >> dispor em grid;

    > navigator deve ficar fixed. banner deve ficar escondido mediante scroll down;
*/
// definição de variáveis locais:
const btn = document.querySelectorAll(".btn");
const navigator_container = document.getElementById("navigator_container");

document
  .getElementById("buttons_container")
  .addEventListener("click", filterEvents, false);
//document.getElementsByClassName('.card').addEventListener('hover', hoverCardEvents, false);

// definição de eventos:
// ACTIVA CADA UM DOS BOTÕES:
btn.forEach((btn) => {
  btn.addEventListener("click", () => {
    // MUDA A COR DO BOTÃO MEDIANTE CLIQUE:
    btn.classList.toggle("active");
    console.log(btn.textContent);
  });
});

// definição de funções:

// filtragem:
function filterEvents({ target: { id } }) {
  if (id == "btnAll") {
    showExercises(getExercises());
    console.log("btnAll confirm");
  }

  if (id == "btnModule") {
    showExercises(getTypeModule());
    console.log("btnModule confirm");
  }

  if (id == "btnExercise") {
    showExercises(getTypeExercise());
    console.log("btnExercise confirm");
  }

  if (id == "btnRepository") {
    showExercises(getTypeRepository());
    console.log("btnRepository confirm");
  }

  if (id == "btnProject") {
    showExercises(getTypeProject());
    console.log("btnProject confirm");
  }

  if (id == "btnHTML") {
    showExercises(getHTMLExercises());
    console.log("btnHTML confirm");
  }

  if (id == "btnCSS") {
    showExercises(getCSSExercises());
    console.log("btnCSS confirm");
  }

  if (id == "btnProgrammingConcepts") {
    showExercises(getprogrammingConcepts());
    console.log("btnProgrammingConcepts confirm");
  }

  if (id == "btnJavaScript") {
    showExercises(getJavaScript());
    console.log("btnJavaScript confirm");
  }

  if (id == "btnReact") {
    showExercises(getReact());
    console.log("btnReact confirm");
  }

  if (id == "btnDbBasics") {
    showExercises(getDbBasics());
    console.log("btnDbBasics confirm");
  }

  if (id == "btnSQL") {
    showExercises(getmySQL());
    console.log("btnSQL confirm");
  }

  if (id == "btnPHP") {
    showExercises(getPHP());
    console.log("btnPHP confirm");
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

function showExercises(arrayExercises) {
  navigator_container.innerHTML = "";

  arrayExercises.map((exe) => {
    navigator_container.innerHTML += `
            <a 
            href="${exe.urlLink}" 
            target="_blank" 
            class="card" 
            id="card-${exe.id}"
            style="background-image: url(${exe.imageLink});">
                <p>${exe.name}</p>
            </a>
        `;
  });
}
