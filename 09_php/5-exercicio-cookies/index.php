
<?php
// Faz a variável para e a devida leitura dos cookies 'theme', 'size';
// Caso não existam (??) são definidos por defeitos como 'system', 'm', devidamente;
// Estes valores serão usados para definir um estilo dinâmico da página; 
$theme = $_COOKIE['theme'] ?? 'system';
$size = $_COOKIE['size'] ?? 'm';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🍪 Cookies</title>
    <style>
        :root {
            --primary-color: #ffcc00;
            --text-color: #333;
            --background-color: #F3F3F3;

            color-scheme: light dark;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /*  Aqui são definidas as classes de estilos que serão usadas dinamicamente */
        .dark {
            color-scheme: dark;
        }

        .light {
            color-scheme: light;
        }
        
        .size-s {
            font-size: 0.75rem;
        }

        .size-m {
            font-size: 1rem;
        }

        .size-l {
            font-size: 1.25rem;
        }
        /* ------------------------------------------------------------------------- */

        body {
            font-family: Arial, sans-serif;
            background-color: light-dark(var(--background-color), var(--text-color));
            color: light-dark(var(--text-color), var(--background-color));

            >img {
                width: 400px;
                position: fixed;
                bottom: -18rem;
                right: 0;
                mix-blend-mode: darken;
            }
        }

        header {
            background-color: light-dark(var(--primary-color), #363636);
            padding: 1rem;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 1rem;
            position: relative;
            z-index: 100;
        }

        main {
            z-index: 0;
            padding: 1rem;
            max-width: 50rem;
            margin: auto;
            margin-bottom: 4rem;
            line-height: 1.5;
            display: flex;
            flex-direction: column;

            img {
                max-width: 200px;
                margin-top: -4rem;
                align-self: center;
                rotate: -180deg;
            }

            /* após cada parágrafo será inserido este bloco de ícones  */
            p {
                &::after {
                    content: "🍪🍪🍪";
                    display: block;
                    text-align: center;
                }
            }
        }

        footer {
            background-color: light-dark(var(--primary-color), #363636);
            text-align: center;
            padding: .5rem;
            position: fixed;
            width: 100%;
            bottom: 0;
            font-size: .75rem;
        }
    </style>
</head>

<body class="size-<?= $size ?> <?= $theme ?>"> <!-- aplica as duas classes ao <body> por meio de php, sendo que "size-" é fixo, comum às clases de relativas à fonte, e  < ?= $size ? >  mudará mediante o php. O mesmo para theme -->
    <header>
        <h1>🍪 Cookies</h1>
        <p>Welcome to the Cookie Monster Company!</p>

        <form action="set-config.php"> <!-- manda uma chamada para o ficheiro set-config.php ... -->
            <input type="hidden" name="config" value="theme"> <!-- ... e passa a informação config=theme ... -->
            <select name="value"> <!-- ... e o value= mediante a opção seleccionada pelo utilizador. -->
                <option value="light">Light Mode</option>
                <option value="dark">Dark Mode</option>
                <option value="system" selected>System Default</option>
            </select>
            <button type="submit">Set Theme</button>
        </form>

        <nav> <!-- Cada link direcciona para o ficheiro set-config.php onde (?) define o tamanho de fonte enviando: config=size e value= escolhido pelo utilizador -->
            <a href="set-config.php?config=size&value=s">S</a>
            <a href="set-config.php?config=size&value=m">M</a>
            <a href="set-config.php?config=size&value=l">L</a>
        </nav>
    </header>

    <main>
        <img src="https://i.scdn.co/image/ab6761610000e5eba3a7cba23d68a4e73c3b8155" alt="Cookie Monster">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam libero lorem, consequat nec interdum eu, tincidunt nec tortor. Etiam porta vulputate auctor. Sed dignissim lorem vitae auctor placerat. Ut imperdiet ipsum sed blandit eleifend. Cras lectus elit, semper sit amet arcu sit amet, luctus vulputate lorem. Morbi commodo nulla quis nisl volutpat, nec mollis mauris porttitor. Donec consequat neque fermentum erat iaculis, vitae tristique dui euismod. Fusce congue ipsum magna, sit amet rutrum justo ullamcorper a. Curabitur commodo, turpis sagittis ornare scelerisque, augue dui pharetra nulla, vitae commodo lorem leo id elit. Morbi non purus accumsan, pharetra magna a, vehicula sapien. Morbi in enim quis augue accumsan ultricies. Mauris ut ipsum dui. Maecenas id ligula at augue vehicula semper id quis sem.</p>
        <p>Morbi varius et lacus eget mollis. Etiam ex purus, sodales sit amet orci eu, lobortis vestibulum elit. Praesent quam ex, porttitor sed sollicitudin et, dapibus a nisl. Curabitur egestas risus augue, id venenatis risus lobortis nec. Curabitur facilisis tincidunt sem vitae vehicula. Aenean vitae ligula eu diam sagittis aliquet. Quisque consectetur vitae ex vitae feugiat.</p>
        <p>Nam eget pretium mi. Nunc aliquet, nisi sit amet commodo auctor, augue lorem vulputate magna, eu pellentesque magna est et libero. In tempus vitae nunc id viverra. In eu fringilla nisl. Proin nec magna diam. Cras suscipit est vitae ullamcorper dictum. Maecenas aliquam, lorem sit amet consequat lobortis, orci lorem pharetra quam, a feugiat diam turpis ac sapien. Aenean odio mauris, convallis ac ultricies eget, fermentum vitae turpis. Mauris pulvinar ante velit, eget feugiat felis tempor at.</p>
        <p>Pellentesque ac egestas dui. Quisque rutrum rhoncus imperdiet. Aenean vitae lectus faucibus, condimentum est eu, suscipit velit. Aliquam sagittis condimentum elit, non ultrices nulla mollis ac. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque dolor nibh, fermentum eget nulla vestibulum, fermentum faucibus massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
        <p>Nullam leo odio, vestibulum eget faucibus condimentum, euismod non metus. In convallis malesuada nibh ac maximus. Phasellus lectus ipsum, bibendum eu ultricies id, placerat ac lectus. Donec in egestas elit, sit amet convallis est. Donec eleifend, velit eget fermentum ultrices, sapien mauris aliquet turpis, at placerat odio turpis nec ligula. Pellentesque dictum felis nunc, a semper lorem mattis id. Quisque convallis et quam et maximus. Cras convallis est eget nibh eleifend, eu porta felis laoreet. Nam malesuada non dui vitae finibus. Vestibulum efficitur quam luctus laoreet fermentum.</p>
    </main>

    <img src="https://i.scdn.co/image/ab6761610000e5eba3a7cba23d68a4e73c3b8155" alt="Cookie Monster">

    <footer>
        <p>&copy; 2025 Cookie Monster Company</p>
    </footer>
</body>

</html>