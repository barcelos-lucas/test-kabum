<?php
session_start();

// Carregar a biblioteca dotenv
require_once __DIR__ . '/../../vendor/autoload.php';
use Dotenv\Dotenv;


$dotenv = Dotenv::createImmutable(__DIR__ . '/../../', '.env', true);
$dotenv->load();


 
$DB_HOST=$_ENV["DB_HOST"];
$DB_USER=$_ENV["DB_USER"];
$DB_PASSWORD=$_ENV["DB_PASSWORD"];
$DB_NAME=$_ENV["DB_NAME"];
$DB_PORT=$_ENV["DB_PORT"];

$db=mysqli_connect("$DB_HOST","$DB_USER","$DB_PASSWORD","$DB_NAME","$DB_PORT");

if (mysqli_connect_errno()) {
  die("Erro na conexão: " . mysqli_connect_error());
}



// class Database {
//     private $host;
//     private $db_name;
//     private $username;
//     private $password;
//     private $port;
//     public $conn;

//     function __construct() {
//         $this->host = $_ENV['DB_HOST'];
//         $this->db_name = $_ENV['DB_NAME'];
//         $this->username = $_ENV['DB_USER'];
//         $this->password = $_ENV['DB_PASS'];
//         $this->port = $_ENV['DB_PORT'];
//     }

//     function conectarBanco() {
//         try {
//             $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";port=" . $this->port;
//             $this->conn = new PDO($dsn, $this->username, $this->password, [
//                 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  
//                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//             ]);
//             return $this->conn;
//         } catch (PDOException $e) {
//             die("Erro na conexão: " . $e->getMessage());
//         }
//     }
// }
