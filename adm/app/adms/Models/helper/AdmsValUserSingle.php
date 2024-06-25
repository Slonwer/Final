<?php

namespace App\adms\Models\helper;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Classe genêrica para validar o usuário único, somente um cadatrado pode utilizar o usuário
 *
 * @author RRSECCO
 */
class AdmsValUserSingle
{
    /** @var string $user Recebe o usuário que deve ser validado */
    private string $user;

    /** @var bool|null $edit Recebe a informação que é utilizada para verificar se é para validar usuário para cadastro ou edição */
    private bool|null $edit;

    /** @var int|null $id Recebe o id do usuário que deve ser ignorado quando estiver validando o usuário para edição */
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
     * Validar o usuário único.
     * Recebe o usuário que deve ser verificado se o mesmo já está cadastrado no banco de dados.
     * Acessa o IF quando estiver validando o usuário para o formulário editar.
     * Acessa o ELSE quando estiver validando o usuário para o formulário cadastrar.
     * Retorna TRUE quando não encontrar outro nenhum usuário utilizando o usuário em questão.
     * Retorna FALSE quando o usuário já está sendo utilizado por outro usuário.
     * 
     * @param string $usuário Recebe o usuário que deve ser validado.
     * @param bool|null $edit Recebe TRUE quando deve validar o usuário para formulário editar.
     * @param int|null $id Recebe o ID do usuário quando deve validar o usuário para formulário editar.
     * 
     * @return void
     */
    public function validateUserSingle(string $user, bool|null $edit = null, int|null $id = null): void
    {
        $this->user = $user;
        $this->edit = $edit;
        $this->id = $id;

        $valUserSingle = new \App\adms\Models\helper\AdmsRead();
        if(($this->edit == true) and (!empty($this->id))){
            $valUserSingle->fullRead("SELECT id FROM adms_users WHERE (user =:user OR email =:email) AND id <>:id LIMIT :limit", "user={$this->user}&email={$this->user}&id={$this->id}&limit=1");
        }else{
            $valUserSingle->fullRead("SELECT id FROM adms_users WHERE user =:user LIMIT :limit", "user={$this->user}&limit=1");
        }

        $this->resultBd = $valUserSingle->getResult();
        if(!$this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Este usuários já está cadastrado!</p>";
            $this->result = false;
        }
    }
}