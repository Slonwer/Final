<?php
// Redirecionar ou para o processamento quando o usuário não acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
echo "<h1>Entre em Contato</h1>";
?>
<form method="POST" action="">
    <label>Nome: </label>
    <input name="name" type="text" id="name" placeholder="Nome completo"><br><br>
    
    <label>E-mail: </label>
    <input name="email" type="email" id="email" placeholder="Seu melhor e-mail"><br><br>
    
    <label>Assunto: </label>
    <input name="subject" type="text" id="subject" placeholder="Assunto da mensagem"><br><br>
    
    <label>Mensagem: </label>
    <textarea name="content" rows="6" cols="50" placeholder="Conteúdo da mensagem"></textarea><br><br>

    <input name="AddContMsg" type="submit" value="Enviar">
</form>