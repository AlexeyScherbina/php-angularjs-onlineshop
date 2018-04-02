<?php
require_once '../config.php';


$params = json_decode(file_get_contents('php://input'));
if(isset($params)){
    $category = $params;
    $cid = $category->CategoryID;
    $name = $category->CategoryName;
    
    $response["status"] = "error";
    $response["message"] = "This category is in use. Cant be deleted";
    $result = $db->query("DELETE FROM `productcategory` WHERE `CategoryID`= $cid") or die(
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