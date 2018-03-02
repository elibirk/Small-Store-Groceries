<?php 
  //front page; named index to make it automatically appear
  require("template.php");
  $home = new Page();
  $home->pagename = "Welcome!";
  $home->title = "";
  $home->DisplayHeader();
  ?>
  


<?php
//gather photos and shuffle them to display random choices on main page
  $pictures = array('egg.jpg', 'strawberry.jpg', 'mango.jpg', 'pepper.jpg', 'lemon.jpg', 'oranges.jpg', 'apples.jpg', 'corn.jpg');

  shuffle($pictures);
?>


<table border="0" bgcolor="#d9f2e6">
<tr bgcolor="#b3e6ff" width="500">
   <?php
      for ($i = 0; $i < 3; $i++) {
        echo "<td align=\"center\"><img src=\"images/";
        echo $pictures[$i];
        echo "\"/ height='50%'></td>";
    }
?>
</tr>
</table>
   <a href="orderform.php"><font color="black" size="7">Place an order here!</font></a><br />
<?php  $home->DisplayFooter(); ?>