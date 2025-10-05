<?php

// 1. Defines preset table sizes for quick links
$defaultTableSizes = [
    ['rows' => 3, 'cols' => 3],
    ['rows' => 6, 'cols' => 6],
    ['rows' => 12, 'cols' => 12],
    ['rows' => 120, 'cols' => 120],
];

//2. Loads the form view, passing $defaultTableSizes into it
include 'views/form.view.phtml';

// 3. form.view.phtml

/*
Arquitectura/Estrutura do projecto:

3-exercicio-tabelas/
├── index.php                ← Entry point: shows the form
├── draw.php                 ← Processes input and renders table
├── utils/
│   └── color.php            ← Utility: generates random colors
└── views/
    ├── form.view.phtml      ← HTML form + preset links
    └── draw.view.phtml      ← HTML table rendering

----------------------------------

This is modular because:
    Logic is separated from presentation
    Views are reusable
    Utilities are isolated


----------------------------------

How It All Connects
1. User visits index.php
    Sees form and quick links
2. User submits form or clicks a link
    Goes to draw.php?rows=...&cols=...
3. draw.php validates input
    Loads color.php and draw.view.phtml
4. draw.view.phtml renders table
    Uses randomColor() for styling


----------------------------------

Want to take this further? You could:
    Add a toggle for RGB vs HEX colors
    Store last-used size in a cookie
    Animate cell colors or add hover effects
    Build a “table designer” with live preview
    If background colour is too dark, text colour becomes white


----------------------------------

*/