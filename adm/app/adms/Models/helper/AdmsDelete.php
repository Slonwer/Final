<?php

namespace App\adms\Models\helper;

use PDO;
use PDOException;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Classe gernérica para apagar registro no banco de dados
 *
 * @author RRSECCO
 */
class AdmsDelete extends AdmsConn
{
    private string $table;
    private string|null $terms;
    private array $value = [];
    private string|null|bool $result;
    private object $delete;
    private string $query;
    private object $conn;

    function getResult(): string|null|bool
    {
        return $this->result;
    }

    public function exeDelete(string $table, string|null $terms = null, string|null $parseString = null): void
    {
        $this->table = $table;
        $this->terms = $terms;

        parse_str($parseString, $this->value);

        $this->query = "DELETE FROM {$this->table} {$this->terms}";

        $this->exeInstruction();
    }

    private function exeInstruction(): void
    {

        $this->connection();
        try {
            $this->delete->execute($this->value);
            $this->result = true;
        } catch (PDOException $err) {
            $this->result = false;
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
        $this->delete = $this->conn->prepare($this->query);
    }
}