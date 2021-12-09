
<?php
/* * ************************************************************************
 *
 * Version: 1.0.12.1
 * Descripcion: Inicializacion de la pagina
 * Autor: Brian Lara
 * Archivo: Initialize.php
 *
 * Historico:
 * [01/01/2012]
 *      1.0.12.1    BL  Creacion.
 *
 * ************************************************************************* */

/////// Esto es lo que tengo que poner para que funcione en ElServer.com ///////
//mb_http_output('ISO-8859-1');
//mb_http_input('ISO-8859-1');
//mb_internal_encoding('ISO-8859-1');
//ob_start('mb_output_handler');
//header('Content-Type: text/html; charset=ISO-8859-1');
header('Content-Type: text/html; charset=UTF-8');

////////////////////////////////////////////////////////////////////////////////
spl_autoload_register(function ($class) {
    $prefix = '';
    $base_dir = __DIR__ . '/Engine/php/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
