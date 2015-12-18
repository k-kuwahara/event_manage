<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Error</title>
<link rel="stylesheet" href="/css/common.css" />
</head>
<body>
	<div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
		<a href="/top"><button class="marT20 top">TOPへ</button></a>
	</div>
</body>
</html>