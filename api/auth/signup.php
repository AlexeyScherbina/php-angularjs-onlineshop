<?php
require_once '../passwordHash.php';
require_once '../config.php';


$params = json_decode(file_get_contents('php://input'));
if(isset($params)){
    $user = $params;
    $phone = $user->UserPhone;
    $name = $user->UserName;
    $email = $user->UserEmail;
    $address = $user->UserAddress;
    $password = $user->UserPassword;

    $r = $db->query("select 1 from user where UserEmail='$email' LIMIT 1") or die($db->error.__LINE__);
    $isUserExists = $r->fetch_assoc();

    if(!$isUserExists){
        $password = passwordHash::hash($password);
        $result = $db->query("INSERT INTO `user`(`UserEmail`, `UserPassword`, `UserName`, `UserPhone`, `UserAddress`, `UserRole`) 
        VALUES ('$email','$password','$name','$phone','$address','user')") or die($db->error.__LINE__);

        if ($result) {

            $r = $db->query("select * from user where UserEmail='$email' LIMIT 1") or die($db->error.__LINE__);
            $u = $r->fetch_assoc();

            $response["status"] = "success";
            $response["message"] = "User account created successfully";
            $response["uid"] = $u['UserID'];
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['uid'] = $u['UserID'];
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
            $_SESSION['role'] = "user";
            echo $json_response = json_encode($response);
        } else {
            $response["status"] = "error";
            $response["message"] = "Failed to create customer. Please try again";
            echo $json_response = json_encode($response);
        }            
    }else{
        $response["status"] = "error";
        $response["message"] = "An user with the provided phone or email exists!";
        echo $json_response = json_encode($response);
    }
    
}else{
    $response["status"] = "error";
    $response["message"] = "bbnbnbn";
    echo $json_response = json_encode($response);
}
?>