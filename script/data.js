let exercises = [
    
    /*
    {
        id : 0,
        name : 'name',
        urlLink : 'x',
        imageLink : 'images/',
        languages : {
            'html', 'css', 'programmingConcepts', 'javaScript',
        },

        type : {
            'exercise', 'repository', 'module', 'project',
        },

    },
    */

   // ****************************************** HTML
   {
        id : 100,
        name : 'html repository',
        urlLink : 'https://github.com/mario8988silva/06_modulo-html',
        imageLink : 'images/github.png',
        languages : 'html',
        type : 'repository',
    },

    {
        id : 129,
        name : 'recipes',
        urlLink : '01_html/exercicios/teste3/index.html',
        imageLink : 'images/07.jpg',
        languages : 'html',
        type : 'exercise',
    },

    // ****************************************** CSS
    {
        id : 200,
        name : 'css repository',
        urlLink : 'https://github.com/mario8988silva/07_modulo-css',
        imageLink : 'images/github.png',
        languages : 'css',
        type : 'repository',
    },

    {
        id : 283,
        name : 'box model',
        urlLink : '02_css/0_exercicios/1-exercicio-box-model-inicio/index.html',
        imageLink : 'images/08.png',
        languages : 'css',
        type : 'exercise',
    },

    {
        id : 284,
        name : 'newsletter Flag',
        urlLink : '02_css/0_exercicios/2-newsletter-FLAG_2/2-newsletter-1-FLAG/index.html',
        imageLink : 'images/09.png',
        languages : 'css',
        type : 'exercise',
    },

    {
        id : 285,
        name : 'newsletter EDP',
        urlLink : '02_css/0_exercicios/3-newsletter-EDP/3-newsletter-2-EDP/index.html',
        imageLink : 'images/10.png',
        languages : 'css',
        type : 'exercise',
    },

    {
        id : 286,
        name : 'newsletter Teashop',
        urlLink : '02_css/0_exercicios/4-newsletter-Teashop/newsletter-Teashop/index.html',
        imageLink : 'images/11.png',
        languages : 'css',
        type : 'exercise',
    },

    {
        id : 287,
        name : 'gallery grids',
        urlLink : '02_css/0_exercicios/5-gallery-grids-inicio/index.html',
        imageLink : 'images/12.png',
        languages : 'css',
        type : 'exercise',
    },

    {
        id : 288,
        name : 'SPEO',
        urlLink : '02_css/0_exercicios/6-exercicoSPEO-inicio/index.html',
        imageLink : 'images/13.jpg',
        languages : 'css',
        type : 'exercise',
    },

    {
        id : 289,
        name : 'SASS',
        urlLink : '02_css/0_exercicios/7-exercicio-newsletter-inicio-sass/index.html',
        imageLink : 'images/14.png',
        languages : 'css',
        type : 'exercise',
    },

    {
        id : 290,
        name : 'gallery RWD',
        urlLink : '02_css/0_exercicios/8-gallery-RWD/index.html',
        imageLink : 'images/15.png',
        languages : 'css',
        type : 'exercise',
    },

    {
        id : 291,
        name : 'responsive flex',
        urlLink : '02_css/0_exercicios/9-responsive-flex/7-responsive-flex/index.html',
        imageLink : 'images/16.png',
        languages : 'css',
        type : 'exercise',
    },

    {
        id : 292,
        name : 'webdesign RWD',
        urlLink : '02_css/0_exercicios/10-rwdExercicio/index.html',
        imageLink : 'images/17.png',
        languages : 'css',
        type : 'exercise',
    },

    // ****************************************** programmingConcepts
    {
        id : 300,
        name : 'programming concepts repository',
        urlLink : 'https://github.com/mario8988silva/modulo_javascript/tree/23c2ce498561eb45df99b48e686f1b6ad2d81d8d/conceitos_programacao',
        imageLink : 'images/github.png',
        languages : 'programmingConcepts',
        type : 'repository',
    },  

    // ****************************************** javaScript
    {
        id : 400,
        name : 'javaScript repository',
        urlLink : 'https://github.com/mario8988silva/modulo_javascript',
        imageLink : 'images/github.png',
        languages : 'javascript',
        type : 'repository',
    },

    {
        id : 424,
        name : 'form exercise',
        urlLink : '04_js/exercicios_js/exercicioForm/formExercicio.html',
        imageLink : 'images/18.jpg',
        languages : 'javaScript',
        type : 'exercise',
    },

    {
        id : 425,
        name : 'library v.5',
        urlLink : '04_js/exercicios_js/biblioteca/biblioteca-V4-add-edit/index.html',
        imageLink : 'images/19.png',
        languages : 'javaScript',
        type : 'exercise',
    },

    {
        id : 426,
        name : 'async random user',
        urlLink : '04_js/exercicios_js/async-random-users-inicio/index.html',
        imageLink : 'images/24.png',
        languages : 'javaScript',
        type : 'exercise',
    },

    // ****************************************** react
    {
        id : 500,
        name : 'react repository',
        urlLink : 'https://github.com/mario8988silva/modulo_react.git',
        imageLink : 'images/github.png',
        languages : 'react',
        type : 'repository',
    },  

    {
        id : 501,
        name : 'voting app',
        urlLink : '05_react/1-voting-app/index.html',
        imageLink : '',
        languages : 'react',
        type : 'exercise',
    },

    {
        id : 502,
        name : 'hooks',
        urlLink : '05_react/2-hooks/index.html',
        imageLink : '',
        languages : 'react',
        type : 'exercise',
    },

    // ****************************************** FrontEnd Project
    {
        id : 600,
        name : 'front end devolpment',
        urlLink : 'https://www.figma.com/design/Lw7uSBmUxGHirsgAKrOJPs/FrontEnd_Project?node-id=0-1&t=sBlTS0T3usb8CjHM-1',
        imageLink : 'images/figma.png',
        languages : 'javaScript',
        type : 'project',
    },

    {
        id : 601,
        name : 'front end repository',
        urlLink : 'https://github.com/mario8988silva/frontEnd_project.git',
        imageLink : 'images/github.png',
        languages : 'javaScript',
        type : 'project',
    },

        {
        id : 602,
        name : 'front end project',
        urlLink : 'https://mario8988silva.github.io/frontend_project/',
        imageLink : '',
        languages : 'javaScript',
        type : 'project',
    },
]