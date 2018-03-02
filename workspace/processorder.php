<?php
require("db.php");
require("template.php");
 require("exceptions.php");
  $process = new Page();
  $process->pagename = "Order Results";
  $process->title = " - Order Results";
  $process->DisplayHeader();

//Query database for current products and prices

//first make order
  //Gather order info, encrypt all personal
  $address = clean($_POST['address']);
  $ccn = clean($_POST['ccn']);
  $ccv = clean($_POST['ccv']);
  $email = clean($_POST['email']);
  
  /* Luhn algorithm number checker - (c) 2005-2008 shaman - www.planzero.org *
 * This code has been released into the public domain, however please      *
 * give credit to the original author where possible.                      */

function luhn_check($number) {

  // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
  $number=preg_replace('/\D/', '', $number);

  // Set the string length and parity
  $number_length=strlen($number);
  $parity=$number_length % 2;

  // Loop through each digit and do the maths
  $total=0;
  for ($i=0; $i<$number_length; $i++) {
    $digit=$number[$i];
    // Multiply alternate digits by two
    if ($i % 2 == $parity) {
      $digit*=2;
      // If the sum is two digits, add them together (in effect)
      if ($digit > 9) {
        $digit-=9;
      }
    }
    // Total up the digits
    $total+=$digit;
  }

  // If the total mod 10 equals 0, the number is valid
  return ($total % 10 == 0) ? TRUE : FALSE;

}
  
    ?>
  
<table border="0" bgcolor=#ffe6cc width="764">
	
	<?php
	 $ccn = preg_replace('/\D/', '', $ccn);
	 
  	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  	echo "<tr><td>$email is not a valid email address, please <a href=\"orderform.php\">go back</a> and try again.</td></tr>";
  	
}  else if (strlen($ccn)<15 || !luhn_check($ccn)){
    echo "<tr><td>That is not a valid credit card number, 
    please <a href=\"orderform.php\">go back</a> and try again.</td></tr>";
  } else {
    
  //would likely process payment here using name card ccv etc
  
  $email = sha1($email);
  $ccn = sha1($ccn); 
  //do not store ccv, bad security
  $date = date('Y-m-d H:i:s'); //could use now() sql function, but this allows me to use the date for adding the relationships to the right order
  $query = "insert into orders (orderDate, completed, card, address, email) VALUES ('$date', 0, '$ccn', '$address', '$email')";
  $result = mysqli_query($mysql, $query);

//fetch order id
$query = "select * from orders where orderDate = '$date' AND email='$email'";
$result = mysqli_query($mysql, $query);
$row=$result->fetch_assoc();
$orderId=$row["orderid"];


	echo "<tr><td><center>Order processed at ".date('H:i, jS F Y')."</td></tr>";
	echo "<tr><td>Your order is as follows: </td></tr>";
$totalqty = 0;
$totalamount = 0.00;


//then make relationships, using qty for each
$query= "select * from products"; 
$result = mysqli_query($mysql, $query);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	
    	//fetch the info
    	$pname = $row["productName"];
    	$id=$row["productid"];
    	$price = $row["price"];
    	$postname=''.$pname.'qty';
    	$qty = $_POST[$pname];
    	
    	//create relationship
    	$hasQuery="insert into order_has_products (numOfProduct, productid, orderid) VALUES ('$qty', '$id', '$orderId')";
      $que = mysqli_query($mysql, $hasQuery);
        //print info:
        echo "<tr><td>" . $pname. "</td><td>" . $price . "</td><td>".$qty."</td></tr>";
        $totalqty = $totalqty + $qty;
        $totalamount = $totalamount + ($qty * $price);
        
    }
    
    //print totals:
    echo "<tr><td>Items ordered: ".$totalqty."</td><tr>";
    
    echo "<tr><td>Subtotal: $".number_format($totalamount,2)."</td></tr>";
    
	
    	$taxrate = 0.10;  // local sales tax is 10%
	$totalamount = $totalamount * (1 + $taxrate);
	echo "<tr><td><font size='5'>Total including tax: $".number_format($totalamount,2)."</font></td></tr>";
	
	echo "<tr><td><center>Have a nice day!</center></td></tr></table>";
	
} else {
    echo "<tr><td>There are no products available, please contact us for assistance.</td></tr></table>";
}
  
}


$process->DisplayFooter(); ?>