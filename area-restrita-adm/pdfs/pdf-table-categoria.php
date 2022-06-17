


<?php

//Grafico
  // include autoloader
  
  $servidor="localhost";
	$banco="bdcidadelimpa";
	$usuario="root";
	$senha="";

	$pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);

  $categoria = "";
  $stmt = $pdo -> prepare("SELECT pk_idCategoria, campoCategoria, COUNT(pk_idDenuncia) FROM tbCategoria
                            INNER JOIN tbDenuncia
                              ON tbDenuncia.fk_idCategoria = tbCategoria.pk_idCategoria
                                GROUP BY pk_idCategoria");       
  $stmt ->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){

    $categoria .= "<td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><tr>";
           
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
        padding: 20px;
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
      <p>Cidade Limpa - pdf tabela categoria</p>    
    </div>
    <h1>Tabela de Categorias</h1>
    <table>
      <tr>
        <th>Código</th>
        <th>Categoria</th>
        <th>Quantidade de Denúncias</th>
      </tr>
      <tr>
          ".         
                $categoria
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
      "Tabela-categorias.pdf", 
      array(
          "Attachment" => false //Para realizar o download somente alterar para true
      )
  );
  

?>