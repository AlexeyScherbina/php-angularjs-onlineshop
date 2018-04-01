<?php
require_once '../config.php';


$params = json_decode(file_get_contents('php://input'));
if(isset($params)){
    $user = $params;
    $uid = $user->UserID;
    $phone = $user->UserPhone;
    $name = $user->UserName;
    $address = $user->UserAddress;

    $result = $db->query("UPDATE `user` SET `UserName`='$name',`UserPhone`='$phone',`UserAddress`='$address' WHERE `UserID` = $uid") or die($db->error.__LINE__);

    if($result){
        $response["status"] = "success";
        $response["message"] = "Updated successfully";
        echo $json_response = json_encode($response);
    }
    else{
        $response["status"] = "error";
        $response["message"] = "Something gone wrong :/";
        echo $json_response = json_encode($response);
    }
    
}else{
    $response["status"] = "error";
    $response["message"] = "bbnbnbn";
    echo $json_response = json_encode($response);
}
?>