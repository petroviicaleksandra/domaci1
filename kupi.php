<?php

require "dbBroker.php";
require "model/karte.php";
require "model/filmovi.php";

session_start();

$podaci = Karte::getAll($conn);
if (!$podaci) {
    echo "Nastala je greška pri preuzimanju podataka";
    die();
}
if ($podaci->num_rows == 0) {
    echo "Nema karata";
    die();
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include('templejt/header.php'); ?>
        <meta charset="UTF-8">
        <link rel="shortcut icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>Online kupovina karata</title>
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body class="grey lighten-4">

        <div class="row #cfd8dc blue-grey lighten-4" id="meni">
            <div class="col-md-6">
                <button id="btn" class="btn btn-info btn-block #37474f blue-grey darken-3"> Prikazi karte</button>
            </div>
            <div class="col-md-6">
                <button id="btn-pretraga" class="btn btn-warning btn-block #37474f blue-grey darken-3" "> Pretrazi karte</button>
                <input class="#37474f blue-grey darken-3" type="text" id="myInput" onkeyup="funkcijaZaPretragu()" placeholder="Pretrazi karte po korisniku" hidden>
            </div>
        </div>

        <div id="pregled" class="panel panel-success" style="margin-top: 1%;">

            <div class="panel-body grey lighten-4">
                <table id="myTable" class="table  table-striped #b0bec5 blue-grey lighten-3" style="color: black; background-color: grey;">
                    <thead class="thead">
                        <tr>
                            <th scope="col">Korisnik ID</th>
                            <th scope="col">Film ID</th>
                            <th scope="col">e-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($red = $podaci->fetch_array()) :
                        ?>
                            <tr>
                                <td><?php echo $red["userId"] ?></td>
                                <td><?php echo $red["filmId"] ?></td>
                                <td><?php echo $red["email"] ?></td>
                                <td>
                                    <label class="custom-radio-btn ">
                                        <input type="radio" name="checked-donut" value=<?php echo $red["brojKarte"] ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                </td>

                            </tr>
                    <?php
                        endwhile;
                    }
                    ?>

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-4" style="text-align: left">
                        <button id="btn-izmeni" class="btn btn-warning #37474f blue-grey darken-3" data-toggle="modal" data-target="#izmeniModal">Izmeni</button>

                    </div>

                    <div class="col-md-4" style="text-align: right">
                        <button id="btn-obrisi" formmethod="post" class="btn btn-danger #37474f blue-grey darken-3" >Obrisi</button>
                    </div>

                    <div class="col-md-4" style="text-align: center;">
                        <button id="btn-sortiraj" class="btn btn-normal #37474f blue-grey darken-3" onclick="sortTable()">Sortiraj</button>
                    </div>

                </div>
            </div>
        </div>




        </div>

        <div class="modal fade #eceff1 blue-grey lighten-5" id="izmeniModal" role="dialog">
            <div class="modal-dialog #eceff1 blue-grey lighten-5">

                <div class="modal-content #eceff1 blue-grey lighten-5">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container prijava-form ">
                            <form action="#" method="post" id="izmeniForm">
                                <h3 style="color: black">Izmeni kartu</h3>
                                <div class="row #eceff1 blue-grey lighten-5">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input id="brojKarte" type="text" name="brojKarte" class="form-control" placeholder="Broj karte *" value="" readonly />
                                        </div>
                                        <div class="form-group">
                                            <input id="predmet" type="text" name="user" class="form-control" placeholder="User*" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input id="katedra" type="text" name="film" class="form-control" placeholder="Film *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input id="sala" type="text" name="email" class="form-control" placeholder="email *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <button id="btnIzmeni" type="submit" class="btn btn-success btn-block #37474f blue-grey darken-3" > Izmeni
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
                    </div>
                </div>



            </div>

        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

        <script>
            function sortTable() {
                var table, rows, switching, i, x, y, shouldSwitch;
                table = document.getElementById("myTable");
                switching = true;

                while (switching) {
                    switching = false;
                    rows = table.rows;
                    for (i = 1; i < (rows.length - 1); i++) {
                        shouldSwitch = false;
                        x = rows[i].getElementsByTagName("TD")[1];
                        y = rows[i + 1].getElementsByTagName("TD")[1];
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                    if (shouldSwitch) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                    }
                }
            }

            function funkcijaZaPretragu() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }
        </script>
        <ul id="nav-mobile" class="right hide-on-small-and-down">
            <li><a href="home.php" class="btn brand #37474f blue-grey darken-3">Nazad</a></li>
        </ul>
        <?php include('templejt/footer.php'); ?>
    </body>

    </html>