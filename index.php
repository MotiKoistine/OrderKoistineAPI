<?php
$url = "Host";
$username = "Username";
$password = "password";
$database = "database";

$conn = mysqli_connect($url,$username,$password,$database);
if(isset($_REQUEST['userid'])){
	if($_POST['userid'] == "80085y4y"){
		if(isset($_POST['search_type'])){
			$search_type = $_POST['search_type'];
			switch ($search_type){
				case "item":
					if(isset($_POST['search'])){
						$search = $_POST['search'];
						$sql = "SELECT * FROM items WHERE name LIKE '%".$search."%' OR ean LIKE '%".$search."%' OR quickcode LIKE '%".$search."%'";
						if($result = mysqli_query($conn,$sql)){
							$i = 0;
							while($row = mysqli_fetch_array($result)){
								$obj->items[$i]->itemid = $row['item_id'];
								$obj->items[$i]->name = utf8_encode($row['name']);
								$obj->items[$i]->priceout = $row['priceout'];
								$obj->items[$i]->pricein = $row['pricein'];
								$i++;
							}
						$json = json_encode($obj);
						echo($json);
						}
					}
					break;
				case "code":
					if($_POST['code']){
						$search = $_POST['code'];
						$sql = "SELECT * FROM items WHERE quickcode = '".$search."' OR ean = '".$search."'";
						if($result = mysqli_query($conn,$sql)){
							$row = mysqli_fetch_array($result);
							$obj->itemid = $row['item_id'];
							$obj->item = utf8_encode($row['name']);
							$obj->priceout = $row['priceout'];
							$obj->pricein = $row['pricein'];
							$json = json_encode($obj);
							echo($json);
						}
					}
					break;
				case "customer":
					if(isset($_POST['search'])){
						$search = $_POST['search'];
						$sql = "SELECT * FROM customers WHERE name LIKE '%".$search."%' OR address LIKE '%".$search."%' OR phone LIKE '%".$search."%' OR email LIKE '%".$search."%'";
						if($result = mysqli_query($conn,$sql)){
							$i = 0;
							while($row = mysqli_fetch_array($result)){
								$obj->customers[$i]->customerid = $row['customer_id'];
								$obj->customers[$i]->name = utf8_encode($row['name']);
								$obj->customers[$i]->address = utf8_encode($row['address']);
								$obj->customers[$i]->postcode = $row['postcode'];
								$obj->customers[$i]->city = utf8_encode($row['city']);
								$obj->customers[$i]->phone = $row['phone'];
								$obj->customers[$i]->email = utf8_encode($row['email']);
								$i++;
							}
							$json = json_encode($obj);
							echo($json);
						}
					}
					break;
				case "delivery":
					$sql = "SELECT * FROM delivery";
					if($result = mysqli_query($conn,$sql)){
						$i = 0;
						while($row = mysqli_fetch_array($result)){
							$obj->delivery[$i]->delivery_id = $row['delivery_id'];
							$obj->delivery[$i]->name = utf8_encode($row['name']);
							$obj->delivery[$i]->price = $row['price'];
							$i++;
						}
					$json = json_encode($obj);
					echo($json);
					}
					break;
			}
		}
	}
}
mysqli_close($conn);
?>
