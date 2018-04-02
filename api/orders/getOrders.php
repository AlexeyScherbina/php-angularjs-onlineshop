<?php 
	require '../config.php';
	
    $num_rec_per_page = 5;
	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };

	$start_from = ($page-1) * $num_rec_per_page;

	$sqlTotal = "SELECT * FROM `order` ORDER BY  `OrderDate` DESC "; 
	$sql = "SELECT * FROM `order` ORDER BY  `OrderDate` DESC LIMIT $start_from, $num_rec_per_page";

	$result = $db->query($sql);

	$ids;
	while($row = $result->fetch_assoc()){
		$json[] = $row;

		$ids[] = $row['OrderID'];


	}
	$data['data'] = $json;


	if(count($ids)>0){
	$sql2 = "SELECT orderdetail.DetailID, orderdetail.DetailPrice, orderdetail.DetailCount, orderdetail.OrderID,
	 orderdetail.ProductID , product.ProductName FROM `orderdetail` INNER JOIN `product` ON 
	 orderdetail.ProductID=product.ProductID WHERE orderdetail.OrderID =".$ids[0];
	for($i=1;$i<count($ids);$i++){
		$sql2 = $sql2." OR orderdetail.OrderID =".$ids[$i]; 	
	}
	$result = $db->query($sql2);
	while($row = $result->fetch_assoc()){
		$json2[] = $row;
	}
	$data['details'] = $json2;
	$data['error'] = $sql2;
	}

/*
	while($row = $result->fetch_assoc()){
		$sql = "SELECT * FROM `orderdetail` WHERE 'OrderID' =".$row['OrderID']; 
		$result2 = $db->query($sql);
		while($row2 = $result2->fetch_assoc()){
			$json2[] = $row2;
		}
	    $json[] = $row;
	}
	$data['data'] = $json;
	$data['details'] = $json2;
	while($row = $result->fetch_assoc()){
	    $json[] = $row;
	}
	$data['data'] = $json[0];

			$sql2 = "SELECT * FROM `orderdetail` WHERE 'OrderID' =".$row['OrderID'];
		$result2 = $db->query($sql2);
		//$json2[] = $result2->fetch_assoc();
		while($row2 = $result2->fetch_assoc()){
			$json2[] = $row2;
		}
		$json3[$i] = $json2[0];
		$i+=1;
*/



	$result =  mysqli_query($db,$sqlTotal);//$mysqli
	$data['total'] = mysqli_num_rows($result);
	
	echo json_encode($data);
?>