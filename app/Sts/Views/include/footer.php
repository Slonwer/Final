<?php
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

// Acessa o IF quando encontrou algum registro no banco de dados
if (!empty($this->data['footer'][0])) {
    extract($this->data['footer'][0]);
?>
    <footer>
        <span><?php echo $footer_desc;?> <a href="<?php echo $footer_link;?>"><?php echo $footer_text_link;?></a></span>
    </footer>
<?php
    } else {
        echo "<p style='color: #f00;'>Erro: Nenhum rodapé encontrado!</p>";
    }
?>
        <!-- incluir o JavaScript -->
        <script src="<?php echo URL; ?>app/sts/assets/js/custom.js"></script>
    </body>
</html>