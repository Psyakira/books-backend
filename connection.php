<?php
//connection.php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
function getConnection(): PDO
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bookstore";
    return new PDO("mysql:host=$servername;dbname=$database", $username, $password, [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
}

try {
    getConnection();

}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>


