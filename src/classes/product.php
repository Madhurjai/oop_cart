<?php
// session_start();
namespace App ;
class product
{
    public array $products ;

	public function __construct(array $products)
	{
		$this->product =$products;
		
	}
    /**
     *this function is used for display products for purcahsing
     *
     * @return void
     */
    public function display_pro(){
        $html = '<div id = "products">' ;
        foreach($this->product as $key => $val){
            $html .= '<div id = "product-101" class="product"><form action="" method="POST">
            <input type="hidden" name="listid" value = "'.$val['id'].'" >
            <img src="images/'.$val['img'].'">
            <h3>'.$val['name'].'</h3><span> Price :'.$val['price'].' </span>
            <input type="submit" value="add" name="action" id = "addbtn">
            </form></div>';
      }
      $html .= "</div>";
      return $html ;
        }
    }
   

?>