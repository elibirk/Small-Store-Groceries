<?php
require("template.php");
require("exceptions.php");
  $process = new Page();
  $process->pagename = "Add a Product";
  $process->title = " - Add a Product";
  $process->DisplayHeader();
  
    // create short variable names
  $email = sha1(clean($_POST['email']));
  $username = clean($_POST['username']);
  $address = clean($_POST['address']);
  $pw = sha1($_POST['password1']);
  $pw2 = sha1($_POST['password2']);
  $phone = clean($_POST['phone']);

  

echo "<table border=\"0\" bgcolor=#ffd3aa width=\"764\">";
if($pw != $pw2){
    //passwords aren't the same, probably a typo
    ?>
    <tr><td><center>You passwords do no match. Please <a href="newuser.php">try again.</a></center></td></tr>
    
    <?php
} else {


//connect to database:
require("db.php");

//add the customer:
$query = "insert into customers (customerEmail, username, password, address, phone) VALUES ('$email', '$username', '$pw', '$address', '$phone')";
 echo $username;
    //attempt to add the info    
$result = mysqli_query($mysql, $query);
if(!$result){ //if there is no result, either it's a database error or the same email is being used
    echo "Did you already make an account? It seems like we have that email on record. Contact an admin if you have not.";
    $process->DisplayFooter(); 
    exit;
}

//queries the database to make sure the entry exists after adding
$query = "select * from customers where customerEmail=\"".$email."\"";

$result = mysqli_query($mysql, $query);
if(!$result){
    echo "Cannot verify addition, please contact an admin.";
    $process->DisplayFooter(); 
    exit;
}


echo "<tr><td>Congrats! You have made an account, please click below to log in.</td></tr>";
}

$process->DisplayFooter(); ?>