<?php
session_start();

function doLoginUser($username) {
    $_SESSION['username'] = $username;
}

function isUserLoggedIn() {
    return isset($_SESSION['username']);
}

function getLoggedInUser() {
    return $_SESSION['username'];
}

function doLogoutUser() {
    session_unset();
    session_destroy();
}