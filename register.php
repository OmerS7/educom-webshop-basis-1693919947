<?php

function showRegisterHeader() {
    echo 'Nu registreren';
}

require 'utils.php';
require 'file_repository.php';
require 'user_service.php';

    function showRegisterContent() {
        $username = $email = $password = $repeatpassword = "";
        $usernameErr = $emailErr = $passwordErr = $repeatpasswordErr = "";
        $valid = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = testInput(getPostVar("name"));
        if (empty($username)) { 
            $usernameErr = "Voer een naam in"; 
        } 

        $email = testInput(getPostVar("email"));
        if (empty($email)) { 
            $emailErr = "Voer een emailadres in"; 
        } 

        $password = testInput(getPostVar("password"));
        if (empty($password)) { 
            $passwordErr = "Voer geldig wachtwoord in"; 
        } 

        $repeatpassword = testInput(getPostVar("repeatpassword"));
        if (empty($repeatpassword)) { 
            $repeatpasswordErr = "Herhaal het wachtwoord"; 
        } 

        if ($password !== $repeatpassword) {
            $repeatpasswordErr = "Wachtwoorden komen niet overeen";
        }

        if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($repeatpasswordErr)){

            $alreadyRegistered = false;
        }else{
            $alreadyRegistered = true;
                $emailErr = "Dit e-mailadres is al geregistreerd.";
           }
        }
    
    /*
     echo "Registratie succesvol!";
    */

    if (!$valid) {
   
      echo '<form method="POST" action="index.php">
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" value="'.$username.'">
            <span class="error">* '.$usernameErr.'</span><br><br>

            <label for="email">E-mailadres:</label>
            <input type="text" id="email" name="email" value="'.$email.'">
            <span class="error">* '.$emailErr.'</span><br><br>

            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" value="'.$password.'">
            <span class="error">* '.$passwordErr.'</span><br><br>

            <label for="repeatpassword">Herhaal wachtwoord:</label>
            <input type="password" id="repeatpassword" name="repeatpassword" value="'.$repeatpassword.'">
            <span class="error1">* '.$repeatpasswordErr.'</span><br><br>

            <div class="signUpButton">
            <input type="hidden" name="page" value="register">
                <input type="submit" value="Sign Up">
            </div>
            </form>';
    } 
}
?>
