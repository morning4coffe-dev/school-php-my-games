<?php
$itemId = $_POST['itemId'];

$database = 'herni_databaze.db';

if (isset($_POST['itemId'])) {
    $itemId = $_POST['itemId'];

    try {
        $pdo = new PDO("sqlite:$database");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("DELETE FROM hra WHERE jmeno = :itemId");
            $stmt->bindParam(':itemId', $itemId);
            $stmt->execute();
    
            header("Location: pva-seminarka.php");
            exit();
    } 
    catch (PDOException $e) 
    {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>