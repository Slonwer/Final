<?php

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="box box-first">
            <span class="fa-solid fa-users"></span>
            <span>
                <?php
                if (!empty($this->data['countUsers'])) {
                    echo $this->data['countUsers'][0]['qnt_users'];
                }
                ?>
            </span>
            <span>Usuários</span>
        </div>

        <div class="box box-second">
            <span class="fa-solid fa-truck-ramp-box"></span>
            <span>43</span>
            <span>Entregas</span>
        </div>

        <div class="box box-third">
            <span class="fa-solid fa-circle-check"></span>
            <span>12</span>
            <span>Completas</span>
        </div>

        <div class="box box-fourth">
            <span class="fa-solid fa-triangle-exclamation"></span>
            <span>3</span>
            <span>Alertas</span>
        </div>
    </div>

</div>
<!-- Fim do conteudo do administrativo -->