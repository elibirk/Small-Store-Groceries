<?php
 require("template.php");
 require("exceptions.php");
  $contact2 = new Page();
  $contact2->pagename = "Message Sent";
  $contact2->title = " - Message Sent";
  $contact2->DisplayHeader();
  
    // create short variable names
  $customer = clean($_POST['customer']);
  $email = clean($_POST['email']);
  $comment = clean($_POST['comment']);
  $find = clean($_POST['find']);
  $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
?>


<?php
	echo "<center><p>Your message was sent at ".date('H:i, jS F Y')."</p>";

	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  	echo "<p>$email is not a valid email address, please <a href=\"contact.php\">go back</a> and try again.</p>";
} else {
	
	
	
$toaddress = "gensupport@smallstoregroceries.com";

$subject = "Feedback from web site";

$mailcontent = "Customer name: ".$customer."\n".
			   "Customer email: ".$email."\n".
               "Customer comments:\n".$comment."\n";

$fromaddress = "From: customer@smallstoregroceries.com";

	//select correct email
		if($find == "a") {
	  echo "<p>Message to: Sales.</p>";
	  $toaddress = "sales@smallstoregroceries.com";
	} elseif($find == "b") {
	    echo "<p>Message to: Shipping.</p>";
	    $toaddress = "shipping@smallstoregroceries.com";
	} elseif($find == "c") {
	    echo "<p>Message to: Media.</p>";
	    $toaddress = "media@smallstoregroceries.com";
	} elseif($find == "d") {
	  echo "<p>Message to: General Support.</p>";
	  $toaddress = "gensupport@smallstoregroceries.com";
	} else {
	  echo "<p>Invalid result, please <a href=\"contact.html\">go back</a> and try again.</p>";
	}
	
 	mail($toaddress, $subject, $mailcontent, $fromaddress);
					
					
					
		// save info in a file since email doesn't work for Cloud9			
		$outputstring = "name:\t".$customer." email: \t".$email." message:\t"
					.$comment."\n";

 if (!($fp = @fopen("$DOCUMENT_ROOT/team1orders/feedback.txt", 'ab'))){
  echo "<p><strong> Your message could not be processed at this time.
		    Please <a href=\"contact.html\">go back</a> and try again later.</strong></p></body></html>";
      throw new fileOpenException();
}
	@ $fp = fopen("$DOCUMENT_ROOT/team1orders/feedback.txt", 'ab');
	//change URL below if using in kermit:
	//fopen("/var/www/html/leah/team1orders/feebdback.txt", 'ab'

	  if (!flock($fp, LOCK_EX)){
	  	echo "<p><strong> Your message could not be processed at this time.
		    Please <a href=\"contact.html\">go back</a> and try again later.</strong></p></body></html>";
     throw new fileLockException();
}

	if (!fwrite($fp, $outputstring, strlen($outputstring))){
     echo "<p><strong> Your message could not be processed at this time.
		    Please <a href=\"contact.html\">go back</a> and try again later.</strong></p></body></html>";
		    throw new fileWriteException();
}
	
		flock($fp, LOCK_UN);
		fclose($fp);
		echo "<p>We will get back to you soon at: ";
		echo $email."</p>";
    echo "Have a nice day!<br />";
}

	
  $contact2->DisplayFooter();
?>

