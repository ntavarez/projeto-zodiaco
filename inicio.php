<?php
    session_start();
?>
<!DOCTYPE html>
<!-- doctype informa ao agente de usuario a versão do html que deve ser renderizada-->

<html lang="pt-br">
    <head>
        <title>~Cantinho dos Signos~</title>
        <meta charset="utf-8">
        <meta name="author" content="https://github.com/ntavarez">
        <meta name="keywords" content="astrologia, signos, misticismo">

        <link rel="stylesheet" href="estilo2.css">
        <style>
            body{
                background-image: url(<?php echo $_SESSION['img'] ?>);
            }
        </style>
    </head>

    <body> 
        <div id="topo">
            <header class="topo">
                <nav>
                    <ul>
                        <li><a class="logout" href="login.html">Logout</a>
                        <?php 
                        // Inicia sessões, para assim poder destruí-las
                        //session_start(); 
                        //session_destroy(); 
                        //header("Location: login.html"); 
                        ?>
                        </li>
                    </ul>
                </nav>
            </header> 
        </div>
        <main>
            <article class="artigo">
                <h1>
                    <?php
                        echo "Olá, " . $_SESSION['nome'] . "!";
                    ?>
                </h1>
                <div class="definicao">
                    <p id="paragrafo1">
                        <?php
                            include($_SESSION['texto']);
                        ?>
                    </p>
                </div>
                <?php
                    echo "<img src=" . $_SESSION['simbolo'] ." alt='símbolo de " . $_SESSION['signo'] . "'>";
                ?>
                <div class="elemento">
                    <h2>Elemento</h2>
                    <p id="paragrafo2">
                        <?php
                            include($_SESSION['elemento']);
                        ?>
                    </p>
                </div>
                <div class="modalidade">
                    <h2>Modalidade</h2>
                    <p id="paragrafo3">
                        <?php
                            include($_SESSION['mod']);
                        ?>
                    </p>
                </div>
                <div class="compatibilidade">
                    <h2>Compatibilidade</h2>
                    <p id="paragrafo4">
                        <?php
                            include($_SESSION['comp']);
                        ?>
                    </p>
                </div>
            </article>
        </main>

        <footer class="rodape">
            <p>Background images by<a href="https://pixabay.com/pt/users/Gam-Ol-2829280/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=3820093">Oleg Gamulinskiy</a>from<a href="https://pixabay.com/pt/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=3820093">Pixabay</a></p>
            <p>Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></p>
        </footer>
</html>