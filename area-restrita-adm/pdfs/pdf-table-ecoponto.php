


<?php

//Grafico
  // include autoloader
  
  $servidor="localhost";
	$banco="bdcidadelimpa";
	$usuario="root";
	$senha="";

	$pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);

  $denuncia = "";
  $stmt = $pdo -> prepare("select * from tbEcoponto");       
  $stmt ->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){

    $endereco = "$row[3] - $row[], $row[5] - $row[8], $row[2], $row[7] - $row[1]";
    $denuncia .= "<td>".$row[0]."</td><td>".$endereco."</td><tr>";
           
  }

  $stmt = $pdo -> prepare("SELECT COUNT(pk_idEcoponto) FROM tbEcoponto");       
  $stmt ->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $num = $row[0];
           
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
      <p>Cidade Limpa - pdf Tabela Ecopontos</p>
      <p>Número total de Ecopontos cadastrados: ".$num." </p>
    </div>
    <h1>Tabela de Ecopontos</h1>
    <table>
   
            <tr>
              <th>Código</th>
              <th>Localização Ecoponto</th>
            </tr>
            <tr>
                ".         
                     $denuncia
                ."
             
            </tr>
            
          </table>"
  );

  $dompdf->setPaper('A4', 'portrait'); //landscape	
      
  //Renderizar o html
  $dompdf->render();

  //Exibibir a página
  $dompdf->stream(
      "Tabela-Ecopontos.pdf", 
      array(
          "Attachment" => false //Para realizar o download somente alterar para true
      )
  );
  

?>