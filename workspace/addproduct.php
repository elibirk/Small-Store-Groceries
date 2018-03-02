<?php
require("template.php");
 require("exceptions.php");
  $process = new Page();
  $process->pagename = "Add a Product";
  $process->title = " - Add a Product";
  $process->DisplayHeader();
  
    // create short variable names
  $name = clean($_POST['product']);
  $price = clean($_POST['price']);

//connect to database:
require("db.php");
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


 //attempt to add the info 
$query = "insert into products (productName, price) VALUES ('$name', $price)";
 
$result = mysqli_query($mysql, $query);
if(!$result){
    echo "Cannot access database, please contact an admin.";
    exit;
}

//queries the database to make sure the product exists after adding
$query = "select * from products where productName=\"".$name."\"";

$result = mysqli_query($mysql, $query);
if(!$result){
    echo "Cannot verify addition, please contact an admin.";
    exit;
}

//Output for confirmation
echo "<table border='1px solid black'><tr><td>Congrats! $name were added with the price of $$price</td></tr></table><br>";

}}
$process->DisplayFooter(); ?>