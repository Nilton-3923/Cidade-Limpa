<?php
    require_once("../classe/Usuario.php"); 
    session_start();

    $usuario = new Usuario();

    $listar = $usuario->verificarAdm();
    $listarTabela = $usuario->verificarAdmTabela();
?>
<heade>
    <link rel="stylesheet" href="../css/notificacao.css">
</heade>

<?php
    foreach($listar as $row){   
?>
    
    <div class="mensagem" onClick="abrirModal()" >
        <img src="../imagens/Talk.png" class="icon-mensagem">
        <div class="circulo-notificacao">
            <?php echo $row[0]; ?>
        </div>
    </div>
<?php  
    } 
    ?>
    <div class="modal-denuncia-resolvida" id="modal-denuncia-resolvida" style="display:none"> 
        <h3>Estamos verificando se algumas denúncias que você fez já foram realizadas</h3>
        <form action="../objetos/objeto-denuncia-resolvida.php" method="POST">
        <input type="submit" value="Denúncia resolvida">
        
            <table>
            <tr>
                <th>Categoria</th>
                <th>Data</th>
                <th>Rua</th>
                <th>Bairro</th>
                <th>Verificar</th>
            </tr>
            <?php
            foreach($listarTabela as $row){ ?>
                <tr>
                    <td><?php echo $row['campoCategoria']; ?></td>
                    <td><?php echo $row['dataDenuncia']; ?></td>
                    <td><?php echo $row['ruaDenuncia']; ?></td>
                    <td><?php echo $row['bairroDenuncia']; ?></td>
                    <td>
        
                        <input  type="checkbox"
                                name="id[]"
                                value="<?php echo $row['pk_idDenuncia']; ?>"
                                style="width:50px; height:50px"
                                id="checkbox"
                        >
                    </td>
                </tr>
            <?php
            }
            ?>
        
            </table>
        </form>
    </div>
    <script src="../javascript/modal-notificacao.js"></script>

