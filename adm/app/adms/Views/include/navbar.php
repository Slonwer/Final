<!-- Inicio Navbar -->
<nav class="navbar">
    <div class="navbar-content">
        <div class="bars">
            <i class="fa-solid fa-bars"></i>
        </div>
        <img src="<?php echo URLADM; ?>app/adms/assets/image/logo/logo.jpg" alt="RRSECCO" class="logo">
    </div>

    <div class="navbar-content">        

        <div class="avatar">
            <?php
            if ((!empty($_SESSION['user_image'])) and (file_exists("app/adms/assets/image/users/" . $_SESSION['user_id'] . "/" . $_SESSION['user_image']))) {
                echo "<img src='" . URLADM . "app/adms/assets/image/users/" . $_SESSION['user_id'] . "/" . $_SESSION['user_image'] . "' width='40' height='40'>";
            } else {
                echo "<img src='" . URLADM . "app/adms/assets/image/users/icon_user.png' width='40' height='40'>";
            }
            ?>
            <div class="dropdown-menu setting">
                <a href="<?php echo URLADM; ?>view-profile/index" class="item">
                    <span class="fa-solid fa-user"></span> Perfil
                </a>
                <a href="<?php echo URLADM; ?>edit-profile/index" class="item">
                    <span class="fa-solid fa-gear"></span> Configuração
                </a>
                <a href="<?php echo URLADM; ?>logout/index" class="item">
                    <span class="fa-solid fa-arrow-right-from-bracket"></span> Sair
                </a>
            </div>
        </div>
    </div>
</nav>
<!-- Fim Navbar -->