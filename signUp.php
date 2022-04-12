
<?php 

    session_start();
    
    if(isset($_POST['signup'])){
        //connect to database
        $db = mysqli_connect("localhost", "root", "", "website");


        $ime = $_POST['ime'];
        $priimek = $_POST['priimek'];
        $uporabnisko_ime = $_POST['uporabnisko_ime'];
        $email = $_POST['email'];
        $geslo = $_POST['geslo'];
        $datum_rojstva = $_POST['datum_rojstva'];
        if(isset($_POST['spol'])) {
            $spol = $_POST['spol'];
        }

        $preveriUporabniskaImena = mysqli_query($db, "SELECT uporabnisko_ime FROM uporabniki WHERE uporabnisko_ime= '$uporabnisko_ime'"); 
        $stevilo1 = mysqli_num_rows($preveriUporabniskaImena);
        $preveriEmail = mysqli_query($db, "SELECT email FROM uporabniki WHERE email='$email'");
        $stevilo2 = mysqli_num_rows($preveriEmail);

        if($stevilo1 == 1){
            echo "<script> alert('Vneseno uporabniško ime je že zasedeno.')</script>";
        }
        else if($stevilo2 == 1){
            echo "<script> alert('Vneseni email je že zaseden.')</script>";
        }else{
            $hashed_password = password_hash($geslo, PASSWORD_DEFAULT);
            $sql = "INSERT INTO uporabniki(ime, priimek, uporabnisko_ime, email, geslo, datum_rojstva, spol) 
                VALUES ('$ime', '$priimek', '$uporabnisko_ime', '$email', '$hashed_password', '$datum_rojstva', '$spol')";
            mysqli_query($db, $sql);
            header('location:login.html');
        }

    }

    
?>
