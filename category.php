<?php
require_once 'controllers/authController.php'; 
    $_SESSION['category'] = $_GET['category'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Gamers E-Shop</title>

    <link rel="stylesheet" href="css/rara.css" />
    <link rel="stylesheet" href="css/category.css" />
    <?php include('naviBar.phtml');?>
</head>

<body>
    <div class="section-title">
        <h2><?php echo $_SESSION['category'] . " "; ?>Games:</h2>
    </div>
    <section id="content2">
        <div class="wrap-content zerogrid">
            <div class="row">
                <?php
                    $ids   = "SELECT game_id,game_name,game_price FROM games_id WHERE category LIKE '%{$_SESSION['category']}%'";
                    $idsResult = $conn->query($ids);

                    if ($idsResult->num_rows > 0) {
                        // output data of each row
                        while($row = $idsResult->fetch_assoc()) {
                            echo  '                
                            <div class="col-1-4">
                                <div class="wrap-col gallery">
                                    <a href="game.php?gameId=' .$row['game_id']. '">'.
                                        '<img style="width: 100%; max-width: 270px; max-height: 130px; height: 50%" src="images/games/game_' . $row['game_id']. '/banner.jpg" alt="" />
                                    </a>
                                    <h3>' . $row['game_name'] . '</h3>
                                    <h4>' . $row['game_price'] . '</h4>
                                </div>
                            </div>';
                        }
                    } else {
                        echo "0 results";
                    }
                ?>
            </div>

            <section id="content"></section>
        </div>
    </section>

</body>

</html>