<?php
$name = $_POST['nameInput'];
$desc = $_POST['descInput'];

$database = 'herni_databaze.db';

try {
    $pdo = new PDO("sqlite:$database");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("INSERT INTO hra (jmeno, zanr, tag, popis, vyvojar, delka, dat_vydani) VALUES ('$name', 'x', 'x', '$desc', 'x', 'x', 'x')");

    header("Location: pva-seminarka.php");
    exit();
} 
catch (PDOException $e) 
{
    echo "Connection failed: " . $e->getMessage();
}
?>