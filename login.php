<?php 
	session_start(); /* Starts the session */
	error_reporting(E_ALL);
	// Check for submitted login form        
	if(isset($_POST['Submit'])){
		// Initialize login array for data from login-creds.csv
		$logins = array();

		// open login-creds.csv and begin iterater counter
		$f = fopen("login-creds.csv", "r");
		$i = 0;
		while (($line = fgetcsv($f)) !== false) {
			$j = 0;
			$prevcell;
			foreach ($line as $cell) {
				// Save login and password from each row of login-creds.csv
				if($j == 0) {
					$logins[$cell];
				}
				if($j == 1) {
					$logins[$prevcell] = $cell; 
				}
				$j++;
				$prevcell = $cell;
			}
			$i++;
		}
			fclose($f);

			// Check for then assign Username and Password variable from submission
			$Username = isset($_POST['Username']) ? $_POST['Username'] : '';
			$Password = isset($_POST['Password']) ? $_POST['Password'] : '';

			// Check for the username and password in the array
		if (isset($logins[$Username]) && $logins[$Username] == $Password){
			// Set session variables and redirect to index page
			$_SESSION['UserData']['Username']=$logins[$Username];
			header("location:index.php");
			exit;
		} else {
			// Error message
			$msg="<span style='color:red'>Invalid Login Details</span>";
		}
	}
?>

<form action="" method="post" name="Login_Form">
	<table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
		<?php if(isset($msg)){?>
			<tr>
				<td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
			</tr>
		<?php } ?>
		<tr>
			<td colspan="2" align="left" valign="top"><h3>Login</h3></td>
		</tr>
		<tr>
			<td align="right" valign="top">Username</td>
			<td><input name="Username" type="text" class="Input"></td>
		</tr>
		<tr>
			<td align="right">Password</td>
			<td><input name="Password" type="password" class="Input"></td>
		</tr>
			<tr>
			<td> </td>
			<td><input name="Submit" type="submit" value="Login" class="Button3"></td>
		</tr>
	</table>
</form>
