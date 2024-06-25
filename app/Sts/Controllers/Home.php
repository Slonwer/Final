<?php
namespace Sts\Controllers;

// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    header('Location: /');
    die('Erro: Página não encontrada!<br>');
}

/**
 * Carregar as páginas da Homes
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class Home {
    /**
     * @var array|string|null $data Recebe os dados que devem ser enviados para VIEW
     */
    private array|string|null $data;

    /**
     * Instanciar a MODELS e receber o retorno
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index() : void {
        $home = new \Sts\Models\StsHome();
        $this->data['home'] = $home->index();//está vindo da Model

        $footer = new \Sts\Models\StsFooter();
        $this->data['footer'] = $footer->index();
        
        $loadView= new \Core\ConfigView("sts/Views/home/home", $this->data);
        $loadView->loadView();
    }
}