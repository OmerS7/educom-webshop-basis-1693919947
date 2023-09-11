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
    return getArrayVal($_POST, $key, $default);
}