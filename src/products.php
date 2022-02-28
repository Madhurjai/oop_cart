<?php

session_start();
// session_destroy();
// require('classes/cart.php');
// require('classes/product.php');
use App\cart ;
use App\product ;
require('vendor/autoload.php');
$arr = array(
	array('id' => '101', 'img' => 'football.png', 'price' => '150.00', 'name' => 'foot ball'),
	array('id' => '102', 'img' => 'tennis.png', 'price' => '120.00', 'name' => 'tennis'),
	array('id' => '103', 'img' => 'basketball.png', 'price' => '90.00', 'name' => 'Basket ball'),
	array('id' => '104', 'img' => 'table-tennis.png', 'price' => '110.00', 'name' => 'table tannis'),
	array('id' => '105', 'img' => 'soccer.png', 'price' => '80.00', 'name' => 'soccar')
);



$products = new product($arr);
$cart = new cart();


$_SESSION['cart'] = isset($_SESSION['cart'])?$_SESSION['cart']:array();
$cart->setcart($_SESSION['cart']);
if (isset($_POST['listid'])) {
	$id = $_POST['listid'];
	$val = getproduct($id, $arr);
	$cart->addtocart($val);
	
	$_SESSION['cart'] = $cart->getcart();
}

if(isset($_POST['update'])){
	$id = $_POST['pro_id'];
	foreach($_SESSION['cart'] as $key => $val){
		if($val['id'] == $id){
			$_SESSION['cart'][$key]['quantity'] += $_POST['input'];
		}
	}
}
if(isset($_POST['remove'])){
	$id = $_POST['pro_id'];
	foreach($_SESSION['cart'] as $key => $val){
		if($val['id'] == $id){
			array_splice($_SESSION['cart'],$key,1);
		}
	}
}
if(isset($_POST['del_cart'])){
    $_SESSION['cart'] = array();	
}
/**
 * thsi function is used for display cart
 *
 * @return void
 */
function display_cart()
{

	$total_price = 0;
	$tab = "<table class = 'tab' ><form method = 'POST'><button name = 'del_cart' class = 'del_cart'>X</button></form>
	<tr><th>ID</th><th>Name</th><th>Price</th><th>quantity</th><th> update  quantity </th><th>product cost</th><th>del product</th></tr>";
	foreach ($_SESSION['cart'] as $key => $val) {
		$tab .= "<form method = 'POST'><tr><td>" . $val['id'] . "</td>
		<td>" . $val['name'] . "</td>
		<td>" . $val['price'] . "</td>
         <td>" . $val['quantity'] . "</td>
		 <td class = 'upd'><input type = 'text' name = 'input'>
		 <button name = 'update'>update</button></td>
		 <td>".(int)$val['price'] * (int)$val['quantity']."</td>
		 <td><button name = 'remove'>remove</button></td>
		 <input type = 'hidden' name = 'pro_id' value = '".$val['id']."'></tr></form>";
		$total_price += (int)$val['price'] * (int)$val['quantity'];
		//  print_r($total_price);
		// echo $val['price'];
	}
	$tab .= "<tr><td colspan = '4'>total price : " . $total_price . "</td></tr></table>";
	return $tab;
}

function getproduct($id, $arr)
{
	foreach ($arr as $key => $val) {
		if ($id == $val['id']) {
			return $val;
		}
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>
		Products
	</title>
	<link href="style.css" type="text/css" rel="stylesheet">
</head>

<body>
	<div id="header">
		<h1 id="logo">Logo</h1>
		<nav>
			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
		</nav>
	</div>
	<div id="main">
		<div id="products">


			<?php echo $products->display_pro(); ?>
		</div>
		<div id="table"><?php echo display_cart(); ?></div>
	</div>
	<div id="footer">
		<nav>
			<ul id="footer-links">
				<li><a href="#">Privacy</a></li>
				<li><a href="#">Declaimers</a></li>
			</ul>
		</nav>
	</div>
</body>

</html>