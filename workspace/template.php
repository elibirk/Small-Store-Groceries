<?php
class Page
{
    //get page info from the page
    public $title;
    public $pagename;
    
    public function setTitle($ptitle){
      $this->title = $ptitle;
    }
    public function setPagename($pname){
      $this->pagename = $pname;
    }

  public function DisplayHeader()
  { 
         function clean($data) { //cleans the data of whitespace and code
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>   
<html>
  
  
  
    <style>
/* Much of the code related to style and div containers is edited from W3School's login tutorial example

These are all style pieces that describe how things look */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/*This is for inputs*/
input[type=submit] {
    background-color: #f49f36;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 150px;
    height: 45px;
}


/* Set a style for all buttons */
button {
    background-color: #f49f36;
    color: white;
    padding: 0px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    height: 45px;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44036;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)}
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)}
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
  






<head>
  <title>Small Store Groceries<?php echo $this->title ?></title>
</head>
<body background="images/bg6.jpg">
  <center>
  <table><tr><td bgcolor="white" width="764">
    <center>
	<a href="index.php">
        <img src="images/header.jpg" alt="Small Store Groceries" height='70%'>
    </a>
    	<h2><?php echo $this->pagename ?></h2>
</a>

<?php
}
//end header


//footer:
  public function DisplayFooter()
  {
?>
 <table bgcolor="#EDEDED" width="764">
<tr>
    <td align="right" width="382">
      <button onclick="document.location.href='contactpg.php'; return false;" style="width:auto;">Contact Us</button>
   </td>
   <td align="left">
     <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Customer Login</button>
   </td>
   <td align="left">
     <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Employee Login</button>
   </td>
   <td align="left" width="382">
      <button onclick="document.location.href='about.php'; return false;" style="width:auto;">About Us</button>
 
   </td>
  </tr>


</table> 
</td></tr></center></table>
</center>

<!-- customer log in button -->
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="clogin.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="images/lemon.jpg" alt="Avatar" class="avatar">
    </div>
    
    <div class="container">
      <label><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="username" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        
      <button type="submit">Login</button>
      <input type="checkbox" checked="checked"> Remember me
    </div>
    
    
        <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw"><a href="newuser.php">Create an account</a></span> 
    </div>
  </form>
</div>

<!-- employee log in button -->
<div id="id02" class="modal">
  
  <form class="modal-content animate" action="login.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="images/lemon.jpg" alt="Avatar" class="avatar">
    </div>
    
    <div class="container">
      <label><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="username" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        
      <button type="submit">Login</button>
      <input type="checkbox" checked="checked"> Remember me
    </div>
    
        <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

    </body>
</html>
<?php
  }
}

?>
