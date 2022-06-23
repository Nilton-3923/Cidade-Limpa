


<?php

//Grafico
  // include autoloader
  
  $servidor="localhost";
	$banco="bdcidadelimpa";
	$usuario="root";
	$senha="";

	$pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);

  $zona = "";
  $stmt = $pdo -> prepare("SELECT zonaDenuncia, COUNT(pk_idDenuncia) FROM tbdenuncia
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
    <h1>Tabela de denúncias por regiões</h1>
    <table>
   
            <tr>
              <th>Regiões de São Paulo</th>
              <th>Contagem de denúncias</th>
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