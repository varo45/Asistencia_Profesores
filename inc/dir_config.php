<?php

// Configuración de variables de entorno de trabajo

$basedir = '/var/www/html/';
$dirs = [
    'public' => $basedir . 'public/',
    'inc' => $basedir . 'inc/',
    'class' => $basedir . 'class/',
];

// Iniciamos variables vacías de control de directorio activo

$act_home;
$act_horario;
$act_asistencia;
$act_usuario;
