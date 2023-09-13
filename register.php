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
            $repeatpasswordErr = "Wachtwoord komt niet overeen";
        } else {
            $repeatpassword = test_input($_POST["repeatpassword"]);
        }

        if (empty($nameErr) && empty($emailErr) && empty($passwordErr) && empty($repeatpasswordErr)){
            $valid = true;
        }
    }
    
    if (!$valid) {
   
      echo '<form method="POST" action="register.php">
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
            <span class="error">* '.$repeatpasswordErr.'</span><br><br>

            <div class="signInButton">
            <input type="hidden" name="page" value="contact">
                <input type="submit" value="Sign In">
            </div>
            </form>';
    } else {
            echo '<p>Bedankt voor uw reactie.</p>';
    }
}
?>
