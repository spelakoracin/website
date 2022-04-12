<?php 
    session_start();
    $db = mysqli_connect("localhost", "root", "", "website"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="display.css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php 
        if(isset($_POST['filtriraj'])){
            foreach($_POST['zanr'] as $zanr){

                $result = mysqli_query($db, "SELECT naslov, naslovnica FROM knjige WHERE zanr='$zanr'");
                while($rows=mysqli_fetch_assoc($result)){
    ?>  
                <div class="prikazKnjige">
                <?php echo '<img class="velikostNaslovnic" src="covers/'.$rows['naslovnica'].'" />';  ?> </br>
                <?php echo '<p class="prikazNaslovov"> '.$rows['naslov'].' </p>'?>
                </div>

    <?php 
                }
            }
        }
    ?>

    
</body>
</html>

<button class="dropbtn">Prebrskaj</button>