<?php
require_once '../config.php';


$params = json_decode(file_get_contents('php://input'));
if(isset($params)){
    $category = $params;
    $cid = $category->CategoryID;
    $name = $category->CategoryName;

    $result = $db->query("UPDATE `productcategory` SET `CategoryName`='$name' WHERE `CategoryID` = $cid") or die($db->error.__LINE__);

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