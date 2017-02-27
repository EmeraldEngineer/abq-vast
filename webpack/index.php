<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<base href="<?php echo dirname($_SERVER["PHP_SELF"]) . "/"; ?>" />

		<title>ABQ-VAST</title>
	</head>
	<body>
		<abq-vast-app>Loading&hellip;</abq-vast-app>
	</body>
</html>