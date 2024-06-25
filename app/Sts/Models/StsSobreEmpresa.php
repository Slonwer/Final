<?php

namespace Sts\Models;

// Rederecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    header('Location: /');
    die('Erro: Página não encontrada!<br>');
}
/**
 * Models responsável em buscar os dados da página Sobre Empresa
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class StsSobreEmpresa {
    /** @var array|null $data Recebe os registros do banco de dados */
    private array|null $data;
   
    /** Instancia a classe genérica no helper responsável em buscar os registro no banco de dados.
     * Possui a QUERY responsável em buscar os registros no BD.
     * @return array|null Retorna o registro do banco de dados com informações para página Sobre Empresa
     */
    public function index(): array|null {    
        $viewSobreEmpresa = new \Sts\Models\helper\StsRead();
        $viewSobreEmpresa->fullRead("SELECT * 
                                    FROM sts_abouts_companies 
                                    WHERE sts_situation_id=:sts_situation_id 
                                    ORDER BY id DESC 
                                    LIMIT :limit", "sts_situation_id=1&limit=10");
        $this->data = $viewSobreEmpresa->getResult();
        return $this->data;
    }
}