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
    <div class="container" style="margin-bottom: 4rem;">
        <h1 class="text-center my-5">My Played Games</h1>

        <div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add Game
                </button>
            </div>
            <div class="col-6">
                <form action="pva-search.php" style="max-width: 400px; margin-left: auto; margin-right: 0;"
                    class="input-group mb-3" method="post">
                    <input type="text" class="form-control" placeholder="Search" name="searchInput">
                    <input type="submit" class="btn btn-primary" name="submit">
                </form>
            </div>
        </div>



        <div class="row">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                    $database = 'herni_databaze.db';

                    try {
                        $pdo = new PDO("sqlite:$database");
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        $stmt = $pdo->query("SELECT jmeno,popis FROM hra");
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
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
                                        <form action="delete-item.php" method="post">
                                            <input type="hidden" name="itemId" value="' . $row['jmeno'] . '">
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Edit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Random Title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="pva-send.php" class="input-group mb-3 flex flex-wrap flex-col gap-2" method="post">
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Jméno" name="nameInput"></input>
                    <input type="text" class="form-control" placeholder="Popis" name="descInput"></input>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="submit"></input>
                </div>
            </form>
        </div>
    </div>
</div>

</html>