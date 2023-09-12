<?php

$page = getRequestedPage();
   showResponsePage($page);

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

function showResponsePage ($page)
{
    beginDocument();
    showHeadSection();
    showBodySection($page);
    enDocument();
}

function getArrayVar($array, $key, $default='')
{
    return isset ($array[$key]) ? $array[$key] : $default;
}

function getPostVar($key,$default='')
{
    return getArrayVar($_POST, $key, $default);
}

function beginDocument()
{
    echo '<!doctype html>
    <html>';
}

function showHeadSection()
{
    echo ' <head>' . PHP_EOL;
    showTitle();
    showLink();
    echo ' </head>' . PHP_EOL;
}

function showBodySection($page)
{
    echo '      <body>' . PHP_EOL;
    showHeader($page);
    showMenu();
    showContent($page);
    showFooter();
    echo '      <?body>' .PHP_EOL;
}

function endDocument()
{
    echo '</html>';
}

function showHeader($page)
{
    echo '<h1>Mijn eerste website</h1>';
}

function showMenu()
{
    echo '<ul>
    <li><a href="index.html">HOME</a></li>
    <li><a href="about.html">ABOUT</a></li>
    <li><a href="contact.php">CONTACT</a></li>
</ul>';
}

function showContent($page)
{
    switch($page)
    {
        case 'home':
            require('home.php');
            showHomeContent();
            break;
        case 'about';
            require('about.php');
            showAboutContent();
            break;
        case 'contact';
            require('contact.php');
            showContactContent();
            break;
    }
}

function showFooter()
{
    echo ' <p>&copy;</p>
    <p>2023</p>
    <p>Omer Seker</p>';
}

?>