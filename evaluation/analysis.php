<?php
$titles = array();
$mapP = array();
$mapE = array();
$pinterest = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$ebay = [11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
shuffle($pinterest);
shuffle($ebay);
$reader = fopen("./data/products.txt", "r");
if($reader){
	while(($line = fgets($reader)) !== false){
		$titles[] = $line;
    }
    fclose($reader);
}
else echo 'Invalid File';
if(isset($_POST['pin_like']) and !empty($_POST['pin_like']) and isset($_POST['ebay_like']) and !empty($_POST['ebay_like'])){
	
	foreach($_POST['pin_like'] as $index){
		$title = $titles[$index-1];
		$words = explode(' ', $title);
		foreach($words as $word){
			if(isset($mapP[$word])) $mapP[$word] += 1;
			else $mapP[$word] = 1;
		}
	}
	foreach($_POST['ebay_like'] as $index){
		$title = $titles[$index-1];
		$words = explode(' ', $title);
		foreach($words as $word){
			if(isset($mapE[$word])) $mapE[$word] += 1;
			else $mapE[$word] = 1;
		}
	}
	arsort($mapP);
	arsort($mapE);
	$str = "";
	$count = 0;
	foreach($mapP as $word=>$count){
		$count++;
		$str .= $word.":".$count.", ";
		if($count == 3) break;
	}
	echo '<b>Top pinterest terms:</b> '.substr($str, 0, strlen($str)-2);
	$str = "";
	$count = 0;
	foreach($mapE as $word=>$count){
		$count++;
		$str .= $word.":".$count.", ";
		if($count == 3) break;
	}
	echo '<br>';
	echo '<b>Top ebay terms:</b> '.substr($str, 0, strlen($str)-2);
	echo '<br><hr>';
}
?>
<!Doctype html>
<html>
<head>
	<title>Pinterestingness</title>
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
	<h2>Analysis</h2>
	<form action="analysis.php" method="POST">
		<h4>Pinterest Items</h4>
		<hr>
		<?php
		for($i=0; $i<10; $i++){
			echo "<label for='".$pinterest[$i]."'><img src='./img/".$pinterest[$i].".png' /></label>";
			echo '<input type="checkbox" name="pin_like[]" value="'.$pinterest[$i].'" id="'.$pinterest[$i].'"/>';
		}
		?>
		<br>
		<h4>Ebay Items</h4>
		<hr>
		<?php
		for($i=0; $i<10; $i++){
			echo "<label for='".$ebay[$i]."'><img src='./img/".$ebay[$i].".png' /></label>";
			echo '<input type="checkbox" name="ebay_like[]" value="'.$ebay[$i].'" id="'.$ebay[$i].'" />';
		}
		?>
		<br>
		<input type="submit" value="Submit Survey" class="button"/>
	</form>
</body>
</html>