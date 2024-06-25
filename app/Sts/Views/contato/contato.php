<?php
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($this->data['form'])) {
    $valueForm = $this->data['form'];
    extract($valueForm);
}

if (!empty($this->data['content'][0])) {
    extract($this->data['content'][0]);
} else {
    echo "<p style='color: #f00;'>Erro: Nenhuma informação de contato encontrado!</p>";
}
?>
    <section class="contact">
        <div class="max-width">
            <h2 class="title">
                <?php
                    if (isset($title_contact)) {
                        echo $title_contact;
                    }
                ?>
            </h2>
            <div class="contact-content">
                <div class="column left">
                    <p>
                        <?php
                            if (isset($desc_contact)) {
                                echo $desc_contact;
                            }
                        ?>
                    </p>
                    <div class="icons">
                        <div class="row">
                            <i class="<?php if (isset($icon_company)) { echo $icon_company; } ?>"></i>
                            <div class="info">
                                <div class="head"><?php if (isset($title_company)) { echo $title_company; } ?></div>
                                <div class="sub-title"><?php if (isset($desc_company)) { echo $desc_company; } ?></div>
                            </div>
                        </div>

                        <div class="row">
                            <i class="<?php if (isset($icon_address)) { echo $icon_address; } ?>"></i>
                            <div class="info">
                                <div class="head"><?php if (isset($title_address)) { echo $title_address; } ?></div>
                                <div class="sub-title"><?php if (isset($desc_address)) { echo $desc_address; } ?></div>
                            </div>
                        </div>

                        <div class="row">
                            <i class="<?php if (isset($icon_email)) { echo $icon_email; } ?>"></i>
                            <div class="info">
                                <div class="head"><?php if (isset($title_email)) { echo $title_email; } ?></div>
                                <div class="sub-title"><?php if (isset($desc_email)) { echo $desc_email; } ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column right">
                    <div class="text"><?php if (isset($title_form)) { echo $title_form; } ?></div>
                    <form method="POST" action="">
                        <?php
                            if (isset($_SESSION['msg'])) {
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                        ?>
                        <div class="fields">
                            <div class="field name">
                                <?php
                                    $value_name = "";
                                    if (isset($name)) {
                                        $value_name = $name;
                                    }
                                ?>
                                <input type="text" name="name" id="name" placeholder="Digite o nome" required value="<?php echo $value_name;?>">
                            </div>
                            <div class="field email">
                                <?php
                                    $value_email = "";
                                    if (isset($email)) {
                                        $value_email = $email;
                                    }
                                ?>
                                <input type="email" name="email" id="email" placeholder="Digite o e-mail" required value="<?php echo $value_email;?>">
                            </div>
                        </div>
                        <div class="field">
                            <?php
                                $value_subject = "";
                                if (isset($subject)) {
                                    $value_subject = $subject;
                                }
                            ?>
                            <input type="text" name="subject" id="subject" placeholder="Digite o assunto" required value="<?php echo $value_subject;?>">
                        </div>
                        <div class="field textarea">
                            <?php
                                $value_content = "";
                                if (isset($content)) {
                                    $value_content = $content;
                                }
                            ?>
                            <textarea cols="30" rows="10" name="content" id="content" placeholder="Digite o conteúdo" required>
                                <?php echo $value_content;?>
                            </textarea>
                        </div>

                        <div class="button-area">
                            <button type="submit" name="AddContMsg" value="Enviar">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>