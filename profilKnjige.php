<?php
    session_start();
    $db = mysqli_connect("localhost", "root", "", "website");
    $naslov = $_POST['BookLink']; 
    $_SESSION['naslov']=$naslov;
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="index.css?id=2" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
      <div id="coverKnjige">
        <?php 
            $rezultat = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM knjige WHERE naslov='$naslov'"));
            $naslovnica = $rezultat['naslovnica'];
            echo '<img class="velikostCoverja" src="covers/'.$naslovnica.'" />';
        ?>
        <p>Dodaj knjigo na svojo knjižno polico:</p>
        <form id="dodajNaSvojoPolico" action="index.php" method="POST">
          <label for="Polica"></label>
            <select id="Polica" name="Polica">
            <option value="Prebrano" name="Prebrano">Prebrano</option>
            <option value="Trenutno berem" name="Trenutno berem">Trenutno berem</option>
            <option value="Želim prebrati" name="Želim prebrati">Želim prebrati</option>
            <option value="Odstrani iz polic" name="blank">Odstrani iz polic</option>
            </select> </br>
            <input type="submit" value="Dodaj na polico" name="dodajNaPolico" id="naPolico">
        </form>
      </div>  
      <div id="DisplayPodatkov">
        <?php 
            $rezultat = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM knjige WHERE naslov='$naslov'"));
            $avtor = $rezultat['avtor'];
            $zalozba = $rezultat['zalozba'];
            $letoIzdaje = $rezultat['leto_izdaje'];
            $strani = $rezultat['strani'];
            $opis = $rezultat['opis'];
        ?>
        <p id="displayNaslov"> <?php echo $naslov ?></p> 
        <p>Avtor</p>
        <p id="displayAvtorja"><?php echo $avtor ?></p>  </br>
        <p id="displayzalozbo">Založba:  <?php echo $zalozba ?></p> 
        <p id="displayLetoIzdaje">Izdano: <?php echo $letoIzdaje ?></p> 
        <p id="displayStrani">Strani: <?php echo $strani ?></p> 
        <p id="opis">Opis</p>
        <p id="displayOpis"> <?php echo $opis ?></p> </br>
      </div>

</body>
</html>