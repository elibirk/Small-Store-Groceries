<?php

require("template.php");
 require("exceptions.php");
  $page = new Page();
  $page->pagename = "Add a Product";
  $page->title = " - Add a Product";
  $page->DisplayHeader();
  require("db.php");
  
  //make sure we're logged in:
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
    //name and password are correct, show the page
    //essentially just a form that sends name and price to addproduct.php
  
  ?>
  
  
<form action="addproduct.php" method="post" novalidate>
     <input type="hidden" name="username" value="<?php echo $username; ?>">  
    <input type="hidden" name="password" value="<?php echo $password; ?>">
  <table border="0" bgcolor=#ffe6cc width="764">
<tr>
  <td>Product Name (no spaces):</td>
  <td align="center"><input type="text" name="product" size="10" maxlength="10" required="true"></td>
</tr>
<tr>
  <td>Price</td>
  <td align="center"><input type="text" name="price" size="10" maxlength="4" required="true"></td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" value="Add Item">
</form>


<?php 
}}

$page->DisplayFooter(); ?>