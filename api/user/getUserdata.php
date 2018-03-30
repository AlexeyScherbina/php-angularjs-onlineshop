<?php 
    require '../config.php';

	$sql = "SELECT * FROM user WHERE 'UserID' =".$_SESSION['uid']; 
    
	$result = $db->query($sql);

	while($row = $result->fetch_assoc()){
	    $json[] = $row;
	}
	$data['data'] = $json;
	
	echo json_encode($data);
?>