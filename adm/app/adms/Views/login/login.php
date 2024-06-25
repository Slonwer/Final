<?php

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

?>

<div class="container-login">
    <div class="wrapper-login">

        <div class="title">
            <span>Área Restrita</span>
        </div>

        <div class="msg-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo "<span id='msg'> " . $_SESSION['msg'] . "</span>";
                unset($_SESSION['msg']);
            } else {
                echo "<span id='msg'></span>";
            }
            ?>

        </div>

        <form method="POST" action="" id="form-login" class="form-login">

            <?php
            $user = "";
            if (isset($valorForm['user'])) {
                $user = $valorForm['user'];
            }
            ?>
            <div class="row">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="user" id="user" placeholder="Digite o usuário" value="<?php echo $user; ?>"
                    required>
            </div>

            <?php
            $password = "";
            if (isset($valorForm['password'])) {
                $password = $valorForm['password'];
            }
            ?>
            <div class="row">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Digite a senha" autocomplete="on"
                    value="<?php echo $password; ?>" required>
            </div>

            <div class="row button">
                <button type="submit" name="SendLogin" value="Acessar">Acessar</button>
            </div>

            <div class="signup-link">
                <a href="<?php echo URLADM; ?>new-user/index">Cadastrar</a> - <a
                    href="<?php echo URLADM; ?>recover-password/index">Esqueceu a senha?</a>
            </div>

        </form>

        Usuário: rrsecco80@gmail.com<br>
        Senha: 123456a
    </div>
</div>