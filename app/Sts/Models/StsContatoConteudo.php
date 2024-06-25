<?php

namespace Sts\Models;

// Rederecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    header('Location: /');
    die('Erro: Página não encontrada!<br>');
}

/**
 * Models responsável em buscar os dados da página Contato
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class StsContatoConteudo {
    /** @var array|null $data Recebe os registros do BD */
    private array|null $data;
   
    /**
     * Instancia a classe genérica no helper responsável em buscar os registro no BD.
     * Possui a QUERY responsável em buscar os registros no BD.
     * @return array|null Retorna o registro do BD com informações para página Contato.
     */
    public function index(): array|null {
        $viewContatoConteudo = new \Sts\Models\helper\StsRead();
        $viewContatoConteudo->fullRead("SELECT id, title_contact, desc_contact, 
                                        icon_company, title_company, desc_company, 
                                        icon_address, title_address, desc_address, 
                                        icon_email, title_email, desc_email, title_form
                                        FROM sts_contents_contacts 
                                        WHERE id=:id 
                                        LIMIT :limit", "id=1&limit=1");
        $this->data = $viewContatoConteudo->getResult();

        return $this->data;
    }
}