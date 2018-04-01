<?php

require_once '../config.php';


$params = json_decode(file_get_contents('php://input'),true);
if(isset($params)){
    $products = $params;

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


    $uza = $session['uid'];
    $r = $db->query("select * from user where UserID='$uza' LIMIT 1") or die($db->error.__LINE__);

    $user = $r->fetch_assoc();
    $address = $user["UserAddress"];
    $email = $user["UserEmail"];
    $phone = $user["UserPhone"];
    $uid = $user["UserID"];
    $date = date('Y-m-d H:i:s');

    if($uid>0){
        $result = $db->query("INSERT INTO `order`(`OrderAddress`, `OrderEmail`, `OrderPhone`,
        `OrderDate`, `UserID`, `OrderConfirmed`) VALUES ('$address','$email','$phone','$date','$uid','0')") or die($db->error.__LINE__);
        if($result){
            $r = $db->query("SELECT * FROM  `order` WHERE  `UserID` =$uid AND  `OrderDate` =  '$date'") or die($db->error.__LINE__);
            $order = $r->fetch_assoc();
            /*
            foreach ($products as $key => $value) {
                $price = $value["ProductPrice"];
                $count = $value["count"];
                $oid = $order["OrderID"];
                $pid = $value["ProductID"];
                $result = $db->query("INSERT INTO `orderdetail`(`DetailPrice`,
                `DetailCount`, `OrderID`, `ProductID`) VALUES ('$price','$count','$oid','$pid')") or die($db->error.__LINE__);
            }*/
            for($i=0; $i < count($products); ++$i){
                $price = $products[$i]["ProductPrice"];
                $count = $products[$i]["count"];
                $oid = $order["OrderID"];
                $pid = $products[$i]["ProductID"];
                $result = $db->query("INSERT INTO `orderdetail`(`DetailPrice`,
                `DetailCount`, `OrderID`, `ProductID`) VALUES ('$price','$count','$oid','$pid')") or die($db->error.__LINE__);
            }
            $response["status"] = "success";
            $response["message"] = "Order created";
            echo $json_response = json_encode($response);
        }
        else{
            $response["status"] = "error";
            $response["message"] = "Failed to create order";
            echo $json_response = json_encode($response);
        }
    }else{
        $response["status"] = "error";
        $response["message"] = $uza;
        echo $json_response = json_encode($response);
    }
  
}else{
    $response["status"] = "error";
    $response["message"] = "bbnbnbn";
    echo $json_response = json_encode($response);
}
?>