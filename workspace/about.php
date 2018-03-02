<?php require("template.php");
  $contact = new Page();
  $contact->pagename = "About Us";
  $contact->title = " - About Us";
  $contact->DisplayHeader();
  ?>
  
  <table  width='764' border="1">
      <tr>
          <td>
           <center>Developed by Leah Perry.</center>
          </td></tr>
      <tr>
          <td>
           <center>Encypted email and password storage and comparison.</center>
          </td></tr>
           <tr>
              <td>
                 <center>Input cleansing on all fields.</center>
              </td>
          </tr>
          <tr>
          <td>
              <center>Can repeat usernames because emails are used as primary keys.</center>
          </td>
          </tr>
          <tr>
              <td>
                  <center>Order form acts dynamically based on database.</center>
              </td>
          </tr>
          <tr>
          <td>
             <center>Home-y aesthetic lets customers feel like their experience is personalized</center>
          </td>
          </tr>
          <tr>
              <td>
                  <center>Use of colors that psychologically promote hunger (reds and yellows).</center>
              </td>
          </tr>
          <tr>
              <td>
                  <center>Only logged-in employees can access sensitive pages (i.e. orders).</center>
              </td>
          </tr>
          
      </tr>
      
      </table>
      
  
  <?php  $contact->DisplayFooter(); ?>