// METODOS QUE NAO IMPLICAM ALTERACAO DO MODEL ODE DADOS :

//mostrar popUp:
export const showPopup = url => {
    popup.classList.add('open');
    popup.firstElementChild.src = url;
}

export const closePopup = () => popup.classList.remove('open');

