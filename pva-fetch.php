<?php
$recipient = $_POST['recipient'];

$database = 'herni_databaze.db';

try {
    $pdo = new PDO("sqlite:$database");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT * FROM hra WHERE ' $recipient '");

    header("Location: pva-seminarka.php");
    exit();
} 
catch (PDOException $e) 
{
    echo "Connection failed: " . $e->getMessage();
}
?>
