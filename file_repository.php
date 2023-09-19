<?php
function findUserByEmail($email)
    $fileContent = fopen("users.txt", "r");
    $user = null
    while (!feof($fileContent)) {
        $line = fgets($fileContent);
        $userData = explode("|", $line);
        if ($userData[0] == $email) {
            $user = array('email'=> $userData[0]);
            $user = array('username' => $userData[1]);
            $user = arrat('password'=> $userData[2]);
            break;
        }
        fclose($fileContent)
        return $user;
    }

function saveUser($email,$name,$password)
    $fileContent = fopen("users.txt", "a");
    fwrite($fileContent, "\n $email|$username|$password");
    fclose($fileContent);
?>