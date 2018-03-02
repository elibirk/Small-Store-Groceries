<?php require("template.php");
  $contact = new Page();
  $contact->pagename = "Contact Us";
  $contact->title = " - Contact Us";
  $contact->DisplayHeader();
  
  //form to get customer feedback
  ?>


<form action="contact.php" method="post" novalidate>

<table border="0" bgcolor=#ffe6cc width="764">
<tr>
  <td>Name<font color="red">*</font></td>
  <td align="center"><input type="text" name="customer" size="3"
     maxlength="30" required="true"></td>
</tr>
<tr>
  <td>Email<font color="red">*</font></td>
  <td align="center"><input type="text" name="email" size="3" maxlength="30" required="true"></td>
</tr>
<tr>
  <td>Comment<font color="red">*</font></td>
  <td align="center"><textarea name="comment" rows="5" cols="40" required="true'"></textarea></td>
</tr>
<tr>
  <td>Who should this be directed to?<font color="red">*</font></td>
  <td><select name="find">
        <option value = "a">Sales</option>
        <option value = "b">Shipping</option>
        <option value = "c">Media</option>
        <option value = "d">Unknown/Other</option>
      </select>
  </td>
</tr>
<tr><td><font color="red">*</font> All fields are required.</td></tr>
<tr>
  <td colspan="2" align="center"><input type="submit" value="Submit">

<?php  $contact->DisplayFooter(); ?>