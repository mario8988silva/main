
// faz chamada à array:
let myExercises = [...exercises];
console.log(myExercises);

// metodo para ler todos os exercicios:
const getExercises = () => myExercises;
console.log('All content: ', getExercises());

// metodo para mostrar exercicios ou relativos a Module:
const getTypeModule = () => myExercises.filter(exe => exe.type === 'module');
console.log('Module filter: ', getTypeModule());

// metodo para mostrar exercicios ou relativos a Exercise:
const getTypeExercise = () => myExercises.filter(exe => exe.type === 'exercise');
console.log('Exercise filter: ', getTypeExercise());

// metodo para mostrar exercicios ou relativos a Repository:
const getTypeRepository = () => myExercises.filter(exe => exe.type === 'repository');
console.log('Repository filter: ', getTypeRepository());

// metodo para mostrar exercicios ou relativos a Project:
const getTypeProject = () => myExercises.filter(exe => exe.type === 'project');
console.log('Project filter: ', getTypeProject());

// metodo para mostrar exercicios ou relativos a HTML:
const getHTMLExercises = () => myExercises.filter(exe => exe.languages === 'html');
console.log('HTML filter: ', getHTMLExercises());

// metodo para mostrar exercicios ou relativos a CSS:
const getCSSExercises = () => myExercises.filter(exe => exe.languages === 'css');
console.log('CSS filter: ', getCSSExercises());

// metodo para mostrar exercicios ou relativos a  Programming Concepts:
const getprogrammingConcepts = () => myExercises.filter(exe => exe.languages === 'programmingConcepts');
console.log('Programming Concepts filter: ', getprogrammingConcepts());

// metodo para mostrar exercicios ou relativos a  JavaScript:
const getJavaScript = () => myExercises.filter(exe => exe.languages === 'javaScript');
console.log('JavaScript filter: ', getJavaScript());

// metodo para mostrar exercicios ou relativos a  JavaScript:
const getReact = () => myExercises.filter(exe => exe.languages === 'react');
console.log('React filter: ', getJavaScript());


