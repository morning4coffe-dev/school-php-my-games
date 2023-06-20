<?php
    $nameInput = $_POST['editNameInput'];
    $descInput = $_POST['editDescInput'];

    $database = 'herni_databaze.db';

    try 
    {
        $pdo = new PDO("sqlite:$database");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
        $stmt = $pdo->query("UPDATE hra SET popis = ' $descInput ' WHERE jmeno = ' $nameInput '");

        header("Location: pva-seminarka.php");
        exit();
    } 
    catch (PDOException $e) 
    {
        echo "Connection failed: " . $e->getMessage();
    }
?>