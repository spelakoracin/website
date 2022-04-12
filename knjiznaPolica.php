<?php 
session_start();
$db = mysqli_connect("localhost", "root", "", "website");

?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="stylesheet" type="text/css" href="index.css?id=6" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index page</title>
    <script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous">
    </script>
    <script> 
    $(function(){
      $(".header").load("header.html?id=2"); 
    });
    </script> 
</head>
<body>
    <div class="header"></div>
    
      </div>
      <section>
        <section class="bookshelf">
            <h1>Knjižna polica</h1>
            <div id="read">
            <form action="" method="post">
             <input type="submit" class= "polica" value="Prebrano" name="prikaziPrebrano">
            </form>
          </div>
          <div id="currentlyreading">
            <form action="" method="post">
             <input type="submit" class= "polica" value="Trenutno berem" name="prikaziTrenutno">
            </form>
          </div>
          <div id="wanttoread">
            <form action="" method="post">
             <input type="submit" class= "polica" value="Želim prebrati" name="prikaziZelim">
            </form>
          </div>
          <div>
            <form method="post" action="index.php">
              <input type="submit" name="addbutton" class="addToBookShelf"
                      value="Dodaj knjigo"/>

          </form>
          </div>
        </section>
        <section class="booklist">
                <div class="bookdata">
                    <a class="cover"><b>NASLOVNICA</b></a>
                    <a class="title" ><b>NASLOV</b></a>
                    <a class="author"><b>AVTOR</b></a>   
                    <a class="yearreleased"><b>LETO IZDAJE</b></a>
                    <a class="dateadded"><b>STRANI</b></a>
                </div>
        </section>
        
      </section>
      
      <?php 
        if(isset($_POST['prikaziPrebrano'])){
            $id_user= $_SESSION['id_uporabnika'];
            $sql = mysqli_query($db, "SELECT * FROM prebrano WHERE ID_uporabnika = '$id_user'");
            while($rows=mysqli_fetch_assoc($sql)){    
              $id_knjige = $rows['ID_knjige'];
              $_SESSION['id_knjige'] = $id_knjige;
              $result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM knjige WHERE ID_knjige = '$id_knjige'"));       
      ?>

            <div class="prikazPolice">
              <div id = "posameznaNaslovnica">
              <?php echo '<img class="velikostPrikazanihNaslovnic" src="covers/'.$result['naslovnica'].'" />';  ?> </br>
              </div>
              <div id="posamezenNaslov">
                <form action="profilKnjige.php" method="POST">
                  <input type="submit" class="BookLink" value="<?php echo $result['naslov']?>" name="BookLink">
                </form>
              </div>
              <div class="posamezniPodatki">
              <?php echo $result['avtor']?>
              </div>
              <div class="posamezniPodatki">
              <?php echo $result['leto_izdaje']?>
              </div>
              <div id="posamezneStrani">
              <p><?php echo $result['strani']?></p>
              </div>
            </div>
            
      <?php
            }
        }
      ?>
      <?php 
        if(isset($_POST['odstraniPrebrano'])){
            $id_knjige = $_SESSION['id_knjige'];
            $id_user = $_SESSION['id_uporabnika'];

            $odstrani = mysqli_query($db, "DELETE FROM prebrano WHERE ID_knjige ='$id_knjige' AND ID_uporabnika ='$id_user'");
        }

      ?>




      <?php 
        if(isset($_POST['prikaziTrenutno'])){
            $id_user= $_SESSION['id_uporabnika'];
            $sql = mysqli_query($db, "SELECT * FROM berem WHERE ID_uporabnika = '$id_user'");
            while($rows=mysqli_fetch_assoc($sql)){    
              $id_knjige = $rows['ID_knjige'];
              $result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM knjige WHERE ID_knjige = '$id_knjige'")); 
              $_SESSION['naslovKnjige']=$result['naslov'];    
      ?>

            <div class="prikazPolice">
              <div id = "posameznaNaslovnica">
              <?php echo '<img class="velikostPrikazanihNaslovnic" src="covers/'.$result['naslovnica'].'" />';  ?> </br>
              </div>
              <div id="posamezenNaslov">
                <form action="profilKnjige.php" method="POST">
                  <input type="submit" class="BookLink" value="<?php echo $result['naslov']?>" name="BookLink">
                </form>
              </div>
              <div class="posamezniPodatki">
              <?php echo $result['avtor']?>
              </div>
              <div class="posamezniPodatki">
              <?php echo $result['leto_izdaje']?>
              </div>
              <div id="posamezneStrani">
              <p><?php echo $result['strani']?></p>
              </div>
            </div>
      <?php
            }
        }
      ?>

    

      <?php 
        if(isset($_POST['prikaziZelim'])){
            $id_user= $_SESSION['id_uporabnika'];
            $sql = mysqli_query($db, "SELECT * FROM zelim_prebrati WHERE ID_uporabnika = '$id_user'");
            while($rows=mysqli_fetch_assoc($sql)){    
              $id_knjige = $rows['ID_knjige'];
              $result = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM knjige WHERE ID_knjige = '$id_knjige'"));       
      ?>

            <div class="prikazPolice">
              <div id = "posameznaNaslovnica">
              <?php echo '<img class="velikostPrikazanihNaslovnic" src="covers/'.$result['naslovnica'].'" />';  ?> </br>
              </div>
              <div id="posamezenNaslov">
                <form action="profilKnjige.php" method="POST">
                  <input type="submit" class="BookLink" value="<?php echo $result['naslov']?>" name="BookLink">
                </form>
              </div>
              <div class="posamezniPodatki">
              <?php echo $result['avtor']?>
              </div>
              <div class="posamezniPodatki">
              <?php echo $result['leto_izdaje']?>
              </div>
              <div id="posamezneStrani">
              <p><?php echo $result['strani']?></p>
              </div>
            </div>
      <?php
            }
        }
      ?>

      
</body>
</html>