<?php

namespace App\adms\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller cadastrar cores
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class AddColors
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**     
     * Método cadastrar cor
     * Receber os dados do formulário.
     * Quando o usuário clicar no botão "cadastrar" do formulário da página nova cor. Acessa o IF e instância a classe "AdmsAddColores" responsável em cadastrar a situação no banco de dados.
     * Situação cadastrada com sucesso, redireciona para a página listar registros.
     * Senão, instância a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['SendAddColor'])) {
            unset($this->dataForm['SendAddColor']);
            $createColor = new \App\adms\Models\AdmsAddColors();
            $createColor->create($this->dataForm);
            if ($createColor->getResult()) {
                $urlRedirect = URLADM . "list-colors/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewAddColor();
            }
        } else {
            $this->viewAddColor();
        }
    }

    /**
     * Instanciar a MODELS e o método "listSelect" responsável em buscar os dados para preencher o campo SELECT 
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewAddColor(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/colors/addColors", $this->data);
        $loadView->loadView();
    }
}
