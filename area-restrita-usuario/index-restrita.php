<?php
    session_start();
    include_once("../session/valida-sentinela.php");
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

    echo ("<h2> O Id do Úsuario é :" .$_SESSION['idUsuario']."</h2>");
    
    ?>
    <a href="../session/logout-usuario.php">Sair</a>               <a href="cadastro-denuncia.php">Denunciar</a>
</body>
</html>