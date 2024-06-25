<?php

namespace App\adms\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller da página editar nova senha
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class UpdatePassword
{

    /** @var string|null $key Recebe a chave para cadastrar nova senha */
    private string|null $key;

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index(): void
    {

        $this->key = filter_input(INPUT_GET, "key", FILTER_DEFAULT);
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ((!empty($this->key)) and (empty($this->dataForm['SendUpPass']))) {
            $this->validateKey();
        } else {
            $this->updatePassword();
        }
    }

    private function validateKey(): void
    {
        $valKey = new \App\adms\Models\AdmsUpdatePassword();
        $valKey->valKey($this->key);
        if ($valKey->getResult()) {
            $this->viewUpdatePassword();
        } else {
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }

    private function updatePassword(): void
    {
        if (!empty($this->dataForm['SendUpPass'])) {
            unset($this->dataForm['SendUpPass']);
            $this->dataForm['key'] = $this->key;
            $upPassword = new \App\adms\Models\AdmsUpdatePassword();
            $upPassword->editPassword($this->dataForm);
            if ($upPassword->getResult()) {
                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            } else {
                $this->viewUpdatePassword();
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Link inválido, solicite novo link <a href='" . URLADM . "recover-password/index'>clique aqui</a>!</p>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }

    private function viewUpdatePassword(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/login/updatePassword", $this->data);
        $loadView->loadViewLogin();
    }
}
