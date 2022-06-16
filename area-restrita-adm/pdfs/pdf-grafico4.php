


<?php

//Grafico
  // include autoloader
  
  $servidor="localhost";
	$banco="bdcidadelimpa";
	$usuario="root";
	$senha="";

	$pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);

  $zona = "";
  $stmt = $pdo -> prepare("SELECT COUNT(pk_idDenuncia),zonaDenuncia FROM tbdenuncia
                            GROUP BY zonaDenuncia
                            ORDER BY COUNT(pk_idDenuncia) DESC");       
  $stmt ->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){

    $zona .= "<td>".$row[0]."</td><td>".$row[1]."<tr>";
           
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
    <h1>Denúncias por Zona</h1>
    <table>
   
            <tr>
              <th>Zona</th>
              <th>Contagem</th>
            </tr>

            <tr>
                ".         
                     $zona
                ."
            </tr>
            
          </table>"
  );

  $dompdf->setPaper('A4', 'portrait'); //landscape	
      
  //Renderizar o html
  $dompdf->render();

  //Exibibir a página
  $dompdf->stream(
      "Denuncias-zona.pdf", 
      array(
          "Attachment" => false //Para realizar o download somente alterar para true
      )
  );
  

?>