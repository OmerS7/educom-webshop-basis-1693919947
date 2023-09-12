<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet"  href="CSS/stylesheet.css">
</head>
<body>
<?php
     function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
          }
    
    $name = $email = $phone = $salutation = $communication = $comment = "";
    $nameErr = $emailErr = $phoneErr = $salutationErr = $communicationErr = $commentErr = "";
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
        
        if (empty($_POST["phone"])){
            $phoneErr = "Voer een telefoonnummer in";
        } else {
            $phone = test_input($_POST["phone"]); 
        }

        if (empty($_POST["salutation"])){
            $salutationErr = "Aanhef verplicht";
        } else {
            $salutation = test_input($_POST["salutation"]); 
        }

        if (empty($_POST["communication"])){
            $communicationErr = "Voorkeur is verplicht";
        } else {
            $communication = test_input($_POST["communication"]); 
        }

        if (empty($_POST["comment"])){
            $commentErr = "Plaats een opmerking";
        } else {
            $comment = test_input($_POST["comment"]); 
        }

        if (empty($nameErr) && empty($emailErr) && empty($phoneErr) && empty($salutationErr) && empty($communicationErr) && empty($commentErr)) {
            $valid = true;
        }

    }
    ?>
    
    <header>
        <h1>Contact</h1>
    </header>

    <div class="menu">
        <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="about.php">ABOUT</a></li>
            <li><a href="contact.php">CONTACT</a></li>
        </ul>
    </div>

    <section>

    <?php if (!$valid) { ?>

    <form method="POST" action="contact.php">
        <div class="salutationbutton"></div>
            <label for="salutation">Kies uw aanhef:</label>
            <select id="salutation" name="salutation">
                <option value="sir">Heer</option>
                <option value="madam">Mevrouw</option>
                <option value="other">Anders</option>
            </select>
            <span class="error">* <?php echo $salutationErr;?></span>
                <br><br>     
        </div>    
        <div>
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" value="<?php echo $name;?>">
            <span class="error">* <?php echo $nameErr;?></span>
            <br><br>
        </div>
        <div> 
            <label for="phone">Telefoonnummer:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $phone;?>">
            <span class="error">* <?php echo $phoneErr;?></span>
            <br><br>
        </div>  
        <div>
            <label for="e-mail">E-mailadres:</label>
            <input type="e-mail" id="email" name="email" value="<?php echo $email;?>">
            <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
        </div>

        <div>
            <p>Kies uw voorkeur</p>
            <label>
                <input type="radio" name="communication" <?php if (isset($communication) && $communication =="Telefoonnummer") echo "checked";?> value="Telefoonnummer">
                Telefoonnummer
            </label>
            <br>
            <label>
                <input type="radio" name="communication" <?php if (isset($communication) && $communication =="E-mailadres") echo "checked";?> value="E-mailadres">
                E-mailadres
            </label>
            <span class="error">* <?php echo $communicationErr;?></span>
                <br><br>   
            </div>
            <div class="commentContact">
                <textarea id="comment" name="comment" rows="4" cols="50" placeholder="Voer hier je opmerkingen in"><?php echo $comment;?></textarea>
                <span class="error">* <?php echo $commentErr;?></span>
                <br><br>               </div>
            <div class="sendbutton"> 
                <input type="submit" value="Verzend">
            </div>
        </form>
        
        <?php } else {?>
            <p>Bedankt voor uw reactie:</p>
        <?php }?>
    </section>

    <footer>
        <p>&copy;</p>
        <p>2023</p>
        <p>Omer Seker</p>
    </footer>

</body>
</html>