<?php

namespace App\adms\Models;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Pagina inicial do sistema administrativo "dashboard"
 *
 * @author RRSECCO
 */
class AdmsDashboard
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os dados
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * Metodo retornar dados para o dashboard
     * Retorna FALSE se houver algum erro
     * @param integer $id
     * @return void
     */
    public function countUsers(): void
    {
        $countUsers = new \App\adms\Models\helper\AdmsRead();
        $countUsers->fullRead("SELECT COUNT(id) AS qnt_users FROM adms_users");

        $this->resultBd = $countUsers->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            //$_SESSION['msg'] = "<p style='color: #f00'>Erro: Usuário não encontrado!</p>";
            $this->result = false;
        }
    }
}
