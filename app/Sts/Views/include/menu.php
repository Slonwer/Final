<?php 
    // Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
    if (!defined('C7E3L8K9E5')) {
        header("Location: /");
        die("Erro: Página não encontrada!");
    }
?>
<nav class="navbar">
    <div class="max-width">
        <div class="logo">
            <a href="<?php echo URL;?>">RRSECCO</a>
        </div>
        <ul class="menu" id="menu-site">
            <li><a href="<?php echo URL;?>">Home</a></li>
            <li><a href="<?php echo URL;?>sobre-empresa">Sobre Empresa</a></li>
            <li><a href="<?php echo URL;?>contato">Contato</a></li>
        </ul>
        <div class="menu-btn" id="menu-btn">
            <i class="fa-solid fa-bars" id="menu-icon"></i>
        </div>
    </div>
</nav>
