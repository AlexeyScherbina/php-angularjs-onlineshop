<?php 
    require '../config.php';

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
	
	$sql = "SELECT * FROM  `user` WHERE  `UserID` =".$session['uid']; 
    
	$result = $db->query($sql);

	while($row = $result->fetch_assoc()){
	    $json[] = $row;
	}
	$data['data'] = $json[0];
	
	echo json_encode($data);
?>