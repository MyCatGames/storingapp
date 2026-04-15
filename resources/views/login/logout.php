<?php
session_start();
require_once __DIR__.'/../../../config/conn.php';

// Vernietig de sessie
session_destroy();

// Redirect naar home
header('Location: ' . $base_url . '/index.php');
exit;
