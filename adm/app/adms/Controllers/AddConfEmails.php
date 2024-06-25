<?php

namespace App\adms\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller cadastrar configuração de email
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class AddConfEmails
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /**
     * Método cadastrar configuração de email 
     * Receber os dados do formulário.
     * Quando o usuário clicar no botão "cadastrar" do formulário da página nova configuração de email. Acessa o IF e instância a classe "AdmsAddConfEmails" responsável em cadastrar a configuração no banco de dados.
     * Configuração cadastrada com sucesso, redireciona para a página listar registros.
     * Senão, instância a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index(): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->dataForm['SendAddConfEmails'])) {
            //var_dump($this->dataForm);
            unset($this->dataForm['SendAddConfEmails']);
            $createConfEmails = new \App\adms\Models\AdmsAddConfEmails();
            $createConfEmails->create($this->dataForm);
            if ($createConfEmails->getResult()) {
                $urlRedirect = URLADM . "list-conf-emails/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewAddConfEmails();
            }
        } else {
            $this->viewAddConfEmails();
        }
    }

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewAddConfEmails(): void
    {
        $loadView = new \Core\ConfigView("adms/Views/confEmails/addConfEmails", $this->data);
        $loadView->loadView();
    }
}
