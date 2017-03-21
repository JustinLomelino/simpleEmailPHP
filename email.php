<!--
A simple email form using sstmp and php
requires sstmp and mailutils

Author: Justin Lomelino, March 21st, 2017
-->

<?php
/*
also requires /etc/sstmp/sstmp.conf to contain:
root=postmaster
mailhub=smtp.gmail.com:587
hostname=AHostname
AuthUser=AGmailUserName@gmail.com
AuthPass=TheGmailPassword
FromLineOverride=YES
UseSTARTTLS=YES
*/
?>

<h2>A form to send email using sstmp</h2>
<form action="email.php" method="post">
	<p>First Name: <input type="text" name="firstname" /></p>
	<p>Last Name: <input type="text" name="lastname" /></p>
	<p>Recipient Email: <input type="text" name="rEmail" /></p>
	<p>Subject:<br> <input type="text" name="subject" size="100"/></p>
	<p>Message:<br> <textarea style="width:1000;height:100;" name="message" ></textarea></p>
	<p><input type="submit" name="submit" /><input type="reset"/></p>
</form>

<?php
	if(count($_POST) > 0 && isset($_POST['submit'])){
		echo "<br><br>";
		echo "<h3>Message Details</h3>";
		echo "From: ";
		echo htmlspecialchars($_POST['firstname']);
		echo " ";
		echo htmlspecialchars($_POST['lastname']);
		echo "<br>";
		echo "To: ";
		echo htmlspecialchars($_POST['rEmail']);
		echo "<br>";
		echo "Subject: ";
		echo htmlspecialchars($_POST['subject']);
		echo "<br>";
		echo "Message: ";
		echo htmlspecialchars($_POST['message']);
		echo "<br>";
	}


	error_reporting(E_ALL);

	function sendMail() {

		echo '<br>email sent.<br>';
		exec("echo -e 'From: ".$_POST['firstname']." ".$_POST['lastname']."\n".$_POST['message']."' | mail -s '".$_POST['subject']."' ".$_POST['rEmail']." ");

	}

	if(count($_POST) > 0 && isset($_POST['submit'])){
		sendMail();
	}
?>
