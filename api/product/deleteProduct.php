<?php
require_once '../config.php';


$params = json_decode(file_get_contents('php://input'));
if(isset($params)){
    $product = $params;
    $pid = $product->ProductID;
    
    $response["status"] = "error";
    $response["message"] = "This product is in use. Cant be deleted";
    $result = $db->query("DELETE FROM `product` WHERE `ProductID`= $pid") or die(
        json_encode($response)
    );

    if($result){
        $response["status"] = "success";
        $response["message"] = "Deleted successfully";
        echo $json_response = json_encode($response);
    }
    else{
        $response["status"] = "error";
        $response["message"] = "This category is in use. Cant be deleted";
        echo $json_response = json_encode($response);
    }
    
}else{
    $response["status"] = "error";
    $response["message"] = "bbnbnbn";
    echo $json_response = json_encode($response);
}
?>