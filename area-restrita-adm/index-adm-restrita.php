<?php
    session_start();
    include_once("../session/valida-sentinela-adm.php");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
        
            echo $_SESSION['emailAdm']."<br>";
            echo $_SESSION['senhaAdm'];
        ?>
        <h2>Ola Adm</h2>
        <a href="../session/logout-adm.php">Sair</a><br><a href="cadastro-categoria.php">Cadastrar Categoria</a>
    </body>
</html>