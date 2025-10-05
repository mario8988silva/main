<?php
// garante que ambos 'config' e/ou 'value' são apresentados no URL...
if (!isset($_GET['config']) || !isset($_GET['value'])) {
    http_response_code(400); //... caso contrário, retorna erro 400 e cessa a execução do código
    die("Bad Request");
}

$expires = time() + 60 * 60 * 24 * 365; // define a validade do cookie para um ano (tempo() + segundos * minutos * horas * dias;)

/* construcção dinâmica da cookie, mediante aquilo que dá entrada em:
        <input type="hidden" name="config" value="theme">
        e 
        <a href="set-config.php?config=size&value=...">...</a>:
*/
$name = $_GET['config']; //faz a variável name mediante aquilo que seja inserido em name="config" ou config=size
$value = $_GET['value']; //faz a variável name mediante aquilo que seja inserido em value="theme" ou value=...

// faz a cookie mediante aquilo que seja inserido no momento, serve assim dinamicamente para tantas possibilidades quantas opções estejam disponíveis:
setcookie($name, $value, $expires); // fazCookie(variável com valor para name, variável com valor para value, variável com validade de expiração)
header('Location: /'); // redirecciona o utilizador de novo para a homepage; actualiza a página com as novas definições aplicadas nas cookies;


/*
How Do Both Files Connect:
1.User visits index.php
2.PHP reads cookies and applies styling
3.User changes theme or font size
4.Form or link sends request to set-config.php
5.set-config.php sets the cookie
6.Then redirects back to index.php
7.index.php re-renders with new styles



-------------------------------------------

Try adding:
    A reset button that clears cookies
    A preview of the selected theme before applying
    A mascot that changes based on theme (e.g. Cookie Monster in sunglasses for dark mode 😎)

    

-------------------------------------------

*/