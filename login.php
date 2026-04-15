<?php

require_once __DIR__.'/config/config.php';
session_start();

if(isset($_SESSION['user_id']))
{
    header('Location: ' . $base_url . '/index.php');
    exit;
}

require_once __DIR__.'/resources/views/login/index.php';