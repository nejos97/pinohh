<?php

if(isset($_POST['survey']))
{
  if($_POST['key']=="pinohhbot1234567890")
  {
    include_once("function/function.php");
    include_once("class/Constant.Class.php");
    include_once("class/Query.Class.php");

    //initialize Constant Object
    $constant = new Constant();
    $base = $constant->getDatabase();
    $query = new Query($base);

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $survey = $_POST['sondage'];
    $image = $_POST['image'];

    $query->addNewSurvey($nom,$prenom,$email,$survey,$image);

    //global Var
    $message  = "Undefined";
    $facebook_token = $constant->getFacebookToken();

     $users = $query->getAllUsers();
     foreach ($users as $user)
     {
       $sender = $user['idFacebook'];
       $da = getUserInfos();
       if(!empty($da))
       {
         $name = $da['last_name'] ;
       }
       else
       {
         $name = "Amigo ð " ;
       }
       sendTextMessage("$name Just inform you that 🛎🛎 a new poll has just been published, you can vote at any time. ");
     }

     header("location:https://pinohh.herokuapp.com/survey.php?task=ok");

  }
  else
  {
    header("location:https://pinohh.herokuapp.com/survey.php?task=error");
  }
}

else
{
  header("location:https://pinohh.herokuapp.com/survey.php?task=error");
}
