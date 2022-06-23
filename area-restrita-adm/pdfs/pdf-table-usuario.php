


<?php

//Grafico
  // include autoloader
  
  $servidor="localhost";
	$banco="bdcidadelimpa";
	$usuario="root";
	$senha="";

	$pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);

  $usuario = "";
  $stmt = $pdo -> prepare("SELECT * FROM tbUsuario");       
  $stmt ->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $usuario .= "<td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[4]."</td><tr>";  
  }

  $stmt = $pdo -> prepare("SELECT COUNT(pk_Usuario) FROM tbUsuario");       
  $stmt ->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $num = $row[0];
           
  }

  $ultimosUsuarios = "";
  $stmt = $pdo -> prepare("SELECT * FROM tbUsuario
                            ORDER BY pk_Usuario DESC
                            LIMIT 0,5");       
  $stmt ->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){

    $ultimosUsuarios .= "<td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[4]."</td><tr>";  
           
  }





  require_once("../dompdf/autoload.inc.php");

  
  //referenciar o DomPDF com namespace
  use Dompdf\Dompdf;

  //Criando a Instancia
  $dompdf = new DOMPDF();

  // Carrega seu HTML (Conteúdo)
  $dompdf->load_html(
    "
    <style>

      table, th, td {
        border: 1px solid black;
      }
      th{
        color:black ;
        padding: 15px;
        font-size: 1rem;
      }
      td{
        font-size:15px;
        padding:8px;
      } 
      table{
        margin:auto;
        text-align:center;
        font-size: 2em; 
        border-collapse: collapse;
      }
      tr:nth-child(even){
        background-color: #DEF2B3;
      }
      h1{
        text-align:center;
      }
      .header{
        margin-bottom: 50px;
      }
    </style>

    <div class='header'>
      <p>Cidade Limpa - pdf tabela Usuários </p>
      <p>Número total de usuários cadastrados: ".$num." </p>
    </div>
    <h1>Tabela de Usuários</h1>
    <table>
      <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Localização - CEP</th>
      </tr>
      <tr>
          ".         
            $usuario
          ."
      </tr>
    </table>

    <h1>Últimos usuários cadastrados</h1> 
    <table>
      <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Localização - CEP</th>
      </tr>
      <tr>
          ".         
            $ultimosUsuarios
          ."
      </tr>
    </table>
"
  );

  $dompdf->setPaper('A4', 'portrait'); //landscape	
      
  //Renderizar o html
  $dompdf->render();

  //Exibibir a página
  $dompdf->stream(
      "Table-Usuarios.pdf", 
      array(
          "Attachment" => false //Para realizar o download somente alterar para true
      )
  );
  

?>