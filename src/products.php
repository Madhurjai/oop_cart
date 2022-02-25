<?php

session_start();
// session_destroy();
require('classes/cart.php');
require('classes/product.php');
// require('vendor/autoload.php');
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
	// print_r($_SESSION['cart']);
}
function display_cart()
{

	$total_price = 0;
	$tab = "<table class = 'tab' ><tr><th>ID</th><th>Name</th><th>Price</th><th>quantity</th></tr>";
	foreach ($_SESSION['cart'] as $key => $val) {
		$tab .= "<tr><td>" . $val['id'] . "</td><td>" . $val['name'] . "</td><td>" . $val['price'] . "</td>
         <td>" . $val['quantity'] . "</td></tr>";
		$total_price += (int)$val['price'] * (int)$val['quantity'];
		//  print_r($total_price);
		echo $val['price'];
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