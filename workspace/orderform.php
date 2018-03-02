
<?php require("template.php");
  require_once("exceptions.php");
  require_once("db.php");
  $order = new Page();
  $order->setPagename("Order Form");
  $order->setTitle(" - Order");
  $order->DisplayHeader();

//basic form to order items
?>
<form action="processorder.php" method="post" novalidate>

<table border="0" bgcolor=#ffe6cc width="764">
<tr bgcolor="#f49f36">
  <td width="100"><font color="white" size="5px"><center>Item</center></font></td>
  <td width="15"><font color="white" size="5px"><center>Regular Price</center></font></td>
  <td width="15"><font color="white" size="5px"><center>Quantity</center></font></td>
</tr>

<?php

//Query database for current products and prices, print them out as an order form
$query="select * from products"; 
$result = mysqli_query($mysql, $query);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $pname = $row["productName"];
        echo "<tr><td>" . $pname. "</td><td>$" . $row["price"]. "</td><td align=\"center\"><input type=\"text\" name=".$pname." size=\"3\" 
        maxlength=\"3\"></td></tr>";
    }
} else {
    echo "<tr><td>There are no products available, please contact us for assistance.</td></tr>";
}

//now get shipping information before submission
  ?>

<tr></tr>
<tr>
  <td>Shipping Address</td>
  <td align="center"><input type="text" name="address" size="40" maxlength="40" required="true"></td>
</tr>
<tr>
  <td>Card Number</td>
  <td align="center"><input type="text" name="ccn" size="40" maxlength="30" required="true"></td>
</tr>
<tr>
  <td>CCV</td>
  <td align="center"><input type="text" name="ccv" size="3" maxlength="3" required="true"></td>
</tr>
<tr>
  <td>Email</td>
  <td align="center"><input type="text" name="email" size="40" maxlength="40" required="true"></td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" value="Submit Order"></td>
</tr>
</table>


<?php $order->DisplayFooter(); ?>