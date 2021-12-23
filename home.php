<?php

require "dbBroker.php";
require "model/filmovi.php";
require "model/user.php";


session_start();


$podaci = Filmovi::getAll($conn);
$korisnici = User::getAll($conn);
if (!$podaci) {
    echo "Nastala je greška pri preuzimanju podataka";
    die();
}
if ($podaci->num_rows == 0) {
    echo "Nema filmova";
    die();
} else {

?>
    <!DOCTYPE html>
    <html lang="en">
    <?php include('templejt/header.php'); ?>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Filmovi</title>
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body class="grey lighten-4">

        <div id="pregled" class="panel panel-success " style="margin-top: 1%;">

            <div class="panel-body">
                <table id="myTable" class="table striped #b0bec5 blue-grey lighten-3 " style="color: black; background-color: grey lighten-4;">
                    <thead class="thead">
                        <tr>
                            <th scope="col">Film ID</th>
                            <th scope="col">Naziv</th>
                            <th scope="col">Trajanje</th>
                            <th scope="col">Zanr</th>
                            <th scope="col">Datum projekcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($red = $podaci->fetch_array()) :
                        ?>
                            <tr>
                                <td><?php echo $red["filmId"] ?></td>
                                <td><?php echo $red["naziv"] ?></td>
                                <td><?php echo $red["trajanje"] ?></td>
                                <td><?php echo $red["zanr"] ?></td>
                                <td><?php echo $red["datum"] ?></td>


                            </tr>
                    <?php
                        endwhile;
                    }
                    ?>

                    </tbody>
                </table>
                <br>
                <br>
                <br>

            </div>
            <div class="panel-body">
                <table id="myTable2" class="table striped #b0bec5 blue-grey lighten-3" style="color: black; background-color: grey;">
                    <thead class="thead">
                        <tr>
                            <th scope="col">Korisnik ID</th>
                            <th scope="col">Korisnicko ime</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($red2 = $korisnici->fetch_array()) :
                        ?>
                            <tr>
                                <td><?php echo $red2["UserId"] ?></td>
                                <td><?php echo $red2["username"] ?></td>

                            </tr>
                        <?php
                        endwhile;

                        ?>

                    </tbody>
                </table>

            </div>
        </div>
        </div>
        </div>
        </div>
        <div class="container prijava-form">
            <form action="#" method="post" id="dodajForm">
                <h3 style="color: black; text-align: center">Kupi kartu</h3>
                <div class="row">
                    <div class="col-md-11 ">
                        <div class="form-group">
                            <label for="">User</label>
                            <input type="text" style="border: 1px solid black" name="user" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="">Film</label>
                            <input type="text" style="border: 1px solid black" name="film" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" style="border: 1px solid black" name="email" class="form-control" />
                        </div>
                        <div class="form-group">
                            <button id="btnDodaj" type="submit" class="btn btn-success btn-block #37474f blue-grey darken-3" ">Kupi</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
            <li><a href="kupi.php" class="btn brand #37474f blue-grey darken-3">Pregled svih karti</a></li>
        </ul>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

        <?php include('templejt/footer.php'); ?>
    </body>

    </html>