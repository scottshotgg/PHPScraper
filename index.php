<html>
 <body>
 <?php


$url = 'http://news.tj/ru/news/teatr-mayakovskogo-za-chto-smertnaya-kazn';
$output = file_get_contents($url); 
file_put_contents("test_file.txt", $output);

$pTagRegex = '/<p>(.*?)<\/p>/i';
$strippedPTagResult = preg_match_all($pTagRegex, $output, $pTagMatches);

$amount = count($pTagMatches);
//echo $amount;
//echo "<br>";
print_r($pTagMatches[1]);
file_put_contents("p_tag_matches.txt", $pTagMatches[1]);

// stripping out all extraneous tags from inbetween the <p> and </p> tags
$generalTagRegex = '/<(.*?)>(.*?)<\/(.*?)>/i';
$finalStrippedResult = preg_match_all($generalTagRegex, $pTagMatches[1][2], $gereralTagMatches);
$generalAmount = count($gereralTagMatches);
echo "<br><br><br><br><br>";
echo $generalAmount;
print_r($gereralTagMatches[2]);

file_put_contents("general_tag_matches.txt", $gereralTagMatches[2]);

?>
 </body>
</html>