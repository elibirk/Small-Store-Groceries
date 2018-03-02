<?php require("template.php");
require_once("db.php");
  $login = new Page();
  $login->pagename = "Welcome!";
  $login->title = " - Account Page";
  $login->DisplayHeader();

  //only handle encrypted info
  $username = sha1($_POST['username']);
  $password = sha1($_POST['password']);

if (!isset($username) || !isset($password)) {
    //visitors must log in
    
    echo "<h1>Login unsuccessful. Please try again.</h1>";
}
else {

//check to make sure we have logged in
$query = "select count(*) from customers where
        customerEmail = '".$username."' and  
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
    ?>
    <h4>Login successful. Here are your pending orders:</h4> <table bgcolor=#ffd3aa width=\"764\">

<?php    
   
    
//query orders from this user
$query="select * from orders where email = '$username' or customerEmail = '$username'"; 
$result = mysqli_query($mysql, $query);
if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
        $totalprice = 0.00;
            //print header
  echo "<table width='764' border=\"1\" bgcolor=#ffe6cc><tr bgcolor=\"#f49f36\"><td><font color=\"white\">ID</font></td>
  <td><font color=\"white\">Date</font></td><td><font color=\"white\">Address</font></td><td><font color=\"white\">
  Completed?</font></td></tr>";
  
        if ($row["completed"] == 0){
            $comp = 'No';
        } else {
            $comp = 'Yes';
        }
        
        $id = $row["orderid"];
        echo "<tr><td>" . $id. "</td><td>" . $row["orderDate"]. "</td><td>".$row["address"]."</td><td>".$comp."</td></tr>";
        echo "<tr><td></td><td bgcolor=\"#f49f36\"><font color=\"white\">Item</font></td><td bgcolor=\"#f49f36\">
        <font color=\"white\">Quantity</font></td><td bgcolor=\"#f49f36\"><font color=\"white\">Price Each</font></td></tr>";
        
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
        echo "<tr><td></td><td bgcolor=\"#f49f36\"><b><font color=\"white\">Total Price</font></b>
        </td><td bgcolor=\"#f49f36\"><font color=\"white\">$".money_format ('%i' , $totalprice )."
        </font></td></tr></table><p></p>";
    }
} else {
    echo "<tr><td>There are no orders. Feel free to make one <a href=\"orderform.php\">here</a>.</td></tr>";
}


} else {
    //incorrect combo
    //echo a link to go back
    echo "Either your username or password was incorrect. 
    Please go back and try again.";
}

}

  ?>
  </table>
  

<?php $login->DisplayFooter(); ?>