<!DOCTYPE html>
<html>
<head>
        <link rel="stylesheet"  href="CSS/stylesheet.css">
</head>
<body>
<?php
    $name = $email = $phone = $gender "";
    $nameErr = $emailErr = $phoneErr = $genderERR = "";
    $valid = false;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
          $nameErr = "Name is required";
        } else {
          $name = test_input($_POST["name"]);
          if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
          }
        }

        if (empty($_POST["email"])){
            $emailERR = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
              }
        }
        
        if (empty($_POST["phone"])){
            $phoneERR = "Phone is required";
        } else {
            $phone = test_input($_POST["phone"]); 
        }

        if (empty($_POST["gender"])){
            $genderERR = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]); 
        }
    }
    ?>
    
    <header>
        <h1>Mijn eerste website</h1>
    </header>

    <div class="menu">
        <ul>
            <li><a href="about.index">HOME</a></li>
            <li><a href="about.html">ABOUT</a></li>
            <li><a href="contact.html">CONTACT</a></li>
        </ul>
    </div>
    <?php if (!$valid) { ?>
        <form method="POST" action="contact.php">;

    <form action="post">
        <div class="salutationbutton"></div>
            <label for="salutation">Kies uw aanhef:</label>
            <select id="salutation" name="aanhef">
                <option value="sir">Heer</option>
                <option value="madam">Mevrouw</option>
                <option value="other">Anders</option>
                <span class="error">* <?php echo $nameErr;?></span>
            <br><br>     
        </select>   
        </div>    
        <div>
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name">
            <span class="error">* <?php echo $nameErr;?></span>
            <br><br>
        </div>
        <div> 
            <label for="phone">Telefoonnummer:</label>
            <input type="tel" id="phone" name="phone">
            <span class="error">* <?php echo $phoneErr;?></span>
            <br><br>
        </div>  
        <div>
            <label for="e-mail">E-mailadres:</label>
            <input type="e-mail" id="email" name="email">
            <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
        </div>

        <div>
            <p>Kies uw voorkeur</p>
            <label>
                <input type="radio" name="communication" value="cellphone">
                Telefoonnummer
            </label>
            <br>
            <label>
                <input type="radio" name="communication" value="mail">
                E-mailadres
            </label>
            <br><br>
            </div>
            <div class="commentContact">
                <textarea id="comment" name="comment" rows="4" cols="50" placeholder="Voer hier je opmerkingen in"></textarea>
                <br><br>
            </div>
            <div class="sendbutton"> 
                <input type="submit" value="send">
            </div>
        </form> 

        <?php } else {?>
            <p>Bedankt voor uw reactie:</p>
        <?php}?>

    <footer>
        <p>&copy;</p>
        <p>2023</p>
        <p>Omer Seker</p>
    </footer>

</body>
</html>