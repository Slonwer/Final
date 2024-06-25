<?php
if (!defined('C8L6K7E')) {
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Detalhes do E-mail</span>
            <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "list-conf-emails/index' class='btn-info'>Listar</a> ";
                if (!empty($this->data['viewConfEmails'])) {
                    echo "<a href='" . URLADM . "edit-conf-emails/index/" . $this->data['viewConfEmails'][0]['id'] . "' class='btn-warning'>Editar</a> ";
                    echo "<a href='" . URLADM . "edit-conf-emails-password/index/" . $this->data['viewConfEmails'][0]['id'] . "' class='btn-warning'>Editar Senha</a> ";
                    echo "<a href='" . URLADM . "delete-conf-emails/index/" . $this->data['viewConfEmails'][0]['id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")' class='btn-danger'>Apagar</a> ";
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
        </div>

        <div class="content-adm">
            <?php
            if (!empty($this->data['viewConfEmails'])) {
                extract($this->data['viewConfEmails'][0]);
                ?>

                <div class="view-det-adm">
                    <span class="view-adm-title">ID: </span>
                    <span class="view-adm-info"><?php echo $id; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Título: </span>
                    <span class="view-adm-info"><?php echo $title; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Nome: </span>
                    <span class="view-adm-info"><?php echo $name; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">E-mail: </span>
                    <span class="view-adm-info"><?php echo $email; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Host: </span>
                    <span class="view-adm-info"><?php echo $host; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Usuário: </span>
                    <span class="view-adm-info"><?php echo $username; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">SMTP: </span>
                    <span class="view-adm-info"><?php echo $smtpsecure; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Porta: </span>
                    <span class="view-adm-info"><?php echo $port; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Cadastrado: </span>
                    <span class="view-adm-info"><?php echo date('d/m/Y H:i:s', strtotime($created)); ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Editado: </span>
                    <span class="view-adm-info">
                        <?php
                        if (!empty($modified)) {
                            echo date('d/m/Y H:i:s', strtotime($modified));
                        } ?>
                    </span>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->