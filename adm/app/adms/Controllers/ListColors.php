<?php

namespace App\adms\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller listar cores
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class ListColors
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var string|int|null $page Recebe o número página */
    private string|int|null $page;

    /** @var string|null $searchName Recebe o nome do usuario */
    private string|null $searchName;

    /** @var string|null $searchEmail Recebe o email do usuario */
    private string|null $searchEmail;

    /**
     * Método listar cores.
     * 
     * Instancia a MODELS responsável em buscar os registros no banco de dados.
     * Se encontrar registro no banco de dados envia para VIEW.
     * Senão enviar o array de dados vazio.
     *
     * @return void
     */
    public function index(string|int|null $page = null): void
    {
        $this->page = (int) $page ? $page : 1;


        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $this->searchName = filter_input(INPUT_GET, 'search_name', FILTER_DEFAULT);

        $listColors = new \App\adms\Models\AdmsListColors();
        if (!empty($this->dataForm['SendSearchColor'])) {
            $this->page = 1;
            $listColors->listSearchColors($this->page, $this->dataForm['search_name']);
            $this->data['form'] = $this->dataForm;
        } elseif ((!empty($this->searchName)) or (!empty($this->searchEmail))) {
            $listColors->listSearchColors($this->page, $this->searchName);
            $this->data['form']['search_name'] = $this->searchName;
        } else {
            $listColors->listColors($this->page);
        }

        if ($listColors->getResult()) {
            $this->data['listColors'] = $listColors->getResultBd();
            $this->data['pagination'] = $listColors->getResultPg();
        } else {
            $this->data['listColors'] = [];
            $this->data['pagination'] = "";
        }

        $this->data['sidebarActive'] = "list-colors";
        $loadView = new \Core\ConfigView("adms/Views/colors/listColors", $this->data);
        $loadView->loadView();
    }
}