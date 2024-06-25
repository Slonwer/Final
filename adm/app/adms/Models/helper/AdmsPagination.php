<?php

namespace App\adms\Models\helper;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Classe gernérica de paginação
 *
 * @author RRSECCO
 */
class AdmsPagination
{
    /** @var integer $page Recebe o numero da pagina*/
    private int $page;
    /** @var integer $limitResult Recebe o limite de resultado*/
    private int $limitResult;
    /** @var integer $offset Recebe o calculo entre a quantidade de paginas e o linmite de resultado*/
    private int $offset;
    /** @var string $query Recebe a query que será feita a paginação*/
    private string $query;
    /** @var string|null $parseString Recebe a parseString*/
    private string|null $parseString;
    /** @var array $resultBd Recebe o resultado que vem do banco de dados*/
    private array $resultBd;
    /** @var string|null $result Recebe o resultado TRUE ou FALSE*/
    private string|null $result;
    /** @var integer $totalPages Recebe o total de paginas*/
    private int $totalPages;
    /** @var integer $maxLinks Recebe o número maximo de paginas*/
    private int $maxLinks = 2;
    /** @var string $link Recebe o link da pagina*/
    private string $link;
    /** @var string|null $var Recebe a informação relacionada com a pagina*/
    private string|null $var;

    /** @return integer Recebe o resultado do calculo entre a quantidade de paginas e o linmite de resultado*/
    function getOffset(): int
    {
        return $this->offset;
    }

    /** @return string|null Recebe o resultado TRUE ou FALSE*/
    function getResult(): string|null
    {
        return $this->result;
    }

    /**
     * Metodo para criar o link da pagina
     *
     * @param string $link
     * @param string|null|null $var
     */
    function __construct(string $link, string|null $var = null)
    {
        $this->link = $link;
        $this->var = $var;
    }

    /**
     * Metodo recebe a pagina e o limite de resultado a ser exibido
     *
     * @param integer $page
     * @param integer $limitResult
     * @return void
     */
    public function condition(int $page, int $limitResult): void
    {
        $this->page = (int) $page ? $page : 1;
        $this->limitResult = (int) $limitResult;
        $this->offset = (int) ($this->page * $this->limitResult) - $this->limitResult;
    }

    /**
     * Metodo recebe a query que será feita a paginação e a parseString
     * Chama o helper AdmsRead para fazer a pesquisa no banco de dados
     * @param string $query
     * @param string|null|null $parseString
     * @return void
     */
    public function pagination(string $query, string|null $parseString = null): void
    {
        $this->query = (string) $query;
        $this->parseString = (string) $parseString;
        $count = new \App\adms\Models\helper\AdmsRead();
        $count->fullRead($this->query, $this->parseString);
        $this->resultBd = $count->getResult();
        $this->pageInstruction();
    }

    /**
     * Metodo faz o calculo do total de paginas 
     * Chama o metodo layoutPagination
     * @return void
     */
    private function pageInstruction(): void
    {
        $this->totalPages = (int) ceil($this->resultBd[0]['num_result'] / $this->limitResult);
        if ($this->totalPages >= $this->page) {
            $this->layoutPagination();
        } else {
            header("Location: {$this->link}");
        }
    }

    /**
     * Metodo com o layout da paginação que será exibida na view
     * @return void
     */
    private function layoutPagination(): void
    {
        $this->result = "<div class='content-pagination'>";
        $this->result .= "<div class='pagination'>";

        $this->result .= "<a href='{$this->link}{$this->var}'>Primeira</a>";

        for ($beforePage = $this->page - $this->maxLinks; $beforePage <= $this->page - 1; $beforePage++) {
            if ($beforePage >= 1) {
                $this->result .= "<a href='{$this->link}/$beforePage{$this->var}'>$beforePage</a>";
            }
        }

        $this->result .= "<a href='#' class='active'>{$this->page}</a>";

        for ($afterPage = $this->page + 1; $afterPage <= $this->page + $this->maxLinks; $afterPage++) {
            if ($afterPage <= $this->totalPages) {
                $this->result .= "<a href='{$this->link}/$afterPage{$this->var}'>$afterPage</a>";
            }
        }

        $this->result .= "<a href='{$this->link}/{$this->totalPages}{$this->var}'>Última</a>";

        $this->result .= "</div>";
        $this->result .= "</div>";
    }
}
