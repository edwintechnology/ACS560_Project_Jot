<?php //index.php
session_start();
if($_SESSION["token"] == ""){
	header("location: /jot/index.html");
session_destroy();
}
$url = "http://10.0.0.77/jot/service2.php?wsdl";
$client = new SoapClient($url);

$token = $_SESSION["token"];

$rslt = $client->getAllKeys($token);
#var_dump($rslt);
$entities = $rslt->entities;
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<title> Jot - Home </title>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="/jot/home/css/home.css" />
	<link rel="stylesheet" type="text/css" href="/jot/home/css/popup.css" />
	<script type="text/javascript" src="/jot/home/js/popup.js"></script>
</head>
<body>
	<div id="container">
		<div id="topNav">
			[No Supported Image Available]
		<div id="items" style="float:right; padding-right:10px;">
		<table>
		<tr>
		<td>
			<input type="button" value="upload" id="upload-btn" />
		</td><td>		
	<input type="text" id="searchBox" value="Search" style="float:right" />
	</td></tr></table>	
	</div>
		</div>
		<div id="leftTab">
		<ul style="list-style:none;">
			<li><a href="#">My Files</a></li>
			<li><a href="#">Shared Files</a><li>
		</ul>
		</div>
		<div id="rightTab">
			<?php
			 echo "<table cellpadding='0' cellspacing='0' width='100%'>";
			 echo "<tr><td style='width:75%' valign='top'>";
			 echo "<table class='filestable' cellpadding='0' cellspacing='0' width='100%'>";
			 echo "<tr>";
#			 echo "<th> name </th><th> file size </th><th>type</th><th> modified </th>";
			 echo "<th> name </th><th> file size </th><th> modified </th>";
			 echo "</tr>";
foreach($entities as $key => $entity) {
#			 echo "<tr><td>$entity->key</td><td>??</td>??<td></td><td>??</td>";
			 echo "<tr><td>$entity->key</td><td>$entity->item_memory_bytes</td><td>$entity->modified</td>";
}
			 echo "</table></td></tr></table>";
			 ?>
		</div>
	</div>
<div class="background"></div>
<div class="upload">
<h1> File Upload </h1>
	<form method="post" action="php/grabfile.php" enctype="multipart/form-data">
		<table>
			<tr>
				<td>
					File Type:
				<td>
					<select name="item_type">
					<option value='image'>Image</option>
					<option value='audio'>Audio</option>
					<option value='video'>Video</option>
					<option value='text'>Text</option>
				</td>
			</tr>
			<tr>
				<td>
					Select File:
				</td>
				<td>
					<input type="file" name="filename" id="filename" />
				</td>
			</tr>
			<tr>
				<td valign="top"> Comments:</td>
				<td> <textarea Columns="40" Rows="5" name="annotation"></textarea>
				</td>
			</tr>
				<tr><td>Special Key</td><td><input type="text" name="special" /></td></tr>
			<tr>
				<td colspan="2">
					<input type="button" class="login-btn" value="Cancel" id="cancel-btn" />
					<input type="submit" class="login-btn" value="Add File"/>
				</td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>
