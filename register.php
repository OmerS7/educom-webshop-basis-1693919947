<?php

function showRegisterHeader() {
    echo 'Nu registreren';
}

include 'utils.php';

    function showRegisterContent() {
        $username = $email = $password = $repeatpassword = "";
        $usernameErr = $emailErr = $passwordErr = $repeatpasswordErr = "";
        $valid = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = testInput(getPostVar("name"));
        if (empty($username)) { 
            $nameErr = "Voer een naam in"; 
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
        if (empty($password)) { 
            $repeatpasswordErr = "Herhaal het wachtwoord"; 
        } 

        if ($password !== $repeatpassword) {
            $repeatpasswordErr = "Wachtwoorden komen niet overeen";
        }

        if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($repeatpasswordErr)){
            $valid = true;
        }

        $fileContent = fopen("users.txt", "r");

        $alreadyRegistered = false;

        while (!feof($fileContent)) {
            $line = fgets($fileContent);
            $userData = explode("|", $line);
            // Voeg hier je logica toe om te controleren of de gebruiker al geregistreerd is
                if ($userData[0] === $email) {
                $alreadyRegistered = true;
                break;
            }
        }

        fclose($fileContent);

        if ($alreadyRegistered) {
            echo "Deze gebruiker is al geregistreerd.";
            // Toon het registratieformulier opnieuw
        } else {
            // Voeg de nieuwe gebruiker toe aan users.txt
            $fileContent = fopen("users.txt", "a"); // 'a' opent het bestand voor schrijven, en behoudt bestaande inhoud
            fwrite($fileContent, "\n$email|$username|$password"); // $newUserData bevat de gegevens van de nieuwe gebruiker
            fclose($fileContent);
            echo "Registratie succesvol!";
        }
    }   

    
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

            <div class="signInButton">
            <input type="hidden" name="page" value="register">
                <input type="submit" value="Sign In">
            </div>
            </form>';
    } 
}
?>
