<?php

namespace App\adms\Models\helper;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Classe genérica para validar o e-mail
 *
 * @author RRSECCO
 */
class AdmsValEmail
{
    /** @var string $email Recebe o e-mail que deve ser validado */
    private string $email;

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
     * Validar o e-mail.
     * Recebe o e-mail que deve ser validado e válida o e-mail.
     * Retorna TRUE quando o e-mail é válido.
     * Retorna FALSE quando o e-mail é inválido.
     * 
     * @param string $email Recebe o e-mail que deve ser validado.
     * 
     * @return void
     */
    public function validateEmail(string $email): void
    {
        $this->email = $email;
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: E-mail inválido!</p>";
            $this->result = false;
        }
    }
}