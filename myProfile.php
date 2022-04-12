<?php 
session_start();
$db = mysqli_connect("localhost", "root", "", "website");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="index.css?id=5" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moj profil</title>
    <script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous">
    </script>
    <script> 
    $(function(){
      $(".header").load("header.html"); 
    });
    </script> 
</head>
<body>
  <div class="header"></div>

  <div id="mojProfil">
        <div class="podatkiOProfilu"><p>Uporabniško ime:</p>
            <p class="izpisPodatkov"> 
            <?php 
              $id_uporabnika = $_SESSION['id_uporabnika'];
              $uporabnik = mysqli_fetch_assoc(mysqli_query($db, "SELECT uporabnisko_ime FROM uporabniki WHERE id_uporabnika='$id_uporabnika'"));
              $rezultat = $uporabnik['uporabnisko_ime'];
              echo $rezultat;
            ?>
            </p>
          </br></br>
        </div>  
        <div class="podatkiOProfilu"><p>Email:</p>
          <p class="izpisPodatkov">
          <?php 
                $id_uporabnika = $_SESSION['id_uporabnika'];
                $email = mysqli_fetch_assoc(mysqli_query($db, "SELECT email FROM uporabniki WHERE id_uporabnika='$id_uporabnika'"));
                $rezultat = $email['email'];
                echo $rezultat;
              ?>
          </p>
          </br></br>
        </div>
        <div class="podatkiOProfilu"><p>Datum rojstva:</p>
          <p class="izpisPodatkov">
              <?php 
                $id_uporabnika = $_SESSION['id_uporabnika'];
                $datum_r = mysqli_fetch_assoc(mysqli_query($db, "SELECT datum_rojstva FROM uporabniki WHERE id_uporabnika='$id_uporabnika'"));
                $rezultat = $datum_r['datum_rojstva'];
                echo $rezultat;
              ?>
          </p>
          </br></br></br>
        </div>

        <div>
          <form  name="logOutForm" method="post" action="logOut.php">
            <label>
              <input type="submit" id="logOutButton" name="logout" value="Odjava iz profila">
            </label>  
          </form>
        </div>
         
  </div>
</body>
</html>