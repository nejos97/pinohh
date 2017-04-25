<?php
include_once("class/Constant.Class.php");
include_once("class/Query.Class.php");

//initialize Constant Object
$constant = new Constant();
$base = $constant->getDatabase();
$query = new Query($base);

$data = $query->getLastSurvey();
$tableau = array("id"=>$data['id'],""=>$data[''],"nbrBirthday"=>$nbrBirthday,"nbrVoteSurvey"=>$nbrVoteSurvey);
print_r(json_decode($tableau));

?>
