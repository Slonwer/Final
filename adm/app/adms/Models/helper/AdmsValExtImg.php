<?php

namespace App\adms\Models\helper;

if(!defined('C8L6K7E')){
    header("Location: /");
    die("Erro: Página não encontrada<br>");
}

/**
 * Classe genérica para validar a extensão da imagem
 *
 * @author RRSECCO
 */
class AdmsValExtImg
{
    /** @var string $mimeType Recebe o mimeType da imagem */
    private string $mimeType;

    /** @var bool $result Recebe true quando executar o processo com sucesso e false quando houver erro */
    private bool $result;

    /**
     * @return bool Retorna true quando executar o processo com sucesso e false quando houver erro
     */
    function getResult(): bool
    {
        return $this->result;
    }

    /** 
     * Validar a extensão da imagem.
     * Recebe a extensão da imagem que deve ser validada.
     * Retorna TRUE quando a extensão da imagem é válida.
     * Retorna FALSE quando a extensão da imagem é inválida.
     * 
     * @param string $mimeType Recebe o tipo da imagem que deve ser validada.
     * 
     * @return void
     */
    public function validateExtImg(string $mimeType): void
    {
        $this->mimeType = $mimeType;
        switch ($this->mimeType) {
            case 'image/jpeg':
            case 'image/pjpeg':
                $this->result = true;
                break;
            case 'image/png':
            case 'image/x-png':
                $this->result = true;
                break;
            default:
                $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário selecionar imagem JPEG ou PNG!</p>";
                $this->result = false;
        }
    }
}