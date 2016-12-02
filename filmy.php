<?php
require_once 'bootstrap.php';
$movies = array();
/**
 * @property MovieRepository $movieRepository Description
 */
$movieRepository = new MovieRepository($connection);
$movies = $movieRepository->findAll();
?>
<!DOCTYPE html>
<!--
Made by M4ciej
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Film</title>
    </head>
    <body>
        <h1>Lista Filmów:</h1>
        <table>
            <tr><th>Tytuł</th></tr>
            <?php foreach ($movies as $movie): ?>
                <tr><td><a href="film.php?id=<?php echo $movie->getId(); ?>"><?php echo $movie->getName(); ?></a></td></tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
