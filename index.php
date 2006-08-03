<?php
require_once 'classes/generator.php';

$charSet = 'iso-8859-1';
$contentType = (preg_match("/application\/xhtml\+xml/", isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '') ? 'application/xhtml+xml' : 'text/html') . ";charset=$charSet";
		header("Content-Type: $contentType");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt">
<head>
	<title>[ DAO Generator ]</title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
	<link rel="add icon" href="/addicon.ico" type="image/x-icon" />
	<meta http-equiv="content-type" content="<?php echo $contentType; ?>" />
	<meta http-equiv="content-language" content="pt-br" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta http-equiv="content-script-type" content="text/javascript" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta name="resource-type" content="document" />
	<meta name="author" content="Jonas Raoni Soares Silva @ http://raoni.org" />
	<link rel="stylesheet" href="main.css" media="all" type="text/css" />
</head>
<body>
	<div id="all">
		<div id="header">
			<h1>[ DAO Generator ]</h1>
			<div id="menu">
			</div>
		</div>
		<div id="content">
			<form id="form" action="index.php" method="post">
				<fieldset>
					<legend>Database login</legend>
					<label for="url">
						<span>Database URL</span>
						<input type="text" id="url" name="url" size="45" value="mysql://127.0.0.1/my_database" />
					</label>
					<label for="user">
						<span>Username</span>
						<input type="text" id="user" name="user" size="45" value="root" />
					</label>
					<label for="pass">
						<span>Password</span>
						<input type="password" id="pass" name="pass" size="45" />
					</label>
					<div class="right">
						<input type="submit" name="submit" value="[ Generate code ]" />
					</div>
				</fieldset>
			</form>
<?php

$x = &new Request;
if($x->has('submit')){
	$x = &new DAOGenerator($x->get('url'), $x->get('user'), $x->get('pass'));
	$x->output(true);
}

?>

		</div>
		<div id="footer">
		</div>
	</div>
</body>
</html>