<?php
require_once '../passwordHash.php';
require_once '../config.php';

$params = json_decode(file_get_contents('php://input'));

if(isset($params)){
    $login = $params;
    $password = $login->UserPassword;
    $email = $login->UserEmail;

    $r = $db->query("select * from user where UserEmail='$email' LIMIT 1") or die($db->error.__LINE__);
    $user = $r->fetch_assoc();

    if ($user != NULL) {
        if(passwordHash::check_password($user['UserPassword'],$password)){
        $response['status'] = "success";
        $response['message'] = 'Logged in successfully.';
        $response['name'] = $user['UserName'];
        $response['uid'] = $user['UserID'];
        $response['email'] = $user['UserEmail'];
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['uid'] = $user['UserID'];
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $user['UserName'];
        $_SESSION['role'] = $user['UserRole'];
        } else {
            $response['status'] = "error";
            $response['message'] = 'Login failed. Incorrect credentials';
        }
    }else {
            $response['status'] = "error";
            $response['message'] = 'No such user is registered';
        }

    echo $json_response = json_encode($response);
    }

?>