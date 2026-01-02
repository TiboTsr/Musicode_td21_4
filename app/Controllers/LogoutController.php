<?php
$root = dirname($_SERVER['SCRIPT_NAME']); 
if ($root === DIRECTORY_SEPARATOR || $root === '.') {
    $root = '';
}
session_start();
session_destroy();
header('Location: ' . $root . '/login');
exit;