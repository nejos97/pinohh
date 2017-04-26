<?php
include_once("class/Constant.Class.php");
include_once("class/Query.Class.php");

//initialize Constant Object
$constant = new Constant();
$base = $constant->getDatabase();
$query = new Query($base);

$data = $query->getLastSurvey();
$tableau = array("id"=>$data['id'], "author"=>$data['nom'],"text"=>$data['text'],"image"=>$data['image'],"date_publication"=>$data['date_publication']);
print_r(json_encode($tableau));

?>
