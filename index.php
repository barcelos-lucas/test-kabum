<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); 
    exit;
}

header("Location: public/formsLogin.html");  
