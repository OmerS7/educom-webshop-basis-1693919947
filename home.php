<?php

function showHomeHeader() {
    echo 'Mijn eerste website';
}

function showHomeContent() {
    echo '<div class="welcometext">
    <p>Welkom op de eerste website van de softwaredeveloper &Ouml;mer. Op deze website vind je informatie over Educom.</p>
    </div>';
}
?>

/*
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
        */