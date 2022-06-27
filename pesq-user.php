<?php
//Incluir a conexão com banco de dados
include_once '../classe/Adm.php';

$adm = new Adm();
$usuario = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);
echo"
        <table class='table table-striped table-hover resultado'>
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Cep</th>
        </tr>";
if($usuario != ''){
    $result_user = $adm->pesquisaUsuario($usuario);
    if($result_user != false){

        foreach($result_user as $user){
            echo "<tr><td>".$user['pk_Usuario']."</td><td>".$user['nomeUsuario']."</td> <td>".$user['emailUsuario']."</td>
            <td>".$user['cepUsuario']."</td></tr>";
        }
    }
    else{
        echo"usuario não encontrada...";
    }
}else{

    $result_user = $adm->tabelaUsuario();
    foreach($result_user as $user){
        echo "<tr><td>".$user['pk_Usuario']."</td><td>".$user['nomeUsuario']."</td> <td>".$user['emailUsuario']."</td>
        <td>".$user['cepUsuario']."</td></tr>";
    }

}
echo "</table>";