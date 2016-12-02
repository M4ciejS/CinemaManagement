<?php
require_once '../bootstrap.php';
session_start();
if ((!isset($_SESSION['logged'])) || ($_SESSION['logged'] == false)) {
    die("Nie Jesteś zalgowany");
}
?>
<!DOCTYPE html>
<!--
Made by M4ciej
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        var_dump($_GET);
        if (MethodCheck::checkInputMethod("action") == false):
            $cinemas = array();
            /**
             * @property MovieRepository $cinemaRepository Description
             */
            $cinemaRepository = new CinemaRepository($connection);
            $cinemas = $cinemaRepository->findAll();
            ?>
            <h1>Lista Kin:</h1>
            <table>
                <tr><th>Nazwa</th><th>Adres</th></tr>
                <?php foreach ($cinemas as $cinema): ?>
                    <tr>
                        <td>
                            <?php echo $cinema->getName(); ?>
                        </td>
                        <td>
                            <?php echo $cinema->getAddress(); ?>
                        </td>
                        <td>
                            <a href="kina.php?action=delete&id=<?php echo $cinema->getId(); ?>">Usuń Kino</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td><a href="kina.php?action=add">Dodaj Kino</td>
                </tr>
            </table>
        <?php
        else:
            switch ($_GET['action']) {
                case "add":?>
            <h2>Dodaj Kino</h2>
            <form method="POST" action="kina.php?action=addCinema">
                <label>Nazwa</label>
                <input type="text" name="cinemaName"/><br/>
                <label>Adres</label>
                <input type="text" name="cinemAddress"/><br/>
                <input type="submit" value="Dodaj">
            </form>
            <?php
                    break;
                case "addCinema":
                    $cinema=new Cinema(trim($_POST['cinemaName']), trim($_POST['cinemaAddress']));
                    var_dump($cinema);
                    break;
                case "delete":
                    break;
            }

        endif;
        ?>

    </body>
</html>
