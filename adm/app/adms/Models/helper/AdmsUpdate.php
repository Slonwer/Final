<?php

namespace App\adms\Models\helper;

use PDO;
use PDOException;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Classe gernérica para editar registro no banco de dados
 *
 * @author RRSECCO
 */
class AdmsUpdate extends AdmsConn
{
    private string $table;
    private string|null $terms;
    private array $data;
    private array $value = [];
    private string|null|bool $result;
    private object $update;
    private string $query;
    private object $conn;

    function getResult(): string|null|bool
    {
        return $this->result;
    }

    public function exeUpdate(string $table, array $data, string|null $terms = null, string|null $parseString = null): void
    {
        $this->table = $table;
        $this->data = $data;
        $this->terms = $terms;

        parse_str($parseString, $this->value);

        $this->exeReplaceValues();
    }

    private function exeReplaceValues(): void
    {
        foreach ($this->data as $key => $value) {
            $values[] = $key . "=:" . $key;
        }
        $values = implode(', ', $values);

        $this->query = "UPDATE {$this->table} SET {$values} {$this->terms}";

        $this->exeInstruction();
    }

    private function exeInstruction(): void
    {
        $this->connection();
        try {
            $this->update->execute(array_merge($this->data, $this->value));
            $this->result = true;
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
        $this->update = $this->conn->prepare($this->query);
    }
}