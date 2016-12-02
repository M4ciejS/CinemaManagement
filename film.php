<?php
require_once 'bootstrap.php';
$cinemas = array();
/**
 * @property MovieRepository $movieRepository Description
 */
$movieRepository = new MovieRepository($connection);
$showingRepository = new ShowingRepository($connection);
$movie = new Movie();

if (MethodCheck::checkInputMethod("id") == "GET") {
    if (!empty($_GET['id'])) {
        $movie = $movieRepository->findBy($_GET['id']);
        $cinemas = $showingRepository->findMovieShowings($movie);
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
        echo "<h1> Film: " . $movie->getName() . "</h1>";
        echo "<div><h3>Opis:</h3><p>".$movie->getDescription()."</p>"
                . "<span>Ocena:".$movie->getRating()."</span>";
        echo "<hr/>";
        if ($cinemas) {
            echo "<h3>Wyświetlany w kinach:</h3>";
            echo "<ul>";
            foreach ($cinemas as $key=>$cinema) {
                echo "<li>" . $cinema . " <a href='kupbilet.php?id=".$key."'>Kup bilet</a></li>";
            }
            echo "</ul>";
        }else{
            echo "<p>Nie znaleziono seansów</p>";
        }
        ?>
    </body>
</html>
