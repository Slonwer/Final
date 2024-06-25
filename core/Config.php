<?php
namespace Core;

if (!defined('C7E3L8K9E5')) {
    header('Location: /');
    die('Erro: Página não encontrada!<br>');
 }
 
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
    protected function config(): void {
        //URL do projeto
        define('URL', 'http://localhost/siteaulas/');
        define('URLADM', 'http://localhost/siteaulas/adm/');

        define('CONTROLLER', 'Home');
        define('CONTROLLERERRO', 'Erro');

        //Credenciais do banco de dados
        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'bd_sw2');
        define('PORT', 3306);
    
        define('EMAILADM', 'rrsecco80@gmail.com');
    }
}