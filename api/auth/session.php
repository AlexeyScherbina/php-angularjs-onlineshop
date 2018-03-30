<?php

if (!isset($_SESSION)) {
    session_start();
}
$sess = array();
if(isset($_SESSION['uid']))
{
    $sess["uid"] = $_SESSION['uid'];
    $sess["name"] = $_SESSION['name'];
    $sess["email"] = $_SESSION['email'];
    $sess["role"] = $_SESSION['role'];
}
else
{
    $sess["uid"] = '';
    $sess["name"] = '';
    $sess["email"] = '';
    $sess["role"] = 'guest';
}
$session = $sess;

$response["uid"] = $session['uid'];
$response["email"] = $session['email'];
$response["name"] = $session['name'];
$response["role"] = $session['role'];
echo $json_response = json_encode($response);

?>