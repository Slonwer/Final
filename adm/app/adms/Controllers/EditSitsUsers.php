<?php

namespace App\adms\Controllers;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller editar situação usuário
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class EditSitsUsers
{

    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data = [];

    /** @var array $dataForm Recebe os dados do formulario */
    private array|null $dataForm;

    /** @var int|string|null $id Recebe o id do registro */
    private int|string|null $id;

    /**
     * Método editar situação usuário.
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

        if ((!empty($id)) and (empty($this->dataForm['SendEditSitUser']))) {
            $this->id = (int) $id;
            $viewSitUser = new \App\adms\Models\AdmsEditSitsUsers();
            $viewSitUser->viewSitUser($this->id);
            if ($viewSitUser->getResult()) {
                $this->data['form'] = $viewSitUser->getResultBd();
                $this->viewEditSitUser();
            } else {
                $urlRedirect = URLADM . "list-sits-users/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editSitUser();
        }
    }

    /**
     * Instanciar a MODELS e o método "listSelect" responsável em buscar os dados para preencher o campo SELECT 
     * Instanciar a classe responsável em carregar a View e enviar os dados para View.
     * 
     */
    private function viewEditSitUser(): void
    {        
        $listSelect = new \App\adms\Models\AdmsEditSitsUsers();
        $this->data['select'] = $listSelect->listSelect();

        $loadView = new \Core\ConfigView("adms/Views/sitsUser/editSitUser", $this->data);
        $loadView->loadView();
    }

    /**
     * Editar situação.
     * Se o usuário clicou no botão, instancia a MODELS responsável em receber os dados e editar no banco de dados.
     * Verifica se editou corretamente a situação no banco de dados.
     * Se o usuário não clicou no botão redireciona para página listar situação.
     *
     * @return void
     */
    private function editSitUser(): void
    {
        if (!empty($this->dataForm['SendEditSitUser'])) {
            unset($this->dataForm['SendEditSitUser']);
            $editSitUser = new \App\adms\Models\AdmsEditSitsUsers();
            $editSitUser->update($this->dataForm);
            if($editSitUser->getResult()){
                $urlRedirect = URLADM . "view-sits-users/index/" . $this->dataForm['id'];
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->dataForm;
                $this->viewEditSitUser();
            }
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Situação não encontrada!</p>";
            $urlRedirect = URLADM . "list-sits-users/index";
            header("Location: $urlRedirect");
        }
    }
}
