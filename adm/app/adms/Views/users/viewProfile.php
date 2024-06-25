<?php
if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}
?>
<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Perfil</span>
            <div class="top-list-right">
                <?php
                if (!empty($this->data['viewProfile'])) {
                    echo "<a href='" . URLADM . "edit-profile/index' class='btn-warning'>Editar</a> ";
                    echo "<a href='" . URLADM . "edit-profile-password/index' class='btn-warning'>Editar Senha</a> ";
                    echo "<a href='" . URLADM . "edit-profile-image/index' class='btn-warning'>Editar Imagem</a> ";
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
            if (!empty($this->data['viewProfile'])) {
                extract($this->data['viewProfile'][0]);
            ?>
                <div class="view-det-adm">
                    <span class="view-adm-title">Foto: </span>
                    <span class="view-adm-info">
                        <?php
                        if ((!empty($image)) and (file_exists("app/adms/assets/image/users/" . $_SESSION['user_id'] . "/$image"))) {
                            echo "<img src='" . URLADM . "app/adms/assets/image/users/" . $_SESSION['user_id'] . "/$image' width='100' height='100'><br><br>";
                        }else{
                            echo "<img src='" . URLADM . "app/adms/assets/image/users/icon_user.png' width='100' height='100'><br><br>";
                        }
                        ?>
                    </span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Nome: </span>
                    <span class="view-adm-info"><?php echo $name; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">Apelido: </span>
                    <span class="view-adm-info"><?php echo $nickname; ?></span>
                </div>

                <div class="view-det-adm">
                    <span class="view-adm-title">E-mail: </span>
                    <span class="view-adm-info"><?php echo $email; ?></span>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->