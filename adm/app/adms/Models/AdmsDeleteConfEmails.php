<?php

namespace App\adms\Models;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Apagar a configuração de email no banco de dados
 *
 * @author RRSECCO
 */
class AdmsDeleteConfEmails
{

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result = false;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

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
     * Metodo recebe como parametro o ID que será usado para excluir o registro da tabela adms_confs_emails
     * Chama a função viewConfEmails para verificar se a configuração esta cadastrada no sistema e envia o resultado para a função deleteConfEmails
     * @param integer $id
     * @return void
     */
    public function deleteConfEmails(int $id): void
    {
        $this->id = (int) $id;

        if ($this->viewConfEmails()) {
            $deleteConfEmails = new \App\adms\Models\helper\AdmsDelete();
            $deleteConfEmails->exeDelete("adms_confs_emails", "WHERE id =:id", "id={$this->id}");

            if ($deleteConfEmails->getResult()) {
                $_SESSION['msg'] = "<p style='color: green;'>Configuração de email apagada com sucesso!</p>";
                $this->result = true;
            } else {
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Configuração de email não apagada com sucesso!</p>";
                $this->result = false;
            }
        } else {
            $this->result = false;
        }
    }

    /**
     * Metodo faz a pesquisa para verificar se o usuário esta cadastrado no sistema, o resultado é enviado para a função deleteConfEmails
     *
     * @return boolean
     */
    private function viewConfEmails(): bool
    {

        $viewConfEmails = new \App\adms\Models\helper\AdmsRead();
        $viewConfEmails->fullRead("SELECT id FROM adms_confs_emails WHERE id=:id LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewConfEmails->getResult();
        if ($this->resultBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Configuração de email não encontrada!</p>";
            return false;
        }
    }
}
