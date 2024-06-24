<?php
$db2_cnstr = "mysql:host=localhost;dbname=import;charset=utf8mb4";
$db2_uname = "root";
$db2_pw = "";
$db2_opt = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  
  PDO::ATTR_EMULATE_PREPARES => false,          
];

try {
  $conn = new PDO($db2_cnstr, $db2_uname, $db2_pw, $db2_opt);
  // echo "Database connection successful!";
} catch (PDOException $e) {
  echo "Connection Error: " . $e->getMessage();
  die();
}
?>
