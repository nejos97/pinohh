<?php
include_once("function/function.php");
include_once("class/Query.Class.php");
include_once("class/Constant.Class.php");

$constant = new Constant();
$base = $constant->getDatabase();
$query = new Query($base);
//global Var
$message  = "Undefined";
$facebook_token = $constant->getFacebookToken();;


$donnees = $query->getAllBirthday();

foreach($donnees as $donnee)
{
  $oday = date("Y/m/d");
  if($donnee['year']==$oday)
  {
    $query->executeBirthday($donnee["id"]) ;
    $friendName = $donnee["friendName"];
    $year = $donnee["year"];
    $mail = $donnee["mail"];
    $image = $donnee["image"];
    $mess = $donnee["message"];
    $senderName = $donnee["senderName"];

    //debut de la construction du Mail.

    if (!preg_match("#(hotmail|live|msn)#", $mail))
    {
      $passage_ligne = "\r\n";
    }
    else
    {
      $passage_ligne = "\n";
    }

      $msg_html = getMailPattern($friendName,$mess,$image);

      //=====Création de la boundary
      $boundary = "-----=".md5(rand());

      //Definition du sujet
      $sujet = "Happy Birthday $friendName";

      $msg.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
      //=====Création du header de l'e-mail.
      $header = "From: \"$senderName\"<noreply@pinohh.com>".$passage_ligne;
      $header.= "Reply-to: \"Noreply\" <noreply@pinohh.com>".$passage_ligne;
      $header.= "MIME-Version: 1.0".$passage_ligne;
      $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

      //=====Création du message.
      $msg = $passage_ligne."--".$boundary.$passage_ligne;
      //=====Création du message.
      $msg.= $passage_ligne."--".$boundary.$passage_ligne;
      //=====Ajout du message au format HTML
      $msg.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
      $msg.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
      $msg.= $passage_ligne.$msg_html.$passage_ligne;
      //==========
      $msg.= $passage_ligne."--".$boundary."--".$passage_ligne;
      $msg.= $passage_ligne."--".$boundary."--".$passage_ligne;
      file_put_contents("green.txt","test : ".$msg_html);
      mail($mail,$sujet,$msg,$header);


      $sender = $donnee['idFacebook'];
      sendTextMessage("$senderName the birthday conerning $friendName that you programmed was sent.");
  }
}
