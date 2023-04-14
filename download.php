
<html>
<head>
	<title>Download File using PHP</title>
</head>
<body>

<h2>Download File from HERE : </h2>
<a href="download.php?file=C:\xampp\htdocs\Projects\Register\gfg-40.png">click HERE</a>



</body>
</html>

<?php 
if(!empty($_GET['file']))
{
	$filename = basename($_GET['file']);
	$filepath = 'C:\xampp\htdocs\Projects\Register' . $filename;
	if(!empty($filename) && file_exists($filepath)){

//Define Headers
		header("Cache-Control: public");
		header("Content-Description: FIle Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/zip");
		header("Content-Transfer-Emcoding: binary");

		readfile($filepath);
		exit;

	}
	else{
		echo "This File Does not exist.";
	}
}

 ?>