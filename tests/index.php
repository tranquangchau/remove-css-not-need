<?php

require_once(dirname(__FILE__) . '/bootstrap.php');

//$oParser = new Sabberworm\CSS\Parser(file_get_contents('php://stdin'));
//$oParser = new Sabberworm\CSS\Parser(file_get_contents('files/mid.css'));
//$file_read ="files/values.css";
$file_read = "files/main.css";
$oParser = new Sabberworm\CSS\Parser(file_get_contents($file_read));
$oDoc = $oParser->parse();

//echo '#### Structure (`var_dump()`)'."\n";
//echo '<h1>start</h1>';
//var_dump($oDoc->aContents);
$after = $oDoc->aContents;

/////////////////////load file danh sach cac key can xoa
$file_list = "files_xoa/main.txt";
$file = fopen($file_list, "r");
//$data_file_read =  fgets($file);
$i = 0;
while (!feof($file)) {
    $data_file_read[$i] = trim(fgets($file));
    $i++;
}
fclose($file);
echo "<h2>File have Tag remove ".$file_list."</h2>";
//$data_file_read = file_get_contents("files_xoa/main.txt");
//var_dump($data_file_read);//die; //value get
echo implode("<br>",$data_file_read);
//$can_xoa_tai = "#header";
echo "<h2> File have css".$file_read . '</h2>';
foreach ($after as $key => $value) {
    //echo $key;
    $kiem_t_tai = $value->aSelectors[0]->sSelector; //string hien tai
    //if($key ==5){
        
        $sum_c  = count($value->aSelectors);
        if($sum_c >1){
            $kiem_t_tai ="";
            foreach ($value->aSelectors as $vl){
                //var_dump($vl);die;                
                if(empty($kiem_t_tai)){
                    $kiem_t_tai  = $vl;
                }else{
                    $kiem_t_tai  = $kiem_t_tai.", ".$vl;
                }
            }
        }
       // var_dump($ke_new);die;
      //  var_dump($value->aSelectors[1]->sSelector);die;
   // }
    echo $kiem_t_tai."<br>";
    if (in_array($kiem_t_tai, $data_file_read)) {
        //echo "Got Irix";
        unset($after[$key]);
        //die;
    }

//    if ($can_xoa_tai == $kiem_t_tai) {
//        unset($after[$key]);
//    }
}
//echo "end <br>";
//var_dump($data_file_read);die;
//var_dump($after[0]->aSelectors[0]->sSelector);
//var_dump($after[1]->aSelectors[0]->sSelector);
//die;
//var_dump($after[1]->aSelectors[0]->sSelector);die;
//unset($after[1]);
$oDoc->aContents = $after;
echo '<h1>end: css output</h1>';
echo '#### Output (`render()`)' . "\n";
echo count($after) . "<br/>";
print $oDoc->render();
echo "\n";

