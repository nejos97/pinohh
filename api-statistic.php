<?php
include_once("class/Constant.Class.php");
include_once("class/Query.Class.php");

//initialize Constant Object
$constant = new Constant();
$base = $constant->getDatabase();
$query = new Query($base);


$nbrMessage = file_get_contents("tempon/messageTraiter.txt");
$nbrUser = $query->getNumberUser();
$nbrBirthday = $query->getNumberBirthday();
$nbrVoteSurvey = $query->getNumberVoteSurvey();
$tableau = array("nbrMessage"=>$nbrMessage,"nbrUser"=>$nbrUser,"nbrBirthday"=>$nbrBirthday,"nbrVoteSurvey"=>$nbrVoteSurvey);
print_r(json_encode($tableau));

?>
