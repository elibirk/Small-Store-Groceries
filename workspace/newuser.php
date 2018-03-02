<?php
require("template.php");
require("exceptions.php");
  $page = new Page();
  $page->pagename = "Create Account";
  $page->title = " - Create Account";
  $page->DisplayHeader();
  
  //form to get information for making a new customer
  ?>
  
  <form action="newcustomer.php" method="post" novalidate>
  
  <table border="0" bgcolor=#d9f2e6 width="764">
<tr>
  <td>Email:</td>
  <td align="center"><input type="text" name="email" size="20" maxlength="20" required="true"></td>
</tr>
<tr>
  <td>Username:</td>
  <td align="center"><input type="text" name="username" size="20" maxlength="20" required="true"></td>
</tr>
<tr>
  <td>Password:</td>
  <td align="center"><input type="password" name="password1" size="30" maxlength="30" required="true"></td>
</tr>
<tr>
  <td>Confirm Password:</td>
  <td align="center"><input type="password" name="password2" size="30" maxlength="30" required="true"></td>
</tr>
<tr>
  <td>Address:</td>
  <td align="center"><input type="text" name="address" size="50" maxlength="50" required="true"></td>
</tr>
<tr>
  <td>Phone:</td>
  <td align="center"><input type="text" name="phone" size="10" maxlength="15"></td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" value="Create Account">



<?php $page->DisplayFooter(); ?>