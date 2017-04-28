<?php

if(isset($_POST['contact']))
{
    include_once("class/Constant.Class.php");
    include_once("class/Query.Class.php");

    //initialize Constant Object
    $constant = new Constant();
    $base = $constant->getDatabase();
    $query = new Query($base);

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $raison = $_POST['raison'];
    $description = $_POST['description'];

    $query->addNewContact($nom,$prenom,$email,$raison,$description);

     header("location:https://pinohh.herokuapp.com/contact.php?task=ok");

}
else
{
  header("location:https://pinohh.herokuapp.com/contact.php?task=error");
}
