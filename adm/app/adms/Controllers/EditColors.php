<?php

namespace App\adms\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar cor
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class EditColors
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Método editar cor.
     * Receber os dados do formulário.
     * 
     * Se o parâmetro ID e diferente de vazio e o usuário não clicou no botão editar, instancia a MODELS para recuperar as informações da situação no banco de dados, se encontrar instancia o método "viewEditSitUser". Se não existir redireciona para o listar situações.
     * 
     * Se não existir o usuário clicar no botão acessa o ELSE e instancia o método "editSitUser".
     * 
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ((!empty($id)) and (empty($this->dataForm['SendEditColor']))) {
            $this->id = (int) $id;
            $viewColor = new \App\adms\Models\AdmsEditColors();
            $viewColor->viewColor($this->id);
            if ($viewColor->getResult()) {
                $this->data['form'] = $viewColor->getResultBd();
                $this->viewEditColor();
            } else {
                $urlRedirect = URLADM . "list-colors/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editColor();
        }
    }

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditColor(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/colors/editColors", $this->data);
        $loadView->loadView();
    }

    /**
     * Editar cor.
     * Se o usuário clicou no botão, instancia a MODELS responsável em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente a situação no banco de dados.
     * Se o usuário não clicou no botão redireciona para página listar situação.
     *
     * @return void
     */
    private function editColor(): void
    {
        if (!empty($this->dataForm['SendEditColor'])) {
            unset($this->dataForm['SendEditColor']);
            $editColor = new \App\adms\Models\AdmsEditColors();
            $editColor->update($this->dataForm);
            if ($editColor->getResult()) {
                $urlRedirect = URLADM . "view-colors/index/" . $this->dataForm['id'];
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditColor();
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Cor não encontrada!</p>";
            $urlRedirect = URLADM . "list-colors/index";
            header("Location: $urlRedirect");
        }
    }
}
