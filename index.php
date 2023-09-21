<?php

require_once("session_manager.php");
require_once("utils.php");

$page = getRequestedPage();
$data= processRequest($page);
showResponsePage($data);

function getRequestedPage()
{
    $requested_type = $_SERVER['REQUEST_METHOD'];
    if ($requested_type == 'POST' )
    {
        $requested_page = getPostVar('page','home');
    }
    else
    {
        $requested_page = getUrlVar('page','home');
    }
    return $requested_page;
}

function processRequest($page){ 
    /*$data = array();*/   
    switch($page){
        case "login":
            require_once('login.php');
            $data = validateLogin();
            if ($data['valid']){
                doLoginUser($data['username']);
                $page = "home";
            }
            break;   
        case "contact":
            require_once('contact.php');
            $data = validateContact();
            if($data['valid']){
                $page = "thanks";
            }
            break;      
        case "logout":
            require_once('logout.php');
            doLogoutUser();
            $page = "home";
            break;
        case "register":
            require_once('register.php');
            $data = validateRegister();
            if($data['valid']){
            saveUser($data['email'], $data['username'], $data['password']);
                $page = "login";
            }
            break;
    }  
    $data['page'] = $page;
    return $data;
}

            
function showResponsePage ($data)
{
    beginDocument();
    showHeadSection();
    showBodySection($data);
    endDocument();
}

function getArrayVar($array, $key, $default='')
{
    return isset ($array[$key]) ? $array[$key] : $default;
}

function getPostVar($key,$default='')
{
    return getArrayVar($_POST, $key, $default);
}

function getUrlVar($key,$default='')
{
    return getArrayVar($_GET, $key, $default);
}

function beginDocument()
{
    echo '<!doctype html>'.PHP_EOL.'<html>'.PHP_EOL;
}

function showHeadSection()
{
    echo '  <head>' . PHP_EOL;
    echo '    <link rel="stylesheet"  href="CSS/stylesheet.css">' . PHP_EOL;
    echo '  </head>' . PHP_EOL;
}

function showBodySection($data)
{
    echo '  <body>' . PHP_EOL;
    showHeader($data['page']);
    showMenu();
    showContent($data);
    showFooter();
    echo '  </body>' .PHP_EOL;
}

function endDocument()
{
    echo '</html>';
}

function showHeader($page)
{
    echo '<header><h1>';
    switch($page)
   {
    case 'home':
        require_once('home.php');
        showHomeHeader();
        break;
    case 'about':
        require_once('about.php');
        showAboutHeader();
        break;
    case 'contact':
        require_once ('contact.php');
        showContactHeader();
        break;
    case 'register':
        require_once ('register.php');
        showRegisterHeader();
        break;
    case 'login':
        require_once('login.php');
        showLoginHeader();
        break;
   }
   
   /*
    if ($page == 'home') {
        require_once('home.php');
        showHomeHeader();
    } elseif ($page == 'about'){
        require_once('about.php');
        showAboutHeader();
    } elseif($page == 'contact'){
        require_once('contact.php');
        showContactHeader();
    }elseif (isset($_SESSION['email'])){
        $ingelogdeEmail = $_SESSION['email'];
        echo "Welcome, $ingelogdeEmail! <a href='logout.php'>Logout</a>";    
    } elseif($page == 'register'){
        require_once('register.php');
        showRegisterHeader();
    } elseif($page == 'login'){
        require_once('login.php');
        showLoginHeader();
    } 
    */
    echo '</h1></header>' . PHP_EOL;
}

/*
function showMenu()
{
    echo '<div class="menu">
            <ul>
              <li><a href="index.php?page=home">HOME</a></li>
              <li><a href="index.php?page=about">ABOUT</a></li>
              <li><a href="index.php?page=contact">CONTACT</a></li>
              <li><a href="index.php?page=register">REGISTER</a></li>
            </ul>
          </div>' . PHP_EOL;
}
*/

function showMenuItem($page, $label)
{
    echo '<li><a href="index.php?page=' . $page . '">' . $label . '</a></li>';
}

function showMenu() { 
    echo '<div class="menu">  
        <ul>';
    showMenuItem("home", "HOME"); 
    showMenuItem("about", "ABOUT"); 
    showMenuItem("contact", "CONTACT"); 
    if (isUserLoggedIn()) {
        showMenuItem("logout", "LOG OUT " . getLoggedInUser());
    } else {
        showMenuItem("register", "REGISTER");
        showMenuItem("login", "LOGIN");
    } 
    echo '
        </ul>  
    </div>' . PHP_EOL; 
} 

function showContent($data)
{
    echo '<section>'; 
    switch($data['page'])
    {
        case 'home':
            require_once('home.php');
            showHomeContent();
            break;
        case 'about':
            require_once('about.php');
            showAboutContent();
            break;
        case 'contact':
            require_once('contact.php');
            showContactForm($data);
            break;
        case 'thanks':
            require_once('contact.php');
            showContactThanks($data);
            break;
        case 'register':
            require_once('register.php');
            showRegisterForm($data);
            break;
        case 'login':
            require_once('login.php');
            showLoginForm($data);
            break;
        case 'logout':
            doLogoutUser();
            require_once('home.php');
            showHomeContent();
            break;   
        default:
            showPageNotFound();
            break;
        }   
    echo '</section>'; 

}

function showPageNotFound(){
    echo '<div class="content">
    <p>PAGE NOT FOUND</p>
    </div>';
}

function showFooter()
{
    echo ' <footer>
    <p>&copy;</p>
    <p>2023-</p>
    <p>Omer Seker</p>
</footer>';
}

?>