<?php 
	require '../config.php';
	
	if (isset($_GET["id"])) {
        $id  = $_GET["id"]; 

        $sql = "UPDATE `order` SET `OrderConfirmed`= 1 WHERE `OrderID`= $id";

        $result = $db->query($sql);

        if($result){
            $response["status"] = "success";
            $response["message"] = "Confirmed successfully";
            echo $json_response = json_encode($response);
        }
        else{
            $response["status"] = "error";
            $response["message"] = "Something gone wrong :/";
            echo $json_response = json_encode($response);
        }
    }
?>