


<?php

//Grafico
  // include autoloader
  
  $servidor="localhost";
	$banco="bdcidadelimpa";
	$usuario="root";
	$senha="";

	$pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);

  $denuncia = "";
  $stmt = $pdo -> prepare("select * from tbDenuncia");       
  $stmt ->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){

    $endereco = "$row[8], $row[6], $row[9] - $row[5]";
    $denuncia .= "<td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[4]."</td><td>".$endereco."</td><tr>";
           
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
    th{
      background-color:#d3d3d3;
    }
      th{
        color:white ;
        border-bottom: 3px solid grey;
        padding:  20px;
      }
      td{
        font-size:15px;
        border-bottom: 1px solid black;
        border-left:1px solid black;
        padding:20px;
      } 
      table{
      margin:auto;
      text-align:center;
      border:1px solid black;
      font-size: 2em; color: black;
      }
      h1{
        text-align:center;
      }
      
    
    </style>
    <h1>Tabela de Denúncias</h1>
    <table>
   
            <tr>
              <th>Id</th>
              <th>Título</th>
              <th>Data</th>
              <th>Endereco</th>
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
      "Tabela-Denuncias.pdf", 
      array(
          "Attachment" => false //Para realizar o download somente alterar para true
      )
  );
  

?>