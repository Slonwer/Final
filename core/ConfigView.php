<?php
    namespace Core;

    if (!defined('C7E3L8K9E5')) {
        header('Location: /');
        die('Erro: Página não encontrada!<br>');
     }
     
    /**
     * Carregar as páginas da View
     * @author RRSECCO <rrsecco80@gmail.com>
     */
    class ConfigView {
        /**
         * Receber o endereço da VIEW e os dados.
         * @param string $nameView Endereço da VIEW que deve ser carregada
         * @param array|string|null $data Dados que a VIEW deve receber
         */
        /* PHP 8 */
        public function __construct(private string $nameView, private array|string|null $data) {
            
        }

        /**
         * Carrega a VIEW.
         * Verificar se o arquivo existe, e carregar caso, não existindo para o carregamento.
         * @return void
         */
        public function loadView() : void {
            if (file_exists('app/' . $this->nameView . '.php')) {
                include 'app/Sts/Views/include/header.php';
                include 'app/Sts/Views/include/menu.php';
                include 'app/' . $this->nameView . '.php';
                include 'app/Sts/Views/include/footer.php';
            } else {
                die("Erro: Por favor tente novamente. Caso o problema persista, 
                entre em contato o administrador " . EMAILADM);
            }
        }
    }