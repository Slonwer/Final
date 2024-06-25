<?php

namespace App\adms\Models\helper;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Classe genérica para validar se os campos estão preenchidos
 *
 * @author RRSECCO
 */
class AdmsValEmptyField
{
    /** @var array|null $data Recebe o array de dados que deve ser validado */
    private array|null $data;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /** 
     * Validar se todos os campos estão preenchidos.
     * Recebe o array de dados que deve ser validado.
     * Retorna TRUE quando todos os campos estão preenchidos.
     * Retorna FALSE quando algum campo está vazio.
     * 
     * @param array $data Recebe o array de dados que deve ser validado.
     * 
     * @return void
     */
    public function valField(array $data = null): void
    {
        $this->data = $data;
        $this->data = array_map('strip_tags', $this->data);
        $this->data = array_map('trim', $this->data);

        if (in_array('', $this->data)) {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Necessário preencher todos os campos!</p>";
            $this->result = false;
        } else {
            $this->result = true;
        }
    }
}
