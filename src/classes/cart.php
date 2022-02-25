<?php
namespace App ;
// session_start();

class cart
{

	public function __construct()
	{
		$this->cart = array();
	}


/**
 *this function is used for insert data in cart
 *
 * @param [type] $val
 * @return void
 */
	public function addtocart($val)
	{
		if(!$this->productexist($val)){  	
			$val['quantity'] = 1; 
			array_push($this->cart,$val);
            // print_r($this->arr);

		}
		// array_push($this->cart,$product);
	}
	public function productexist($val1)
	{   
		foreach($this->cart as $key => $val) {
			if ($val1['id'] == $this->cart[$key]['id']) {
                $this->cart[$key]['quantity'] += 1;
				return true;
			}
		}
		return false;
	}
    public function setCart($cart){
         $this->cart = $cart;
    }
	public function getcart()
	{
		return $this->cart;
	}

}

?>