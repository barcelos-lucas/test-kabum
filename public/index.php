<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/app/config/database.php';

header("Location: ../app/config/formsLogin.html");
exit;