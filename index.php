<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>Extra Credit Assignment</title>
</head>

<body id="body">
	<center>
		<h1>Anirudh Bachiraju | Posting Website</h1>
		<br />
		<div id="postingdiv">
			<textarea rows="10" cols="100" name="post" form="form"></textarea>
			<form action="index.php" method="post" id="form">
				<input class="button" type="submit">
			</form>
		</div>
		<br />
		<hr />
		<br />
	</center>
	<br />
	<hr />
<?php
$myfile = fopen("data.txt", "a+") or die("Unable to open file!");

while(!feof($myfile)) {
  echo fgets($myfile) . "<br />";
}
?>
</body>

</html>
