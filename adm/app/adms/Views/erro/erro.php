<?php

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

echo "VIEW - Página erro!<br>";
var_dump($this->data);
echo $this->data;