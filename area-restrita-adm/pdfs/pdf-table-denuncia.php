


<?php

//Grafico
  // include autoloader
  
  $servidor="localhost";
	$banco="bdcidadelimpa";
	$usuario="root";
	$senha="";

	$pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);

  $denuncia = "";
  $stmt = $pdo -> prepare("SELECT * FROM tbDenuncia 
                            INNER JOIN tbcategoria
                                ON tbcategoria.pk_idCategoria = tbdenuncia.fk_idCategoria    
                          ");       
  $stmt ->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $endereco = "$row[8], $row[6], $row[9] - $row[5]";
    $denuncia .= "<td>".$row[0]."</td><td>".$row['campoCategoria']."</td><td>".$row[4]."</td><td>".$endereco."</td><tr>";
          
  }

  $numeroDenuncias = ""; 
  $selectCount = $pdo -> prepare("SELECT COUNT(pk_idDenuncia) FROM tbDenuncia"); 

  $selectCount ->execute();

  while($row = $selectCount->fetch(PDO::FETCH_BOTH)){
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
      <p>Cidade Limpa - pdf Denúncia</p>
      <p>Número total de denúncias: ".$num."</p>
    
    </div>

    <h1>Tabela de Denúncias</h1>
    <table>
   
            <tr>
              <th>Código</th>
              <th>Denúncia</th>
              <th>Data</th>
              <th>Endereço</th>
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