<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>My Played Games</title>
</head>

<body>
    <div class="container">
    <h1 class="text-center my-5">My Played Games - Hledání</h1>

    <div class="row">
        <div class="row row-cols-1 row-cols-md-3 g-4">

<?php
$name = $_POST['searchInput'];

$database = 'herni_databaze.db';

try {
    $pdo = new PDO("sqlite:$database");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->prepare("SELECT * FROM hra WHERE jmeno LIKE ?");
    $stmt->execute(array("%".$name."%"));

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
         
    if($result == null)
    {
        echo "Nic se nenašlo.";
        return;
    }

    foreach ($result as $row) {
        echo '<div class="col">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title">' . $row['jmeno'] . '</h5>
                <p class="card-text">' . $row['popis'] . '</p>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <form action="pva-delete.php" method="post">
                        <input type="hidden" name="itemId" value="' . $row['jmeno'] . '">
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </div>
            </div>
        </div>
    </div>';
    }
} 
catch (PDOException $e) 
{
    echo "Connection failed: " . $e->getMessage();
}
?>

</div>
</div>
</div>
</body>
