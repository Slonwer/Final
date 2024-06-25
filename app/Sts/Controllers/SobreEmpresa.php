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
 class sobreEmpresa {
    /**
     * @var array|string|null $dados Recebe os dados que devem ser enviados apra VIEW
     */
    private array|string|null $data;

    public function index() {
      $aboutCompany = new \Sts\Models\StsSobreEmpresa();
      $this->data['about-company'] = $aboutCompany->index();

      $footer = new \Sts\Models\StsFooter();
      $this->data['footer'] = $footer->index();
        
      $loadView= new \Core\ConfigView("sts/Views/sobreEmpresa/sobreEmpresa", $this->data);
      $loadView->loadView();
    } 
 }