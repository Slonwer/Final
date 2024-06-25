<?php

namespace App\adms\Models;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Visualizar situação usuário no banco de dados
 *
 * @author RRSECCO
 */
class AdmsViewSitsUsers
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os detalhes do registro
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    public function viewSitUser(int $id): void
    {
        $this->id = $id;

        $viewSitUser = new \App\adms\Models\helper\AdmsRead();
        $viewSitUser->fullRead(
            "SELECT sit.id, sit.name, sit.created, sit.modified,
                            col.color
                            FROM adms_sits_users AS sit
                            INNER JOIN adms_colors AS col ON col.id=sit.adms_color_id
                            WHERE sit.id=:id
                            LIMIT :limit",
            "id={$this->id}&limit=1"
        );

        $this->resultBd = $viewSitUser->getResult();        
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Situação não encontrada!</p>";
            $this->result = false;
        }
    }
}
