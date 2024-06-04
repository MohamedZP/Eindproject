<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css"/>
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Log out</title>
</head>
<body>
<?php 

session_start();
session_destroy();
header('Location: index.php');


 ?>

</body>
</html>
