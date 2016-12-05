<?php
require_once 'bootstrap.php';
$cinemas = array();
/**
 * @property MovieRepository $cinemaRepository Description
 */
$cinemaRepository = new CinemaRepository();
$cinemas = $cinemaRepository->findAll();
?>
<!DOCTYPE html>
<!--
Made by M4ciej
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Kina</title>
    </head>
    <body>
        <h1>Lista Kin:</h1>
        <table>
            <tr><th>Nazwa</th><th>Adres</th></tr>
            <?php foreach ($cinemas as $cinema): ?>
                <tr>
                    <td>
                        <a href="kino.php?id=<?php echo $cinema->getId(); ?>"><?php echo $cinema->getName(); ?></a>
                    </td>
                    <td><?php echo $cinema->getAddress();?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>
