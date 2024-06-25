<?php
 namespace Sts\Controllers;

 if (!defined('C7E3L8K9E5')) {
    header('Location: /');
    die('Erro: Página não encontrada!<br>');
 }
 
 /**
 * Carregar as páginas da View
 * @author RRSECCO <rrsecco80@gmail.com>
 */
 class Erro {
    /**
     * @var array|string|null $dados Recebe os dados que devem ser enviados apra VIEW
     */
    private array|string|null $data;

    public function index() {
        $this->data = [];
        $loadView = new \Core\ConfigView("Sts/Views/erro/erro", $this->data);
        $loadView->loadView();
    } 
 }