<?php
        session_start();
        $db = mysqli_connect("localhost", "root", "", "website");

        if (isset($_POST['login'])){
            //connect to database
            $uporabnisko_ime = $_POST['ime'];
            $geslo = $_POST['geslo'];
            $pravoGeslo = mysqli_query($db, "SELECT geslo FROM uporabniki WHERE uporabnisko_ime='$uporabnisko_ime'");

            $hashGeslo = mysqli_fetch_assoc($pravoGeslo);
            $stringGeslo = $hashGeslo['geslo'];
        
            if(password_verify($geslo, $stringGeslo)){
                echo "<script> alert('Uspešno si se prijavil v svoj račun')</script>";
            }
            else {
                echo "<script> alert('Napačno uporabniško ime ali geslo')</script>";
            }
            echo '<script> window.open("knjiznaPolica.php","_self");</script>';
        
            $uporabnik = mysqli_fetch_assoc(mysqli_query($db, "SELECT ID_uporabnika FROM uporabniki WHERE uporabnisko_ime='$uporabnisko_ime'"));
            $id_user = $uporabnik['ID_uporabnika'];
            $_SESSION['valid'] = true;
            $_SESSION['id_uporabnika'] = $id_user;
        }   

?>