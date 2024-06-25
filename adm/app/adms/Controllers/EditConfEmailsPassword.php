<?php

namespace App\adms\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar a senha da configuração de emails
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class EditConfEmailsPassword
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Método editar a senha da configuração de email.
     * Receber os dados do formulário.
     * 
     * Se o parâmetro ID e diferente de vazio e o usuário não clicou no botão editar, instancia a MODELS para recuperar as informações da configuração de e-mail no banco de dados, se encontrar instancia o método "viewConfEmailsPassword". Se não existir redireciona para o listar configurações de e-mail.
     * 
     * Se não existir a configuração de e-mail clicar no botão acessa o ELSE e instancia o método "editConfEmailsPassword".
     * 
     * @return void
     */
    public function index(int|string|null $id = null): void
    {
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if ((!empty($id)) and (empty($this->dataForm['SendEditConfEmailsPass']))) {
            $this->id = (int) $id;
            $viewConfEmailsPass = new \App\adms\Models\AdmsEditConfEmailsPassword();
            $viewConfEmailsPass->viewConfEmailsPassword($this->id);
            if ($viewConfEmailsPass->getResult()) {
                $this->data['form'] = $viewConfEmailsPass->getResultBd();
                $this->viewEditConfEmailsPassword();
            } else {
                $urlRedirect = URLADM . "list-conf-emails/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editConfEmailsPassword();
        }
    }

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditConfEmailsPassword(): void
    {
        $this->data['sidebarActive'] = "list-conf-emails";
        $loadView = new \Core\ConfigView("adms/Views/confEmails/editConfEmailsPassword", $this->data);
        $loadView->loadView();
    }

    /**
     * Editar a senha da configuração de emails.
     * Se o usuário clicou no botão, instancia a MODELS responsável em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente a configuração de email no banco de dados.
     * Se o usuário não clicou no botão redireciona para página listar configuração de email.
     *
     * @return void
     */
    private function editConfEmailsPassword(): void
    {
        if (!empty($this->dataForm['SendEditConfEmailsPass'])) {
            unset($this->dataForm['SendEditConfEmailsPass']);
            $editConfEmailsPass = new \App\adms\Models\AdmsEditConfEmailsPassword();
            $editConfEmailsPass->update($this->dataForm);
            if ($editConfEmailsPass->getResult()) {
                $urlRedirect = URLADM . "view-conf-emails/index/" . $this->dataForm['id'];
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditConfEmailsPassword();
            }
        } else {
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Configuração de email não encontrada!</p>";
            $urlRedirect = URLADM . "list-conf-emails/index";
            header("Location: $urlRedirect");
        }
    }
}
