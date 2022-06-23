


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
      <p>Cidade Limpa - pdf FeedBack de denúncias </p>
    </div>
    <h1>Tabela de FeedBack da denúncias</h1>
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