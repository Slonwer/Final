<?php

namespace App\adms\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller da página login
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class Login {
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

        if (!empty($this->dataForm['SendLogin'])) {
            $valLogin = new \App\adms\Models\AdmsLogin();
            $valLogin->login($this->dataForm);

            if ($valLogin->getResult()) {
                $urlRedirect = URLADM . "dashboard/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
            }
        }

        $loadView = new \Core\ConfigView("adms/Views/login/login", $this->data);
        $loadView->loadViewLogin();
    }
}