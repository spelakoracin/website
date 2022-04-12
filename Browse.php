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
    <script src="index.js"></script>
    <title>Browse</title>
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


      <div id="navigation">
        <form id="nav" action="" method="post">
            <p class="sort">STVARNA LITERATURA</p>
            <input type="checkbox" class="genres" name="zanr[]" value="Podjetništvo">
            <label for="genre1">Podjetništvo</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Znanost">
            <label for="genre2">Znanost</label><br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Psihologija">
            <label for="genre3">Psihologija</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Filozofija">
            <label for="genre4">Filozofija</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Biografija">
            <label for="genre5">Biografija</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Zgodovina">
            <label for="genre6">Zgodovina</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Religija">
            <label for="genre7">Religija</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Spiritualnost">
            <label for="genre8">Spiritualnost</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="KuharskeKnjige">
            <label for="genre9">Kuharske Knjige</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Popotništvo">
            <label for="genre10">Popotništvo</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Samopomoč">
            <label for="genr11">Samopomoč</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Šport">
            <label for="genre12">Šport</label>
            </br></br>

            <p class="sort">LEPOSLOVJE</p>
            <input type="checkbox" class="genres" name="zanr[]" value="Kriminalke">
            <label for="genre13">Kriminalke</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Fantazijske">
            <label for="genre14">Fantazijske</label><br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Ljubezenske">
            <label for="genre15">Ljubezenske</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Znanstvena fantastika">
            <label for="genre16">Znanstvena fantastika</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Pustolovske">
            <label for="genre17">Pustolovske</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="ZaMlade">
            <label for="genre18">Za mlade</label></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Poezija">
            <label for="genre19">Poezija</label></br></br></br>
            <input type="checkbox" class="genres" name="zanr[]" value="Drugo">
            <label for="genre20">Drugo</label>
            </br>
            <br><br><br><br>
            <input type="submit" value="Išči" id="isci" name="filtriraj">
        </form>
      </div>

      <div id="dodajKnjigovBazo">
        <form action="" method="POST">
          <input type="submit" value="Dodaj novo knjigo" name="DodajVBazo" class="DodajVBazo">
        </form>
      </div>


      <div class="bookContainer">
        <?php 
        if(isset($_POST['filtriraj'])){
            foreach($_POST['zanr'] as $zanr){

                $result = mysqli_query($db, "SELECT naslov, naslovnica FROM knjige WHERE zanr='$zanr'");
                if(!empty($result)){
                  while($rows=mysqli_fetch_assoc($result)){
        ?>  
                  <div class="prikazKnjige">
                  <?php echo '<img class="velikostNaslovnic" src="covers/'.$rows['naslovnica'].'" />';  ?> </br>
                  <form action="profilKnjige.php" method="POST">
                   <input type="submit" value="<?php echo $rows['naslov'] ?>" name="BookLink" class="BookLink">
                  </form>
                  </div>

         <?php 
                  }
                         
                }
            }
        }
        
        else{ 
            
            $sql = mysqli_query($db, "SELECT naslov, naslovnica FROM knjige"); 
            while($rows=mysqli_fetch_assoc($sql)){

            
          ?>
            <div class="prikazKnjige">
              <?php echo '<img class="velikostNaslovnic" src="covers/'.$rows['naslovnica'].'" />';  ?> </br>
              <form action="profilKnjige.php" method="POST">
                <input type="submit" class="BookLink" value="<?php echo $rows['naslov']?>" name="BookLink">
              </form>
            </div>

        <?php 
            }
          }
        ?>
        
      </div>
      <?php
        if(isset($_POST['DodajVBazo'])){
          echo '<script> window.open("dodajKnjigo.html","_self");</script>';
        }
      ?>
</body>
</html>