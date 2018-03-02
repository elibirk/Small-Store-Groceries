<?php
require("template.php");
 require("exceptions.php");
 require("db.php");
  $home = new Page();
  $home->pagename = "Customer Orders";
  $home->title = " - Customer Orders";
  $home->DisplayHeader();


 //create short variable name
$username = $_POST['username'];
  $password = $_POST['password'];
  
if (!isset($username) || !isset($password)) {
    //visitors must log in
    
    echo "<h1>Login unsuccessful. Please try again.</h1>";
}
else {

$query = "select count(*) from employees where
        employeeEmail = '".$username."' and  
        password = '".$password."'";
      
         
$result = mysqli_query($mysql, $query);
if(!$result){
    echo "Cannot access database, please contact an admin.";
    exit;
}

$row = mysqli_fetch_row($result);
$count = $row[0];

if ($count > 0) {
    //name and password are correct
    //show the page
    //print header
echo "<table width='764' border=\"1\"><tr><td>ID</td><td>Date</td><td>Completion</td><td>CCN</td><td>Address</td><td>Email</td></tr>";
//get all order info    
$query="select * from orders"; 
$result = mysqli_query($mysql, $query);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $totalprice = 0.00;
        
        $id = $row["orderid"];
        echo "<tr><td>" . $id. "</td><td>" . $row["orderDate"]. "</td><td>".$row["completed"]."</td><td>".$row["card"]."</td><td>".$row["address"]."</td>
        <td>".$row["email"].$row["customerEmail"].$row["employeeEmail"]."</td></tr>";
        echo "<tr><td></td><td>Item</td><td>Quantity</td><td>Price Each</td></tr>";
        
        //get relationships with products
        $pquery="select * from order_has_products where orderid = '$id'"; 
        $presult = mysqli_query($mysql, $pquery);
        if ($presult->num_rows > 0) {
            while($prow = $presult->fetch_assoc()) {
                
                    //get product name
                    $pid = $prow["productid"];
                    $pnamequery="select * from products where productid = '$pid'"; 
                    $pnameresult = mysqli_query($mysql, $pnamequery);
                    if ($pnameresult->num_rows > 0) {
                    $pnamerow = $pnameresult->fetch_assoc();
                    $pname = $pnamerow["productName"];
                    $pprice = $pnamerow["price"];
                    } 
                    
            //print items from the order        
            $pqty = $prow["numOfProduct"];
            
            if($pqty > 0){//only print out items ordered
            echo "<tr>";
            echo "<td></td><td>".$pname."</td><td>".$pqty."</td><td>$".$pprice."</td></tr>";
            $totalprice = $totalprice + ($pqty * $pprice); //add items to price
}
            }
        }
        
        //Print out the total price
        echo "<tr><td></td><td><b>Total Price</b></td><td>$".money_format ('%i' , $totalprice )."</td><tr>";
    }
} else {
    echo "<tr><td>There are no orders. Please return to your other duties.</td></tr>";
}

  echo "</table>"; 
}}

$home->DisplayFooter();
?>
