<?php
require_once('dir_config.php');
require_once($dirs['class'] . 'Login.php');

$login = new Login;

$login->proceedLogout();
header("Location: index.php");