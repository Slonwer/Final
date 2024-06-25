<?php

if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

if (isset($this->data['form'])) {
    $valorForm = $this->data['form'];
}

if (isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];
}
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Editar E-mail</span>
            <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "list-conf-emails/index' class='btn-info'>Listar</a> ";
                if (isset($valorForm['id'])) {
                    echo "<a href='" . URLADM . "view-conf-emails/index/" . $valorForm['id'] . "' class='btn-primary'>Visualizar</a> ";
                    echo "<a href='" . URLADM . "edit-conf-emails-password/index/" . $valorForm['id'] . "' class='btn-warning'>Editar Senha</a> ";
                    echo "<a href='" . URLADM . "delete-conf-emails/index/" . $valorForm['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")' class='btn-danger'>Apagar</a> ";
                }
                ?>
            </div>
        </div>

        <div class="content-adm-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
            <span id="msg"></span>
        </div>

        <div class="content-adm">
            <form method="POST" action="" id="form-edit-conf-emails" class="form-adm">
                <?php
                $id = "";
                if (isset($valorForm['id'])) {
                    $id = $valorForm['id'];
                }
                ?>
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                <div class="row-input">
                    <div class="column">
                        <?php
                        $title = "";
                        if (isset($valorForm['title'])) {
                            $title = $valorForm['title'];
                        }
                        ?>
                        <label class="title-input">Título:<span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="input-adm"
                            placeholder="Título para identificar o e-mail" value="<?php echo $title; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $name = "";
                        if (isset($valorForm['name'])) {
                            $name = $valorForm['name'];
                        }
                        ?>
                        <label class="title-input">Nome:<span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="input-adm"
                            placeholder="Nome que será apresentado no remetente" value="<?php echo $name; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $email = "";
                        if (isset($valorForm['email'])) {
                            $email = $valorForm['email'];
                        }
                        ?>
                        <label class="title-input">E-mail:<span class="text-danger">*</span></label>
                        <input type="text" name="email" id="email" class="input-adm"
                            placeholder="E-mail que será apresentado no remetente" value="<?php echo $email; ?>"
                            required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $host = "";
                        if (isset($valorForm['host'])) {
                            $host = $valorForm['host'];
                        }
                        ?>
                        <label class="title-input">Nome:<span class="text-danger">*</span></label>
                        <input type="text" name="host" id="host" class="input-adm"
                            placeholder="Servidor utilizado para enviar o e-mail" value="<?php echo $host; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $username = "";
                        if (isset($valorForm['username'])) {
                            $username = $valorForm['username'];
                        }
                        ?>
                        <label class="title-input">Usuário:<span class="text-danger">*</span></label>
                        <input type="text" name="username" id="username" class="input-adm"
                            placeholder="Usuário do e-mail, na maioria dos casos é o próprio e-mail"
                            value="<?php echo $username; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $smtpsecure = "";
                        if (isset($valorForm['smtpsecure'])) {
                            $smtpsecure = $valorForm['smtpsecure'];
                        }
                        ?>
                        <label class="title-input">SMTP:<span class="text-danger">*</span></label>
                        <input type="text" name="smtpsecure" id="smtpsecure" class="input-adm" placeholder="SMTP"
                            value="<?php echo $smtpsecure; ?>" required>
                    </div>
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $port = "";
                        if (isset($valorForm['port'])) {
                            $port = $valorForm['port'];
                        }
                        ?>
                        <label class="title-input">Porta:<span class="text-danger">*</span></label>
                        <input type="text" name="port" id="port" class="input-adm"
                            placeholder="Porta para enviar o e-mail" value="<?php echo $port; ?>" required>
                    </div>
                </div>

                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendEditConfEmails" class="btn-warning" value="Salvar">Salvar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->