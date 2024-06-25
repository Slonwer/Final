<?php

namespace App\adms\Models;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Listar a configuração de emails do banco de dados
 *
 * @author RRSECCO
 */
class AdmsListConfEmails
{
    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var int $page Recebe o número página */
    private int $page;

    /** @var int $page Recebe a quantidade de registros que deve retornar do banco de dados */
    private int $limitResult = 40;

    /** @var string|null $page Recebe a páginação */
    private string|null $resultPg;

    /** @var string|null $searchName Recebe o nome ou e-mail */
    private string|null $searchName;

    /** @var string|null $searchNameValue Recebe o nome ou e-mail */
    private string|null $searchNameValue;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /**
     * @return bool Retorna os registros do BD
     */
    function getResultBd(): array|null
    {
        return $this->resultBd;
    }

    /**
     * @return bool Retorna a paginação
     */
    function getResultPg(): string|null
    {
        return $this->resultPg;
    }

    /**
     * Metodo faz a pesquisa das configurações de e-mail na tabela adms_confs_emails e lista as informações na view
     * Recebe o paramentro "page" para que seja feita a paginação do resultado
     * @param integer|null $page
     * @return void
     */
    public function listConfEmails(int $page = null): void
    {
        $this->page = (int) $page ? $page : 1;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-conf-emails/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(id) AS num_result FROM adms_confs_emails");
        $this->resultPg = $pagination->getResult();

        $listConfEmails = new \App\adms\Models\helper\AdmsRead();
        $listConfEmails->fullRead("SELECT id, title, name, email
                FROM adms_confs_emails
                ORDER BY id DESC
                LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listConfEmails->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhum e-mail encontrado!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo faz a pesquisa das configurações de e-mail na tabela adms_confs_emails e lista as informações na view
     * Recebe o paramentro "page" para que seja feita a paginação do resultado
     * Recebe o paramentro "search_name" para pesquisar o e-mail atraves do nome ou e-mail
     * @param integer|null $page
     * @param string|null $search_name
     * @return void
     */
    public function listSearchConfEmails(int $page = null, string|null $search_name): void
    {
        $this->page = (int) $page ? $page : 1;
        $this->searchName = trim($search_name);

        $this->searchNameValue = "%" . $this->searchName . "%";

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-conf-emails/index', "?search_name={$this->searchName}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(conf.id) AS num_result 
                            FROM adms_confs_emails AS conf
                                WHERE conf.title LIKE :search_title
                                OR conf.name LIKE :search_name
                                OR conf.email LIKE :search_email", "search_title={$this->searchNameValue}&search_name={$this->searchNameValue}&search_email={$this->searchNameValue}");
        $this->resultPg = $pagination->getResult();

        $listConfEmails = new \App\adms\Models\helper\AdmsRead();
        $listConfEmails->fullRead("SELECT conf.id, conf.title, conf.name, conf.email
                FROM adms_confs_emails AS conf
                WHERE conf.title LIKE :search_title
                OR conf.name LIKE :search_name
                OR conf.email LIKE :search_email
                ORDER BY conf.id DESC
                LIMIT :limit OFFSET :offset", "search_title={$this->searchNameValue}&search_name={$this->searchNameValue}&search_email={$this->searchNameValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listConfEmails->getResult();
        if ($this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhum e-mail encontrado!</p>";
            $this->result = false;
        }
    }
}