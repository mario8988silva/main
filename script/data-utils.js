
// faz chamada à array:
let myExercises = [...exercises];
console.log(myExercises);

// metodo para ler todos os exercicios:
const getExercises = () => myExercises;
console.log('all content: ', getExercises());

// metodo para mostrar exercicios ou relativos a CSS:

const getHTMLExercises = () => myExercises.filter(exe => exe.languages === 'html');
console.log('html filter: ', getHTMLExercises());

const getCssExercises = () => myExercises.filter(exe => exe.languages === 'css');
console.log('css filter: ', getCssExercises());


