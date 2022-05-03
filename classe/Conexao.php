<!-- Classe para poder concetar com o banco de dados --> 
<?php
class Conexao{
	public static function pegarConexao(){
		session_start();
		$servidor="localhost";
		$banco="bdcidadelimpa";
		$usuario="root";
		$senha="";


		//Método PDO para conectar com o banco de dados 
		$conexao = new PDO("mysql:host=$servidor;
						dbname=$banco",
						$usuario,
						$senha);


		//Caso dê erro,retornar o erro
		$conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		//Está executando um código de SQL no banco par poder usar caracteres especiais 
		$conexao->exec("SET CHARACTER SET utf8");

		return $conexao;
	}
}
?>