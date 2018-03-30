<?php 
	require '../config.php';
	
    $num_rec_per_page = 12;
	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
	$start_from = ($page-1) * $num_rec_per_page;

	if (!empty($_GET["search"])){
		$sqlTotal = "SELECT * FROM product 
			WHERE (ProductName LIKE '%".$_GET["search"]."%' OR ProductDescription LIKE '%".$_GET["search"]."%')"; 
		$sql = "SELECT * FROM product 
			WHERE (ProductName LIKE '%".$_GET["search"]."%' OR ProductDescription LIKE '%".$_GET["search"]."%') 
			LIMIT $start_from, $num_rec_per_page"; 
	}else{
		$sqlTotal = "SELECT * FROM product"; 
		$sql = "SELECT * FROM product LIMIT $start_from, $num_rec_per_page"; 
	}

	$result = $db->query($sql);

	while($row = $result->fetch_assoc()){
		$row['ProductImage'] = base64_encode( $row['ProductImage'] );
	    $json[] = $row;
	}
	$data['data'] = $json;

	$result =  mysqli_query($db,$sqlTotal);//$mysqli
	$data['total'] = mysqli_num_rows($result);
	
	echo json_encode($data);
?>