<?php require("template.php");
require_once("db.php");
  $login = new Page();
  $login->pagename = "Welcome!";
  $login->title = " - Employee Page";
  $login->DisplayHeader();


  //make sure we've logged in
  $username = $_POST['username'];
  $password = sha1($_POST['password']);


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
    //pass username & pw to next page
    ?>
    
<form action="vieworders.php" method="post">
    <input type="hidden" name="username" value="<?php echo $username; ?>">  
    <input type="hidden" name="password" value="<?php echo $password; ?>">
    <input type="submit" value="Current Orders">
</form>

<form action="additem.php" method="post">
    <input type="hidden" name="username" value="<?php echo $username; ?>">  
    <input type="hidden" name="password" value="<?php echo $password; ?>">
    <input type="submit" value="Add A Product">
</form>


<?php  
    

}
else {
    //incorrect combo
    //echo a link to go back
    echo "Either your username or password was incorrect. 
    Please go back and try again.";
}

}

  ?>
  
  

<?php $login->DisplayFooter(); ?>