<?php

namespace Sts\Models\helper;

use PDO;
use PDOException;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Conexão com o banco de dados
 * @author RRSECCO
 */
abstract class StsConn {
    /** @var string $host Recebe o host da constante HOST */
    private string $host = HOST;

    /** @var string $user Recebe o usuário da constante USER */
    private string $user = USER;

    /** @var string $pass Recebe a senha da constante PASS */
    private string $pass = PASS;

    /** @var string $dbName Recebe a base de dados da constante DBNAME */
    private string $dbname = DBNAME;

    /** @var int|string $port Recebe a porta da constante PORT */
    private int|string $port = PORT;// port = 3306 ou port = "3306"

    /** @var object $connect Recebe a conexão com o banco de dados */
    private object $connect;

    /**
     * Realiza a conexão com o banco de dados.
     * Não realizando o conexão corretamente, para o processamento da 
     * página e apresenta a mensagem de erro, com o e-mail de contato do administrador
     * @return object retorna a conexão com o banco de dados
     */
    public function connectDb(): object {
        try {
            //Conexao com a porta
            $this->connect = new PDO("mysql:host={$this->host};port={$this->port};dbname=" . $this->dbname, $this->user, $this->pass);
            return $this->connect;
        } catch (PDOException $err) {
            die("Erro: Por favor tente novamente. 
            Caso o problema persista, entre em contato o administrador " . EMAILADM);
        }
    }
}
