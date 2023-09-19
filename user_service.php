<?php
require_once 'file_repository.php';

function doesEmailExist($email){
    $user = findUserByEmail($email);
    return !empty($user);
}

function authenticateUser($email,$password){
    $user = findUserByEmail($email);
        if (empty($user)){
            return null;
        }
        if ($user["password"]!=$password){
            return null;
        }
    return $user;   
    }

function storeUser($email,$username,$password){
    $filecontent = fopen ("users.txt", "a");
    fwrite($fileContent, "\n,$email|$username|$password");
    fclose($fileContent);
}
?>