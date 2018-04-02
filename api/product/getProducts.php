<?php 
	require '../config.php';
	
    $num_rec_per_page = 6;
	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
	if (isset($_GET["category"])) { 
		if ($_GET["category"]>=1) { 
			$cat  = $_GET["category"]; 
		}
	}
	$start_from = ($page-1) * $num_rec_per_page;

	if (!empty($_GET["search"])){
		if($cat>=1){
			$sqlTotal = "SELECT * FROM product 
				WHERE ((ProductName LIKE '%".$_GET["search"].
				"%' OR ProductDescription LIKE '%".$_GET["search"].
				"%') AND CategoryID = '".$cat.
				"')"; 
			$sql = "SELECT * FROM product 
				WHERE ((ProductName LIKE '%".$_GET["search"].
				"%' OR ProductDescription LIKE '%".$_GET["search"].
				"%') AND CategoryID = '".$cat.
				"') 
				LIMIT $start_from, $num_rec_per_page";
		}else{
			$sqlTotal = "SELECT * FROM product 
			WHERE (ProductName LIKE '%".$_GET["search"]."%' OR ProductDescription LIKE '%".$_GET["search"]."%')"; 
			$sql = "SELECT * FROM product 
				WHERE (ProductName LIKE '%".$_GET["search"]."%' OR ProductDescription LIKE '%".$_GET["search"]."%') 
				LIMIT $start_from, $num_rec_per_page";
		}
	}else{
		if($cat>=1){
			$sqlTotal = "SELECT * FROM product 
				WHERE ((ProductName LIKE '%".$_GET["search"].
				"%') AND CategoryID = '".$cat.
				"')"; 
			$sql = "SELECT * FROM product 
				WHERE ((ProductName LIKE '%".$_GET["search"].
				"%') AND CategoryID = '".$cat.
				"') 
				LIMIT $start_from, $num_rec_per_page";
		}
		else{
			$sqlTotal = "SELECT * FROM product"; 
			$sql = "SELECT * FROM product LIMIT $start_from, $num_rec_per_page"; 
		}
	}

	$result = $db->query($sql);

	while($row = $result->fetch_assoc()){
		//$row['ProductImage'] = base64_encode( $row['ProductImage'] );
	    $json[] = $row;
	}
	$data['data'] = $json;

	$result =  mysqli_query($db,$sqlTotal);
	$data['total'] = mysqli_num_rows($result);
	
	echo json_encode($data);
?>