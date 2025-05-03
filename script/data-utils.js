
// faz chamada à array:
let myExercises = [...exercises];
console.log(myExercises);

// metodo para ler todos os exercicios:
const getExercises = () => myExercises;
console.log(getExercises);

// metodo para mostrar exercicios ou relativos a CSS:
const getCssExercises = () => myExercises.filter(exercise => exercise.languages === 'css');
console.log(getCssExercises);


