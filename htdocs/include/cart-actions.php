<?php

require_once("mysql-config.php");

$mysqli = new mysqli($mysql['host'], $mysql['user'], $mysql['pass'], $mysql['db']);
if ($mysqli === null) {
    echo "An unknown error occured.";
    return;
}
session_start();
switch ($_POST['action']) {
    case "get_cart":
        for($i=0;$i<count($_SESSION['src']);$i++)
		{
/*Match this block from cart.php
					<div class="row">
						<div class="col-xs-2"><img class="img-responsive" src="http://placehold.it/100x70">
						</div>
						<div class="col-xs-4">
							<h4 class="product-name"><strong>Product name</strong></h4><h4><small>Product description</small></h4>
						</div>
						<div class="col-xs-6">
							<div class="col-xs-6 text-right">
								<h6><strong>25.00 <span class="text-muted">x</span></strong></h6>
							</div>
							<div class="col-xs-4">
								<input type="text" class="form-control input-sm" value="1">
							</div>
							<div class="col-xs-2">
								<button type="button" class="btn btn-link btn-xs">
									<span class="glyphicon glyphicon-trash"> </span>
								</button>
							</div>
						</div>
					</div>
					<hr>
*/
		}
		exit();	
        break;
	case "add_item":
		
		break;
	case "delete_item":
	
		break;
	case "cart_total":
	
		break;
	case "update_cart": //Changing quantity on cart page
		
		break;
	case "submit_order":
	
		break;
    default:
        echo "An unknown error occured.";
        break;
}
$mysqli->close();
?>