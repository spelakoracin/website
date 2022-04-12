
function showPassword() {
    var x = document.getElementById("inputPassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
}

function podvojenoIme() {
  alert ("Vneseno uporabniško ime je zasedeno.");
}
function podvojenEmail() {
  alert ("Vnesen email ime je že zaseden.");
}

function redirect(){
    window.open("Browse.php","_self");
}

