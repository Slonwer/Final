<?php

namespace Core;

/**
 * Configurações básicas do site.
 * @author RRSECCO <rrsecco80@gmail.com>
 */
abstract class Config {
    /**
     * Possui as constantes com as configurações.
     * Configurações de endereço do projeto.
     * Página principal do projeto.
     * Credenciais de acesso ao banco de dados
     * E-mail do administrador.
     * 
     * @return void
     */
    protected function configAdm(): void {
        define('URL', 'http://localhost/siteaulas/');
        define('URLADM', 'http://localhost/siteaulas/adm/');

        define('CONTROLLER', 'Login');
        define('METODO', 'index');
        define('CONTROLLERERRO', 'Login');

        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'bd_sw2');
        define('PORT', 3306);

        define('EMAILADM', 'rrsecco80@gmail.com');
    }
}