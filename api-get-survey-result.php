<?php
include_once("class/Constant.Class.php");
include_once("class/Query.Class.php");

//initialize Constant Object
$constant = new Constant();
$base = $constant->getDatabase();
$query = new Query($base);

$data = $query->getSurveyResult();
print_r(json_encode($data));

?>
