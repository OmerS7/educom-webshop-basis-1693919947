<?php

function showLoginHeader() {
    echo 'Login';
}

include 'utils.php';

function showLoginContent() {
    $email = $password = "";
    $emailErr = $passwordErr = "";
    $valid = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = testInput(getPostVar("email"));
    $password - testInput(getPostVar("password"));

    if (empty($email)) { 
        $emailErr = "Voer een emailadres in"; 
    }

    if (empty($password)) { 
        $passwordErr = "Voer geldig wachtwoord in"; 
    } 

    if (empty($emailErr) && empty($passwordErr)){
        $fileContent = fopen("users.txt");
        $valid = false;
    }
}   


if (!$valid) {

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
}
?>