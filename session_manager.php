<?php
session_start();

function doLoginUser($username) {
    $_SESSION['username'] = $username;
}

function isUserLoggedIn() {
    return isset($_SESSION['username']);
}

/*
function getLoggedInUser() {
    return $_SESSION['username'];
}*/

function getLoggedInUser() {
    if (isset($_SESSION['username'])) {
        return $_SESSION['username'];
    } else {
        return null; // Of een andere waarde die aangeeft dat de gebruiker niet is ingelogd
    }
}

function doLogoutUser() {
    session_unset();
    session_destroy();
}
?>