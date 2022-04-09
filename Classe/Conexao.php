<?php 
    class Conexao{
        public static function pegarConexao(){

            //variaveis para facilitar a conexão com o banco

            $servidor="localhost";
            $banco="bdteste";
            $usuario="root";
            $senha="";

            //Conectando com o Banco

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