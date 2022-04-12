<?php 
    session_start();
    $db = mysqli_connect("localhost", "root", "", "website");
    //dodaj knjigo
    $msg ="";
    if(isset($_POST['upload'])){
        //path to store the uploaded image
        $target = "covers/".basename($_FILES['naslovnica']['name']);
    

        //connect to database
        $db = mysqli_connect("localhost", "root", "", "website");

        
        $naslov = $_POST['naslov'];
        $avtor = $_POST['avtor'];
        $zalozba = $_POST['zalozba'];
        $izdaja = $_POST['izdaja'];
        $strani = $_POST['strani'];
        $zanr = $_POST['zanr'];
        $opis = $_POST['opis'];
        $image = $_FILES['naslovnica']['name'];

        $sql = "INSERT INTO knjige(naslov, avtor, zalozba, leto_izdaje, strani, zanr, opis, naslovnica) 
                VALUES ('$naslov', '$avtor', '$zalozba', '$izdaja', '$strani', '$zanr', '$opis', '$image')";
        mysqli_query($db, $sql);

        //move uploaded image into the folder:covers
        if(move_uploaded_file($_FILES['naslovnica']['tmp_name'], $target)){
            $msg = "Image uploaded successfully";
        }else{
            $msg = "There was a problem uploading image";
        }

        
    }
    

   //gumb za dodajanje knjige
   if(isset($_POST['addbutton'])){
    echo '<script> window.open("Browse.php","_self");</script>';

   }

   //dodajanje knjige na police
    if(isset($_POST['dodajNaPolico'])){
        $naslov = $_SESSION['naslov'];
        $imePolice = $_POST['Polica'];


        if($imePolice=="Prebrano"){
        $id_user = $_SESSION['id_uporabnika'];
        $knjiga = mysqli_fetch_assoc(mysqli_query($db, "SELECT ID_knjige FROM knjige WHERE naslov='$naslov'"));
        $id_knjige = $knjiga['ID_knjige'];
        mysqli_query($db, "INSERT INTO prebrano(ID_knjige, ID_uporabnika) VALUES ('$id_knjige', '$id_user')");
        echo "<script> alert('Knjigo si dodal na svojo polico.')</script>";
        
        }
        else if($imePolice=="Trenutno berem"){
            $id_user = $_SESSION['id_uporabnika'];
            $knjiga = mysqli_fetch_assoc(mysqli_query($db, "SELECT ID_knjige FROM knjige WHERE naslov='$naslov'"));
            $id_knjige = $knjiga['ID_knjige'];
            mysqli_query($db, "INSERT INTO berem(ID_knjige, ID_uporabnika) VALUES ('$id_knjige', '$id_user')");
            echo "<script> alert('Knjigo si dodal na svojo polico.')</script>";
        
        }
        else if($imePolice=="Želim prebrati"){
             
            $id_user = $_SESSION['id_uporabnika'];
            $knjiga = mysqli_fetch_assoc(mysqli_query($db, "SELECT ID_knjige FROM knjige WHERE naslov='$naslov'"));
            $id_knjige = $knjiga['ID_knjige'];
            mysqli_query($db, "INSERT INTO zelim_prebrati(ID_knjige, ID_uporabnika) VALUES ('$id_knjige', '$id_user')");
            echo "<script> alert('Knjigo si dodal na svojo polico.')</script>";
            
        }
        else if($imePolice=="Odstrani iz polic"){            
            $id_user = $_SESSION['id_uporabnika'];
            $knjiga = mysqli_fetch_assoc(mysqli_query($db, "SELECT ID_knjige FROM knjige WHERE naslov='$naslov'"));
            $id_knjige = $knjiga['ID_knjige'];
            mysqli_query($db, "DELETE FROM prebrano WHERE ID_knjige = '$id_knjige' AND ID_uporabnika = '$id_user'");
            mysqli_query($db, "DELETE FROM zelim_prebrati WHERE ID_knjige = '$id_knjige' AND ID_uporabnika = '$id_user'");
            mysqli_query($db, "DELETE FROM berem WHERE ID_knjige = '$id_knjige' AND ID_uporabnika = '$id_user'");
            echo "<script> alert('Knjigo si odstranil iz polic.')</script>";
            
        }
        echo '<script> window.open("Browse.php","_self");</script>'; 
    }
?>