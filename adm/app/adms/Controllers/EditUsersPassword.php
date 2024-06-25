<?php

namespace App\adms\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller da página editar senha do usuário
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class EditUsersPassword
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     * Quando o usuário clicar no botão "cadastrar" do formulário da página novo usuário. Acessa o IF e instância a classe "AdmsAddUsers" responsável em cadastrar o usuário no banco de dados.
     * Usuário cadastrado com sucesso, redireciona para a página listar registros.
     * Senão, instância a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ((!empty($id)) and (empty($this->dataForm['SendEditUserPass']))) {
            $this->id = (int) $id;
            $viewUserPass = new \App\adms\Models\AdmsEditUsersPassword();
            $viewUserPass->viewUser($this->id);
            if ($viewUserPass->getResult()) {
                $this->data['form'] = $viewUserPass->getResultBd();
                $this->viewEditUserPass();
            } else {
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editUserPass();
        }
    }

    /**
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditUserPass(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/users/editUserPass", $this->data);
        $loadView->loadView();
    }

    private function editUserPass(): void
    {
        if (!empty($this->dataForm['SendEditUserPass'])) {
            unset($this->dataForm['SendEditUserPass']);
            $editUserPass = new \App\adms\Models\AdmsEditUsersPassword();
            $editUserPass->update($this->dataForm);
            if ($editUserPass->getResult()) {
                $urlRedirect = URLADM . "view-users/index/" . $this->dataForm['id'];
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditUserPass();
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
            $urlRedirect = URLADM . "list-users/index";
            header("Location: $urlRedirect");
        }
    }
}
