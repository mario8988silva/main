// METODOS QUE NAO IMPLICAM ALTERACAO DO MODEL ODE DADOS :

//mostrar popUp:
const showPopup = url => {
    popup.classList.add('open');
    popup.firstElementChild.src = url;
}

const closePopup = () => popup.classList.remove('open');

