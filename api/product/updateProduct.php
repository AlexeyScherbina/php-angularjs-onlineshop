<?php
require_once '../config.php';


$params = json_decode(file_get_contents('php://input'));
if(isset($params)){
    $product = $params;
    $pid = $product->ProductID;
    $ProductName = $product->ProductName;
    $ProductPrice = $product->ProductPrice;
    $ProductCount = $product->ProductCount;
    $ProductDescription = $product->ProductDescription;
    $ProductImage = $product->ProductImage;
    $CategoryID = $product->CategoryID;

    $result = $db->query("UPDATE `product` SET `ProductName`='$ProductName',
    `ProductPrice`=$ProductPrice,`ProductImage`='$ProductImage',`ProductCount`=$ProductCount,
    `ProductDescription`='$ProductDescription',`CategoryID`=$CategoryID WHERE `ProductID`=$pid") or die($db->error.__LINE__);

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