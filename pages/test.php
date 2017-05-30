
<?php
//choose stock to look at
//header('Conent-type:type/html;charset=gb2312');

$val=$_GET['type'];
//$symbol = '/user/';
//echo '<h1>Directory: ' . $symbol . '</h1>';
$url = $val;
if (!($contents = file_get_contents($url))) {
die('Failure to open ' . $url);
}
// extract relavant data
echo $contents;

?>