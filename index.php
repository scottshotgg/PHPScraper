<html>
 <body>
 <?php


$url = 'http://news.tj/ru/news/teatr-mayakovskogo-za-chto-smertnaya-kazn';
$output = file_get_contents($url); 
file_put_contents("test_file.txt", $output);

$stringForFile;
$finalArray = array();

$titleTagRegex = '/<h1 class="title" id="page-title">(.*?)<\/h1>/i';
$strippedTitleTagResult = preg_match_all($titleTagRegex, $output, $titleTagMatches);
print_r($titleTagMatches[1][0]);
echo "<br><br><br><br><br>";
$z = 0;
array_push($finalArray, $titleTagMatches[1][0]);
$stringForFile .= $finalArray[$z] . "\n\n\n\n\n\n";
$z++;

$dateTagRegex = '/<div class="news_date">(.*?)<\/div>/i';
$strippedDateTagResult = preg_match_all($dateTagRegex, $output, $dateTagMatches);
print_r($dateTagMatches[1][0]);
echo "<br><br><br><br><br>";
array_push($finalArray, $dateTagMatches[1][0]);
$stringForFile .= $finalArray[$z] . "\n\n\n\n\n\n";
$z++;

$authorTagRegex = '/<div class="name_author">(.*?)<\/div>/i';
$strippedAuthorTagResult = preg_match_all($authorTagRegex, $output, $authorTagMatches);
print_r($authorTagMatches[1][0]);
echo "<br><br><br><br><br>";
array_push($finalArray, $authorTagMatches[1][0]);
$stringForFile .= $finalArray[$z] . "\n\n\n\n\n\n";
$z++;

$pTagRegex = '/<p>(.*?)<\/p>/i';
$strippedPTagResult = preg_match_all($pTagRegex, $output, $pTagMatches);

$amount = count($pTagMatches);
//echo $amount;
//echo "<br>";
print_r($pTagMatches[1]);
file_put_contents("p_tag_matches.txt", $pTagMatches[1]);
echo "<br><br><br><br><br>";

// stripping out all extraneous tags from inbetween the <p> and </p> tags
$generalTagRegex = '/<(.*?)>(.*?)<\/(.*?)>/i';

$x = count($pTagMatches[1]);
//echo $x;
echo "<br><br><br><br>";

for($y = 0; $y < $x; $y++) {
	//echo $y;
	if(strlen($pTagMatches[1][$y]) != 0) {
		$finalStrippedResult = preg_match_all($generalTagRegex, $pTagMatches[1][$y], $generalTagMatches);
		

		if(strlen($generalTagMatches[2][0]) == 0) {
			echo $z;
			echo "<br>";
			$generalTagMatches[2][0] = $pTagMatches[1][$y];
			array_push($finalArray, $pTagMatches[1][$y]);
			$stringForFile .= $finalArray[$z] . "\n\n\n";
			echo($finalArray[$z]);
			echo "<br><br><br>";
			$z++;
		} else {
			echo $z;
			echo "<br>";
			array_push($finalArray, $generalTagMatches[2][0]);
			$stringForFile .= $finalArray[$z] . "\n\n\n";
			echo($finalArray[$z]);
			echo "<br><br><br>";
			$z++;
		}

	//	print_r($generalTagMatches[2]);
	}
}


file_put_contents("general_tag_matches.txt", $stringForFile);
//print_r($finalArray);


//echo $generalAmount;
//print_r($gereralTagMatches[2]);



?>
 </body>
</html>