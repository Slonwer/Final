<?php

namespace App\adms\Models;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Listar situacao usuários do banco de dados
 *
 * @author RRSECCO
 */
class AdmsListSitsUsers
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

    /** @var string|null $searchName Recebe o nome da situacao */
    private string|null $searchName;

    /** @var string|null $searchNameValue Recebe o nome da situacao */
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
     * Metodo faz a pesquisa das situações do usuário na tabela adms_sits_users e lista as informações na view
     * Recebe o paramentro "page" para que seja feita a paginação do resultado
     * @param integer|null $page
     * @return void
     */
    public function listSitsUsers(int $page = null):void
    {
        $this->page = (int) $page ? $page : 1;

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-sits-users/index');
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(usr.id) AS num_result FROM adms_sits_users usr");
        $this->resultPg = $pagination->getResult();

        $listSitsUsers = new \App\adms\Models\helper\AdmsRead();
        $listSitsUsers->fullRead("SELECT sit.id, sit.name,
                            col.color 
                            FROM adms_sits_users sit
                            INNER JOIN adms_colors AS col ON col.id=sit.adms_color_id
                            ORDER BY sit.id DESC
                            LIMIT :limit OFFSET :offset", "limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listSitsUsers->getResult();        
        if($this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhuma situação encontrada!</p>";
            $this->result = false;
        }
    }

    /**
     * Metodo faz a pesquisa das situações do usuário na tabela adms_sits_users e lista as informações na view
     * Recebe como parametro "page" para fazer a paginação
     * Recebe o paramentro "search_name" para pesquisar a situacao atraves do nome
     * @param integer|null $page
     * @param string|null $search_name
     * @return void
     */
    public function listSearchSitsUsers(int $page = null, string|null $search_name):void
    {
        $this->page = (int) $page ? $page : 1;
        $this->searchName = trim($search_name);

        $this->searchNameValue = "%" . $this->searchName . "%";

        $pagination = new \App\adms\Models\helper\AdmsPagination(URLADM . 'list-sits-users/index', "?search_name={$this->searchName}");
        $pagination->condition($this->page, $this->limitResult);
        $pagination->pagination("SELECT COUNT(sit.id) AS num_result 
                                FROM adms_sits_users sit
                                WHERE sit.name LIKE :search_name", "search_name={$this->searchNameValue}");
        $this->resultPg = $pagination->getResult();

        $listSitsUsers = new \App\adms\Models\helper\AdmsRead();
        $listSitsUsers->fullRead("SELECT sit.id, sit.name,
                            col.color 
                            FROM adms_sits_users sit
                            INNER JOIN adms_colors AS col ON col.id=sit.adms_color_id
                            WHERE sit.name LIKE :search_name 
                            ORDER BY sit.id DESC
                            LIMIT :limit OFFSET :offset", "search_name={$this->searchNameValue}&limit={$this->limitResult}&offset={$pagination->getOffset()}");

        $this->resultBd = $listSitsUsers->getResult();        
        if($this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00'>Erro: Nenhuma situação encontrada!</p>";
            $this->result = false;
        }
    }   
}