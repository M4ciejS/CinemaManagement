<?php
require_once 'bootstrap.php';
$movies = array();
$cinemaRepository = new CinemaRepository();
$showingRepository = new ShowingRepository($connection);
$cinema = new Cinema();

if (MethodCheck::checkInputMethod("id") == "GET") {
    if (!empty($_GET['id'])) {
        $cinema = $cinemaRepository->findBy($_GET['id']);
        $movies = $showingRepository->findCinemaShowings($cinema);
    }
}
?>
<!DOCTYPE html>
<!--
Made by M4ciej
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Seanse filmu</title>
    </head>
    <body>
        <?php
        echo "<h1> Kino: " . $cinema->getName() . "</h1>";
        echo "<div><h3>adres:</h3><p>".$cinema->getAddress()."</p>";
        echo "<hr/>";
        if ($movies) {
            echo "<h3>Wyświetlane filmy:</h3>";
            echo "<ul>";
            foreach ($movies as $key=>$movie) {
                echo "<li>" . $movie . " <a href='kupbilet.php?id=".$key."'>Kup bilet</a></li>";
            }
            echo "</ul>";
        }else{
            echo "<p>Nie znaleziono seansów</p>";
        }
        ?>
    </body>
</html>