<?php

namespace App\adms\Models\helper;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}
/**
 * Classe genêrica para validar o e-mail único, somente um cadatrado pode utilizar o e-mail
 *
 * @author RRSECCO
 */
class AdmsValEmailSingle
{
    /** @var string $email Recebe o e-mail que deve ser validado */
    private string $email;

    /** @var bool|null $edit Recebe a informação que é utilizada para verificar se é para validar e-mail para cadastro ou edição */
    private bool|null $edit;

    /** @var int|null $id Recebe o id do usuário que deve ser ignorado quando estiver validando o e-mail para edição */
    private int|null $id;

    /** @var array|null $resultBd Recebe os registros do banco de dados */
    private array|null $resultBd;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /** 
     * Validar o e-mail único.
     * Recebe o e-mail que deve ser verificado se o mesmo já está cadastrado no banco de dados.
     * Acessa o IF quando estiver validado o e-mail para o formulário editar.
     * Acessa o ELSE quando estiver validado o e-mail para o formulário cadastrar.
     * Retorna TRUE quando não encontrar outro nenhum usuário utilizando o e-mail em questão.
     * Retorna FALSE quando o e-mail já está sendo utilizado por outro usuário.
     * 
     * @param string $email Recebe o e-mail que deve ser validado.
     * @param bool|null $edit Recebe TRUE quando deve validar o e-mail para formulário editar.
     * @param int|null $id Recebe o ID do usuário quando deve validar o e-mail para formulário editar.
     * 
     * @return void
     */
    public function validateEmailSingle(string $email, bool|null $edit = null, int|null $id = null): void
    {
        $this->email = $email;
        $this->edit = $edit;
        $this->id = $id;

        $valEmailSingle = new \App\adms\Models\helper\AdmsRead();
        if (($this->edit == true) and (!empty($this->id))) {
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE email =:email id <>:id LIMIT :limit", "email={$this->email}&id={$this->id}&limit=1");
        } else {
            $valEmailSingle->fullRead("SELECT id FROM adms_users WHERE email =:email LIMIT :limit", "email={$this->email}&limit=1");
        }

        $this->resultBd = $valEmailSingle->getResult();
        if (!$this->resultBd) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Este e-mail já está cadastrado!</p>";
            $this->result = false;
        }
    }
}
