<?php

namespace App\adms\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller da página editar senha perfil
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class EditProfilePassword
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     * Quando o usuário clicar no botão "cadastrar" do formulário da página novo usuário. Acessa o IF e instância a classe "AdmsAddUsers" responsável em cadastrar o usuário no banco de dados.
     * Usuário cadastrado com sucesso, redireciona para a página listar registros.
     * Senão, instância a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['SendEditProfPass'])) {
            $this->editProfPass();
        } else {
            $viewProfPass = new \App\adms\Models\AdmsEditProfilePassword();
            $viewProfPass->viewProfile();
            if ($viewProfPass->getResult()) {
                $this->data['form'] = $viewProfPass->getResultBd();
                $this->viewEditProfPass();
            } else {
                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            }
        }
    }

    /**
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditProfPass(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/users/editProfilePassword", $this->data);
        $loadView->loadView();
    }

    private function editProfPass(): void
    {
        if (!empty($this->dataForm['SendEditProfPass'])) {
            unset($this->dataForm['SendEditProfPass']);
            $editProfPass = new \App\adms\Models\AdmsEditProfilePassword();
            $editProfPass->update($this->dataForm);
            if ($editProfPass->getResult()) {
                $urlRedirect = URLADM . "view-profile/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditProfPass();
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Perfil não encontrado!</p>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }
}