


<?php

//Grafico
  // include autoloader
  
  $servidor="localhost";
	$banco="bdcidadelimpa";
	$usuario="root";
	$senha="";

	$pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);

  $naoresolvidas = "";
  $stmt = $pdo -> prepare("SELECT COUNT(pk_idDenuncia) FROM tbDenuncia");       
  $stmt ->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){

    $naoresolvidas .= "<td>Denúncias Não Resolvidas</td><td>".$row[0]."</td><tr>";
           
  }
  $resolvidas = "";
  $stmt1 = $pdo -> prepare("SELECT denunciaReslvAdm FROM tbAdm");       
  $stmt1 ->execute();
  
  while($row1 = $stmt1->fetch(PDO::FETCH_BOTH)){

    $resolvidas .= "<td>Denúncias Resolvidas</td><td>".$row1[0]."</td><tr>";
           
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
    <h1>Feedback das Denúncias</h1>
    <table>
   
            <tr>
              <th>Feedback</th>
              <th>Contagem</th>
            </tr>

            <tr>
                ".         
                     $naoresolvidas
                .    $resolvidas
                ."
             
            </tr>
            
          </table>"
  );

  $dompdf->setPaper('A4', 'portrait'); //landscape	
      
  //Renderizar o html
  $dompdf->render();

  //Exibibir a página
  $dompdf->stream(
      "Denuncias-feedback.pdf", 
      array(
          "Attachment" => false //Para realizar o download somente alterar para true
      )
  );
  

?>