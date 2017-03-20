<!--
A simple email form using sstmp and php
requires sstmp and mailutils

also requires /etc/sstmp/sstmp.conf to contain:
root=postmaster
mailhub=smtp.gmail.com:587
hostname=AHostname
AuthUser=AGmailUserName@gmail.com
AuthPass=TheGmailPassword
FromLineOverride=YES
UseSTARTTLS=YES
-->

<h2>A form to send email using sstmp</h2>
<form action="action.php" method="post">
	<p>First Name: <input type="text" name="firstname" /></p>
	<p>Last Name: <input type="text" name="lastname" /></p>
	<p>Recipient Email: <input type="text" name="rEmail" /></p>
	<p>Subject:<br> <input type="text" name="subject" size="100"/></p>
	<p>Message:<br> <textarea style="width:1000;height:100;" name="message" ></textarea></p>
	<p><input type="submit" name="submit" /><input type="reset"/></p>
</form>

<br><br>
<h3>Message Details</h3>
From: <?php echo htmlspecialchars($_POST['firstname']);?> <?php echo htmlspecialchars($_POST['lastname']); ?> <br>
To: <?php echo htmlspecialchars($_POST['rEmail']);?> <br>
Subject: <?php echo htmlspecialchars($_POST['subject']);?> <br>
Message: <?php echo htmlspecialchars($_POST['message']);?> <br>

<?php
error_reporting(E_ALL);

function sendMail() {

	echo '<br>email sent.<br>';
	exec("echo -e 'From: ".$_POST['firstname']." ".$_POST['lastname']."\n".$_POST['message']."' | mail -s '".$_POST['subject']."' ".$_POST['rEmail']." ");

}

if(count($_POST) > 0 && isset($_POST['submit'])){
	sendMail();
}
?>
