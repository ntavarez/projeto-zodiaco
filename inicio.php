<?php
    session_start();
    require_once("conexao.php");
?>
<!DOCTYPE html>
<!-- doctype informa ao agente de usuario a versão do html que deve ser renderizada-->

<html lang="pt-br">
    <head>
        <title>~Cantinho dos Signos~</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="https://github.com/ntavarez">
        <meta name="keywords" content="astrologia, signos, misticismo">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
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
                        <li><a class="logout" href="login.php">Logout</a>
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
                            include_once("verificar-signo.php");
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
                           include_once("verificar-elemento.php"); 
                        ?>
                    </p>
                </div>
                <div class="modalidade">
                    <h2>Modalidade</h2>
                    <p id="paragrafo3">
                        <?php
                            include_once("verificar-modalidade.php");
                        ?>
                    </p>
                </div>
                <div class="planeta">
                    <h2>Planeta regente</h2>
                    <p id="paragrafo4">
                        <?php
                            //include_once("verificar-planeta.php");
                        ?>
                    </p>
                </div>
                <div class="compatibilidade">
                    <h2>Compatibilidade</h2>
                    <p id="paragrafo5">
                        <?php
                            include_once("verificar-compatibilidade.php");
                        ?>
                    </p>
                </div>
            </article>
        </main>
    </body>

    <footer class="rodape">
        <p>Background images by<a href="https://pixabay.com/pt/users/Gam-Ol-2829280/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=3820093">Oleg Gamulinskiy</a>from<a href="https://pixabay.com/pt/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=3820093">Pixabay</a></p>
        <p>Astrology icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a></p>
        <p>Planets images made by <a href="https://pixabay.com/pt/users/mmmCCC-28599/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4628918">mmmCCC</a> from <a href="https://pixabay.com/pt/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=4628918">Pixabay</a></p>
    </footer>
    
    <?php
        $_conexao->close();
    ?>
</html>