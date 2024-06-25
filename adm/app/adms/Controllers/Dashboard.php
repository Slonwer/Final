<?php

namespace App\adms\Controllers;

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Controller Dashboard
 * @author RRSECCO <rrsecco80@gmail.com>
 */
class Dashboard
{
    /** @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     * Método Dashboard.
     * Instanciar a classe responsavel em carregar a View e enviar os dados para View.
     * 
     * @return void
     */
    public function index(): void
    {
        $countUsers = new \App\adms\Models\AdmsDashboard();
        $countUsers->countUsers();
        if ($countUsers->getResult()) {
            //var_dump($countUsers->getResultBd());
            $this->data['countUsers'] = $countUsers->getResultBd();
        } else {
            $this->data['countUsers'] = false;
        }


        $this->data['sidebarActive'] = "dashboard";

        $loadView = new \Core\ConfigView("adms/Views/dashboard/dashboard", $this->data);
        $loadView->loadView();
    }
}