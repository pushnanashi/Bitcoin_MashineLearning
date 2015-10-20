<?php

#This Program PHP Resident Program
#And Need Mysql PHP System_Daemon

#OPEN DATA http://blockchain.info/



require("Mysql PassWord Data");
require_once 'System/Daemon.php';

$app_name = "bitcoin";

$options = array(
		 'appName' => 'deamon_name', 
		 'appDir' => dirname(__FILE__) 
		 );

System_Daemon::setOptions($options);
 
System_Daemon::start();


$mysqli = new mysqli($db['host'], $db['user'], $db['pass'],
		     $db['bitdb']);

$mysqli->set_charset("utf-8");
if ($mysqli->connect_error) {
  echo "DB error";
  die('Connect Error (' . $mysqli->connect_errno . ') '
      . $mysqli->connect_error);
}

while(!System_Daemon::isDying()){
  
  System_Daemon::log(System_Daemon::LOG_INFO, date('Y/m/d H:i:s'));

  $blockfile = file_get_contents($blockchain);
  $block = json_decode($blockfile,true);

$USDb =  floatval( $block["USD"]["buy"]);
$USDs =  floatval( $block["USD"]["sell"]);

$ISKb =  floatval( $block["ISK"]["buy"]);
$ISKs =  floatval( $block["ISK"]["sell"]);

$HKDb =  floatval( $block["HKD"]["buy"]);
$HKDs =  floatval( $block["HKD"]["sell"]);

$TWDb =  floatval( $block["TWD"]["buy"]);
$TWDs =  floatval( $block["TWD"]["sell"]);

$CHFb =  floatval( $block["CHF"]["buy"]);
$CHFs =  floatval( $block["CHF"]["sell"]);

$EURb =  floatval( $block["EUR"]["buy"]);
$EURs =  floatval( $block["EUR"]["sell"]);

$DKKb =  floatval( $block["DKK"]["buy"]);
$DKKs =  floatval( $block["DKK"]["sell"]);

$CLPb =  floatval( $block["CLP"]["buy"]);
$CLPs =  floatval( $block["CLP"]["sell"]);

$CADb =  floatval( $block["CAD"]["buy"]);
$CADs =  floatval( $block["CAD"]["sell"]);

$CNYb =  floatval( $block["CNY"]["buy"]);
$CNYs =  floatval( $block["CNY"]["sell"]);

$THBb =  floatval( $block["THB"]["buy"]);
$THBs =  floatval( $block["THB"]["sell"]);

$AUDb =  floatval( $block["AUD"]["buy"]);
$AUDs =  floatval( $block["AUD"]["sell"]);

$SGDb =  floatval( $block["SGD"]["buy"]);
$SGDs =  floatval( $block["SGD"]["sell"]);

$KRWb =  floatval( $block["KRW"]["buy"]);
$KRWs =  floatval( $block["KRW"]["sell"]);

$JPYb =  floatval( $block["JPY"]["buy"]);
$JPYs =  floatval( $block["JPY"]["sell"]);

$PLNb =  floatval( $block["PLN"]["buy"]);
$PLNs =  floatval( $block["PLN"]["sell"]);

$GBPb =  floatval( $block["GBP"]["buy"]);
$GBPs =  floatval( $block["GBP"]["sell"]);

$SEKb =  floatval( $block["SEK"]["buy"]);
$SEKs =  floatval( $block["SEK"]["sell"]);

$NZDb =  floatval( $block["NZD"]["buy"]);
$NZDs =  floatval( $block["NZD"]["sell"]);

$BRLb =  floatval( $block["BRL"]["buy"]);
$BRLs =  floatval( $block["BRL"]["sell"]);

$RUBb =  floatval( $block["RUB"]["buy"]);
$RUBs =  floatval( $block["RUB"]["sell"]);


  $time =   time();
  $result = $mysqli->query("SELECT MAX(id) as max  FROM worldbitcoin");
  $maxnum = 0;


  if($result){
                                                   
    while($row = $result->fetch_object()){
                                                    
      $num = $row->max;
      $maxnum = $num+1;
    }
  }else{
    $maxnum=1;
  }


  $stmt = $mysqli->prepare("INSERT INTO worldbitcoin(id,  USDs,           

  USDb,           

  ISKs,           

  ISKb,           

  HKDs,           

  HKDb,           

  TWDs,           

  TWDb,           

  CHFs,           

  CHFb,           

  EURs,           

  EURb,           

  DKKs,           

  DKKb,           

  CLPs,           

  CLPb,           

  CADs,           

  CADb,           

  CNYs,           

  CNYb,           

  THBs,           

  THBb,           

  AUDs,           

  AUDb,           

  SGDs,           

  SGDb,           

  KRWs,           

  KRWb,           

  JPYs,           

  JPYb,           

  PLNs,           

  PLNb,           

  GBPs,           

  GBPb,           

  SEKs,           

  SEKb,           

  NZDs,           

  NZDb,           

  BRLs,           

  BRLb,           

  RUBs,           

  RUBb,           

  date       )

values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");


$stmt->bind_param('iddddddddddddddddddddddddddddddddddddddddddi',
$maxnum ,$USDb  
,$USDs  ,$ISKb
 ,$ISKs  ,$HKDb
 ,$HKDs  ,$TWDb
 ,$TWDs  ,$CHFb 
 ,$CHFs ,$EURb
 ,$EURs  ,$DKKb
  ,$DKKs ,$CLPb
 ,$CLPs  ,$CADb 
 ,$CADs ,$CNYb
 ,$CNYs ,$THBb
 ,$THBs ,$AUDb
 ,$AUDs ,$SGDb 
,$SGDs ,$KRWb 
,$KRWs ,$JPYb ,
$JPYs ,$PLNb ,
$PLNs ,$GBPb ,
$GBPs ,$SEKb ,
$SEKs ,$NZDb ,
$NZDs ,$BRLb 
,$BRLs ,$RUBb,$RUBs,$time
);
 
$stmt->execute();
 //Get Blockchain Data per 15 minitus.Limit This. 
  System_Daemon::iterate(900); 

  }
System_Daemon::stop();

?>