<?php
// function.precode.php
use Smarty\Template;

function smarty_block_precode($params, $content, Template $template, &$repeat) {
    if (!$repeat) {
        // Obtener el lenguaje o usar "plain" por defecto
        $language = isset($params['lang']) ? htmlspecialchars($params['lang'], ENT_QUOTES, 'UTF-8') : 'plain';

        // Escapar el contenido del código para evitar procesamiento de Smarty
        $escaped_content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');

        // Retornar el bloque <pre><code> con el código formateado
        return "<pre><code class=\"language-$language\">$escaped_content</code></pre>";
    }
}
