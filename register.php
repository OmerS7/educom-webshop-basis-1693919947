<?php

function showRegisterHeader() {
    echo 'Nu registreren';
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

    function showRegisterContent() {
        $username = $email = $password = $repeatpassword = "";
        $usernameErr = $emailErr = $passwordErr = $repeatpasswordErr = "";
        $valid = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $usernameErr = "Voer een naam in";
        } else {
            $username = test_input($_POST["name"]);
        }

        if (empty($_POST["email"])){
            $emailErr = "Voer een emailadres in";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Voer een geldig emailadres in";
            }
        }

        if (empty($_POST["password"])){
            $passwordErr = "Voer geldig wachtwoord in";
        } else {
            $password = test_input($_POST["password"]);
        }

        if (empty($_POST["repeatpassword"])){
            $repeatpasswordErr = "Herhaal het wachtwoord";
        } else {
            $repeatpassword = test_input($_POST["repeatpassword"]);
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
