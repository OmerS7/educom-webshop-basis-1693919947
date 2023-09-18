<?php

function showLoginHeader() {
    echo 'Login';
}

include 'utils.php';

function showLoginContent() {
/* session_start(); // Start de sessie

    if (isset($_SESSION['email'])) {
        // De gebruiker is al ingelogd
        $ingelogdeEmail = $_SESSION['email'];
        echo "Je bent al ingelogd als $ingelogdeEmail.";
        return; // Je kunt hier eventueel iets anders doen, bijvoorbeeld doorverwijzen naar een andere pagina.
    }
*/

    $email = $password = "";
    $emailErr = $passwordErr = "";
    $valid = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = testInput(getPostVar("email"));
    $password = testInput(getPostVar("password"));

    if (empty($email)) { 
        $emailErr = "Voer een emailadres in"; 
    }

    if (empty($password)) { 
        $passwordErr = "Voer geldig wachtwoord in"; 
    } 

    if (empty($emailErr) && empty($passwordErr)){
        $fileContent = file("users.txt");

        foreach($fileContent as $line){
            list($storedEmail, , $storedPassword) = explode("|", $line);

            if ($email == $storedEmail && $password == $storedPassword) {
                $valid = true;
                break;
            }
        }
    } 
}   

        if ($valid) {
            session_start();
            $_SESSION['email'] = $email;
            
        } else {
            $emailErr = "Onbekend emailadres of onjuist wachtwoord";
    }  

echo "Ingevoerd emailadres: $email<br>";
echo "Ingevoerd wachtwoord: $password<br>";
echo "Opslagen emailadres: $storedEmail<br>";
echo "Opslagen wachtwoord: $storedPassword<br>";


  echo '<form method="POST" action="index.php">
        <label for="email">E-mailadres:</label>
        <input type="text" id="email" name="email" value="'.$email.'">
        <span class="error">* '.$emailErr.'</span><br><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" value="'.$password.'">
        <span class="error">* '.$passwordErr.'</span><br><br>

        <div class="signInButton">
        <input type="hidden" name="page" value="login">
            <input type="submit" value="Sign In">
        </div>
        </form>';
} 
?>