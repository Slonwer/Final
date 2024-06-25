<?php

namespace App\adms\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller da página novo usuário
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class NewUser
{
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
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['SendNewUser'])) {
            unset($this->dataForm['SendNewUser']);
            $createNewUser = new \App\adms\Models\AdmsNewUser();
            $createNewUser->create($this->dataForm);
            if ($createNewUser->getResult()) {
                $urlRedirect = URLADM;
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewNewUser();
            }
        } else {
            $this->viewNewUser();
        }
    }

    private function viewNewUser(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/login/newUser", $this->data);
        $loadView->loadViewLogin();
    }
}
