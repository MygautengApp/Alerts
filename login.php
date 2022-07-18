<?php
session_start();
require_once 'config/config.php';
$token = bin2hex(openssl_random_pseudo_bytes(16));

// If User has already logged in, redirect to dashboard page.
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === TRUE)
{
	header('Location:index.php');
}

// If user has previously selected "remember me option": 
if (isset($_COOKIE['series_id']) && isset($_COOKIE['remember_token']))
{
	// Get user credentials from cookies.
	$series_id = filter_var($_COOKIE['series_id']);
	$remember_token = filter_var($_COOKIE['remember_token']);
	$db = getDbInstance();
	// Get user By series ID: 
	$db->where('series_id', $series_id);
	$row = $db->getOne('admin_accounts');

	if ($db->count >= 1)
	{
		// User found. verify remember token
		if (password_verify($remember_token, $row['remember_token']))
        	{
			// Verify if expiry time is modified. 
			$expires = strtotime($row['expires']);

			/*if (strtotime(date()) > $expires)
			{
				// Remember Cookie has expired. 
				clearAuthCookie();
				header('Location:login.php');
				exit;
			}*/

			$_SESSION['user_logged_in'] = TRUE;
			$_SESSION['admin_type'] = $row['admin_type'];
			header('Location:index.php');
			exit;
		}
		else
		{
			clearAuthCookie();
			header('Location:login.php');
			exit;
		}
	}
	else
	{
		clearAuthCookie();
		header('Location:login.php');
		exit;
	}
}

include BASE_PATH.'/includes/header.php';
?>
<head>
<link rel="stylesheet" href="css/styles.css">
</head>
<div class="header"  style=" padding: 60px;
  text-align: center;
  background: #275937;
  color: white;
  font-size: 30px;height:5px;">
 
  <img src="images/parliament.png" style="padding-right:500px;top:0px;right:30px; position:absolute;height:19%;">
</div>

<div id="page-" class="col-md-4 col-md-offset-4" style="background: url(images/parliamenthouse.png);background-repeat: no-repeat;padding-right:20%;padding-top: 150px; width:500%;height:1000px;right:30px;" >


<div  >

<p><a href="index.php"><span><h2>View Utility Alert</h2></span></a></p>
<!--<img src="images/parliamenthouse.png" style="padding-right:20%; width:500%;height:300%;right:30px;" >-->
	
		</div>
	
</div>
<footer style=" position: fixed;
    height: 50px;
    background-color: #9e7c0c;
    bottom: 0px;
    left: 0px;
    right: 50px;
    margin-bottom: 0px;
	 padding: 60px">
  
</footer>

<?php include BASE_PATH.'/includes/footer.php'; ?>
