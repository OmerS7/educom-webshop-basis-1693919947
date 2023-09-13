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
        $name = $email = $password = $repeatpassword = "";
        $nameErr = $emailErr = $passwordErr = $repeatpasswordErr = "";
        $valid = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Voer een naam in";
        } else {
            $name = test_input($_POST["name"]);
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

        if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($repeatpasswordErr)){
            $valid = true;
        }

        $fileContent = file_get_contents('users.txt');

        /*
        if (strpos($fileContent, $email) !== false) {
            $emailErr = "Dit e-mailadres is al geregistreerd.";
        } else {
            $newUserData = "$name,$email,$password\n";
            file_put_contents('users.txt', $newUserData, FILE_APPEND);
            $confirmationMessage = "Registratie succesvol!";
        }

        if (isset($confirmationMessage)) {
            echo '<p class="confirmation-message">' . $confirmationMessage . '</p>';
        }
        */
    }
    

    if (!$valid) {
   
      echo '<form method="POST" action="index.php">
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" value="'.$name.'">
            <span class="error">* '.$nameErr.'</span><br><br>

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
