<?php
/* * *********************************************************************
 * CONFIGURACION DE LA ODBC
 * ********************************************************************* */

$_CONFIG['ODBC_DSN'] = 'SD_CMS_SAL'; // DSN de la coneccion ODBC
$_CONFIG['ODBC_User'] = 'sa'; // Nombre de Usuario de la coneccion ODBC
$_CONFIG['ODBC_Password'] = 'wordpass'; // Password de la coneccion ODBC

// Zona Horaria
$_CONFIG['TIMEZONE'] = 'America/Argentina/Buenos_Aires';
$_CONFIG['App_Name'] = 'Diario Pregon';
$_CONFIG['SLSS_User'] = 'Diario Pregon';
$_CONFIG['Productos'] = array(
    array(
        "id" => 1,
        "nombre" => "Diario",
        "prefijos" => ["DPR", "ES1"]
    ), array(
        "id" => 2,
        "nombre" => "Suplementos",
        "prefijos" => ["ES1"]
    )
);
$_CONFIG['prefijo_img'] = "DPR";
$_CONFIG['Cantidad_dias'] = "5"; // cantidad de dias remanentes 
$_CONFIG['Log_Path'] = ".//Log//";
$_CONFIG['Url_Diario'] = "https://www.pregon.com.ar/";
$_CONFIG['AppDomain'] = "https://www.pregon.com.ar/EstadoEdicion";
$_CONFIG["PayWall"] = array(
    'activo' => true,
    'maxima_vistas' => 0,
    'forma_reseteo' => 1, //tipo de manipulacion de fecha para reseteo 1 - mes calendario - 2 dia a partir de ahora
    'ttl_vistas' => 5, // tiempo en que se resetea las visualisaciones  si es de forma_reseteo 2 si no no lo contenpla
    'max_equipo' => 2, // maxima cantidad de equipos permitidos
    'dias_antes' => 5, //dias antes por las dudas que tiene que cambiar el estado de la suscripcion en el servicio para que no se debite
    'product' => 2,
    'tipo_bloqueo' => 1, //1- si bloquea directo sin aparecer la nota , 0-si bloquea por js
    'identificador' => 'cookie', // cookie - usa la cookie como identificador | fingerprint - usa  el fingerprint como indetificador
    'nombre_cookie' => [
        'fingerprint' => 'SDFP-EI',
        'cookie' => 'SDPWC-EI'
    ],
    'bloqueo_suscripcion' => false,
    'bloqueo_usuario_registrado' => true,
    'maxima_vistas_registrado' => 10 //no se usa si el bloqueo_suscripcion es false la  cantidad de vistas tiene que ser mayor a maxima_vistas porque utilizan el mismo contador
);
