<?php

namespace App\adms\Models;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Visualizar cor no banco de dados
 *
 * @author RRSECCO
 */
class AdmsViewColors
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

    /**
     * Metodo para visualizar os detalhes da cor
     * Recebe o ID da cor que será usado como parametro na pesquisa
     * @param integer $id
     * @return void
     */
    public function viewColors(int $id): void
    {
        $this->id = $id;

        $viewColors = new \App\adms\Models\helper\AdmsRead();
        $viewColors->fullRead("SELECT id, name, color, created, modified FROM adms_colors WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewColors->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Cor não encontrada!</p>";
            $this->result = false;
        }
    }
}
