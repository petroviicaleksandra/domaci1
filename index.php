<?php

require "dbBroker.php";
require "model/user.php";

session_start();
if(isset($_POST['username']) && isset($_POST['password'])){
    $uname = $_POST['username'];
    $upass = $_POST['password'];

    $user = new User(1, $uname, $upass);
    $odg = User::logInUser($user, $conn); 

    if($odg->num_rows==1){
        echo  `
        <script>
        console.log( "Uspešno ste se prijavili");
        </script>
        `;
        header('Location: home.php');
        exit();
    }else{
        echo `
        <script>
        console.log( "Niste se prijavili!");
        </script>
        `;
    }

}

?>

<!DOCTYPE html>
<html>
	
	<?php include('templejt/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Uloguj se:</h4>
		<form class="white" action="home.php" method="POST">
			<label>Korisnicko ime</label>
			<input type="text" name="email" class="form-control"  required>
			<label>Lozinka</label>
			<input type="password" name="password" class="form-control"  required>
			<div class="center">
				<input type="submit" name="submit" value="Prijava" class="btn brand #37474f blue-grey darken-3">
			</div>
		</form>
	</section>

	<?php include('templejt/footer.php'); ?>

</html>