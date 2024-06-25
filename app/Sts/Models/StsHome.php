<?php

namespace Sts\Models;

// Rederecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    header('Location: /');
    die('Erro: Página não encontrada!<br>');
}

/**
 * Models responsável em buscar os dados da página home
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class StsHome {
    /** @var array|null $data Recebe os registros do banco de dados */
    private array|null $data;
   
    /**
     * Instancia a classe genérica no helper responsável em buscar os registro no banco de dados.
     * Possui a QUERY responsável em buscar os registros no BD.
     * @return array|null Retorna o registro do banco de dados com informações para página Home
     */
    public function index(): array|null {

        /* CODIGO PARA EXIBIÇÃO DO "TOPO" DO LAYOUT */
        $viewHomeTop = new \Sts\Models\helper\StsRead();
        $viewHomeTop->fullRead("SELECT * FROM sts_homes_tops WHERE id=:id LIMIT :limit", "id=1&limit=1");
        $this->data['top'] = $viewHomeTop->getResult();

        /* CODIGO PARA EXIBIÇÃO DO "SERVIÇOS" DO LAYOUT */
        $viewHomeServico = new \Sts\Models\helper\StsRead();
        $viewHomeServico->fullRead("SELECT * FROM sts_homes_services WHERE id=:id LIMIT :limit", "id=1&limit=1");
        $this->data['serv'] = $viewHomeServico->getResult();

        /* CODIGO PARA EXIBIÇÃO DO "SERVIÇOS PREMIUM" DO LAYOUT */
        $viewHomePrem = new \Sts\Models\helper\StsRead();
        $viewHomePrem->fullRead("SELECT * FROM sts_homes_premiums WHERE id=:id LIMIT :limit", "id=1&limit=1");
        $this->data['prem'] = $viewHomePrem->getResult();

        return $this->data;
    }
}