<?php

namespace App\adms\Models\helper;

use PDO;
use PDOException;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Classe gernérica para selecionar registro no banco de dados
 *
 * @author RRSECCO
 */
class AdmsRead extends AdmsConn
{
    /** @var string $select Recebe o QUERY */
    private string $select;

    /** @var array $values Recebe os valores que deve ser atribuidos nos link da QUERY com bindValue */
    private array $values = [];

    /** @var array $result Recebe os registros do banco de dados e retorna para a Models */
    private array|null $result;

    /** @var object $query Recebe a QUERY preparada */
    private object $query;

    /** @var object $conn Recebe a conexao com BD */
    private object $conn;

    /**
     * @return array Retorna o array de dados
     */
    function getResult(): array|null
    {
        return $this->result;
    }

    /** 
     * Recebe os valores para montar a QUERY.
     * Converte a parseString de string para array.
     * @param string $table Recebe o nome da tabela do banco de dados
     * @param string $terms Recebe os links da QUERY, ex: sts_situation_id =:sts_situation_id
     * @param string $parseString Recebe o valores que devem ser subtituidos no link, ex: sts_situation_id=1
     * 
     * @return void
     */
    public function exeRead(string $table, string|null $terms = null, string|null $parseString = null): void
    {
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
        }

        $this->select = "SELECT * FROM {$table} {$terms}";
        $this->exeInstruction();
    }

    /**
     * Recebe os valores para montar a QUERY.
     * Converte a parseString de string para array.
     * @param string $query Recebe a QUERY da Models
     * @param string $parseString Recebe o valores que devem ser subtituidos no link, ex: sts_situation_id=1
     * 
     * @return void
     */
    public function fullRead(string $query, string|null $parseString = null): void
    {
        $this->select = $query;
        if (!empty($parseString)) {
            parse_str($parseString, $this->values);
        }
        $this->exeInstruction();
    }

    /**
     * Executa a QUERY. 
     * Quando executa a query com sucesso retorna o array de dados, senão retorna null.
     * 
     * @return void
     */
    private function exeInstruction(): void
    {
        $this->connection();
        try {
            $this->exeParameter();
            $this->query->execute();
            $this->result = $this->query->fetchAll();
        } catch (PDOException $err) {
            $this->result = null;
        }
    }

    /**
     * Obtem a conexão com o banco de dados da classe pai "Conn".
     * Prepara uma instrução para execução e retorna um objeto de instrução.
     * 
     * @return void
     */
    private function connection(): void
    {
        $this->conn = $this->connectDb();
        $this->query = $this->conn->prepare($this->select);
        $this->query->setFetchMode(PDO::FETCH_ASSOC);
    }

    /**
     * Substitui os link da QUERY pelo valores utilizando o bindValue
     * 
     * @return void
     */
    private function exeParameter(): void
    {
        if ($this->values) {
            foreach ($this->values as $link => $value) {
                if (($link == 'limit') or ($link == 'offset') or ($link == 'id')) {
                    $value = (int) $value;
                }
                $this->query->bindValue(":{$link}", $value, (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
            }
        }
    }
}
