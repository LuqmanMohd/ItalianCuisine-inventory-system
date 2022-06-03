<?php
header("Content-Type: application/json;Charset=UTF-8");
require 'database.php';

$Json = array();
if (isset($_GET['search'])) {
	//senang sikit nk ubahhh
	$field = ['FLD_PRD_NAME', 'FLD_PRD_PRICE' , 'FLD_PRD_TYPE'];
	$search = htmlspecialchars($_GET['search']);
	$data = explode(" ", $search);

	$name = (isset($data[0]) ? $data[0] : '');
	$price = (isset($data[1]) ? $data[1] : '');
	$brand = (isset($data[2]) ? $data[2] : '');

	try {
		//kalo nk search pastu dapat specific product. like nk dapat product tu je
		// if(count($data)<3){
		// 	 $stmt = $conn->prepare("SELECT * FROM `tbl_products_a175128_pt2` WHERE {$field[0]} LIKE ? OR {$field[1]} LIKE ? OR {$field[2]} LIKE ?");
		// 	 $stmt->execute(["%{$search}%","%{$search}%", "%{$search}%"]);
		// }
		// elseif(count($data)==3){
		// 	$stmt = $conn->prepare("SELECT * FROM `tbl_products_a175128_pt2` WHERE {$field[0]} LIKE ? AND {$field[1]} LIKE ? AND {$field[2]} LIKE ?");
		// 	$stmt->execute(["%{$name}%","%{$price}%", "%{$brand}%"]);
		// }


		//kalo nk search any keyword and return all row yg ade words tu(harap faham). Tak kisah berapa perkataan pun
		$queries = array();
		foreach($data as $dat){
			// $queries[] = "SELECT * FROM `tbl_products_a175128_pt2` WHERE {$field[0]} LIKE '%{$dat}%' OR {$field[1]} LIKE '%{$dat}%' OR {$field[2]} LIKE '%{$dat}%'";
			$queries[] = "SELECT * FROM `tbl_products_a175128_pt2` WHERE {$field[0]} LIKE '%{$dat}%' OR {$field[1]} LIKE '%{$dat}%' OR {$field[2]} LIKE '%{$dat}%'";
		}
		$sql = implode(' UNION ',$queries);//kalo nk tukr ni jadi INTERSECT untuk dapat refined search
		$stmt = $conn->prepare($sql);


		//penting for both cara
		$stmt->execute();
		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// print_r($res);


		$Json = array('status' => 200, 'data' => $res);
		// echo json_encode($Json, JSON_PARTIAL_OUTPUT_ON_ERROR);
		// print_r(json_last_error_msg());

	} catch (PDOException $e) {
		$Json = array('status' => 400, 'data' => $e->getMessage());
	}

}

if (isset($Json))
	echo json_encode($Json);