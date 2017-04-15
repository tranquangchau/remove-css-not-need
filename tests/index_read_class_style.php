<h1>Read tag class css</h1>
<?php
error_reporting(0);

require_once(dirname(__FILE__) . '/bootstrap.php');


$file_read = "font-awesome.min.css";
$oParser = new Sabberworm\CSS\Parser(file_get_contents($file_read));
$oDoc = $oParser->parse();

$after = $oDoc->aContents;

//$can_xoa_tai = "#header";
foreach ($after as $key => $value) {
    //echo $key;
    $kiem_t_tai = $value->aSelectors[0]->sSelector; //string hien tai
	$kiem_t_tai=substr($kiem_t_tai,1); //remove .
	
	echo ($kiem_t_tai.'<br>');

}
