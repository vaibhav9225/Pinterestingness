<?php
session_start();
if(!isset($_SESSION['pinterest'])) $_SESSION['pinterest'] = 0;
if(!isset($_SESSION['classifier'])) $_SESSION['classifier'] = 0;
$reader = fopen("./data/products.txt", "r");
$map = array();
$pinterest = [1, 2, 3, 4, 5];
$classifier = [11, 12, 13, 14, 15];
shuffle($pinterest);
shuffle($classifier);
if($reader){
	while(($line = fgets($reader)) !== false){
		$map[] = $line;
    }
    fclose($reader);
}
else echo 'Invalid File';
if(isset($_POST['pinterest'])){
	$_SESSION['pinterest'] += 1;
}
if(isset($_POST['classifier'])){
	$_SESSION['classifier'] += 1;
}
?>
<!Doctype html>
<html>
<head>
	<title>Pinterestingness</title>
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
	<div><b>Pinterest Votes:</b> <?php echo $_SESSION['pinterest']; ?></div>
	<div><b>Classifier Prediction Votes:</b> <?php echo $_SESSION['classifier']; ?></div>
	<h2>Evaluation</h2>
	<form action="evaluation.php" method="POST">
		<h4>Pinterest Items <input type="checkbox" name="pinterest" value="1" /></h4>
		<hr>
		<?php
		for($i=0; $i<5; $i++){			
			echo "<img src='./img/".$pinterest[$i].".png' />&nbsp;&nbsp;";
		}
		?>
		<br>
		<h4>Classifier Predicted Items <input type="checkbox" name="classifier" value="2" /></h4>
		<hr>
		<?php
		for($i=0; $i<5; $i++){
			echo "<img src='./img/".$classifier[$i].".png' />&nbsp;&nbsp;";
		}
		?>
		<br>
		<input type="submit" value="Submit Survey" class="button" style="float:left;"/>
	</form>
</body>
</html>