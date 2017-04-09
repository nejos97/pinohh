<?php
/*
/ NENBA JONATHAN & SONKENG MALDINI
/ github.com/nejos97
/ github.com/sdmg15
/ 20:18 2017/03/15
/ Facebook Messenger Bot
/ Pinohh Bot Source Code
/ pinohh.herokuapp.com
*/

//include class and function for our script
include_once("function/function.php");
include_once("class/Constant.Class.php");
include_once("class/UserProfile.Class.php");
include_once("class/Query.Class.php");

//initialize Constant Object
$constant = new Constant();
$facebook_token = $constant->getFacebookToken();
$verify_token = $constant->getVerifyToken();
$base = $constant->getDatabase();
$query = new Query($base);


//get data flow
file_put_contents("tempon/lastMessage.txt",file_get_contents('php://input'));
$input = json_decode(file_get_contents('php://input'), true);

if(isset($input['entry'][0]['messaging'][0]['postback']))
{

    //get sender ID
    $sender = $input['entry'][0]['messaging'][0]['sender']['id'];

    //get sender Message
    $message = $input['entry'][0]['messaging'][0]['postback']['payload'];
}
else if (isset($input['entry'][0]['messaging'][0]['message']['text']))
{
    //get sender ID
    $sender = $input['entry'][0]['messaging'][0]['sender']['id'];

    //get sender Message
    $message = $input['entry'][0]['messaging'][0]['message']['text'];

}
else
{
    //get sender ID
    $sender = $input['entry'][0]['messaging'][0]['sender']['id'];

     //get sender Message
    $message = "Undefined";

}

if(preg_match('[^stop proccessing]', strtolower($message)))
{
  if(strlen(file_get_contents("etape/".$sender.".txt"))>0)
   {
     sendTextMessage("Current processing was stopped. You can start over at any time");
     file_put_contents("etape/".$sender.".txt","");
   }
   else
   {
     sendTextMessage("No one process is currently running.");
   }
   allService();
   exit();
}

//message to reply
$messageReply = " ";

$data = getUserInfos();
if(!empty($data))
{
  $name = $data['last_name']." ".$data['first_name'];
}
else
{
  $name = "Amigo 🍕 " ;
}
//test si un payload existe.


//test if the user is new
if(isNew($sender)==false)
{
    //creating a file
    fopen("fichier/user/".$sender.".txt","a+");
    sendTextMessage("Hello $name 👋🏾 ! ");
    sendTextMessage("my name is pinohh, i'm very happy to meet you.i will help you to discover me and what i can do.");
    sendTextMessage("But before we start, I will ask you some information in order to configure your option.");
    sendTextMessage("Please enter your email. If you don't have one just anwser : null .");
    $path = "etape/".$sender.".txt";
    fopen($path,"a+");
    file_put_contents($path,"0-0");


}
else
{
    $chemin = "etape/".$sender.".txt" ;

    $etape = file_get_contents($chemin);

    if(strlen($etape)>0)
    {
        if(strcasecmp($etape,"0-0")==0)
        {
            setUserInformation();
        }
        else if(strcasecmp($etape,"1-1")==0)
        {
            getUserPosition();
        }
        else if(strcasecmp($etape,"2-1")==0)
        {
            testVote();
        }


    }
    else if(strlen(basicResponse($message,$name))>1)
    {
        $messageReply = basicResponse($message,$name);
    }
    else
    {
        if(preg_match('[^main service|^service|^services|^main services]', strtolower($message)))
        {
            allService();
        }
        else
        {
            if(preg_match('[^road traffic layer]', strtolower($message)))
            {
                file_put_contents("etape/".$sender.".txt","1-1");
                sendTextMessage("With this service, you can get traffic from your location area, which will allow you to choose the path to use and improve navigation.");
                sharePosition();
            }
            else if(preg_match('[^vote of survey]', strtolower($message)))
            {
                file_put_contents("etape/".$sender.".txt","2-1");
                sendTextMessage("You can vote just the last survey. Every week, a new survey is available and you can vote. When a new survey is publish you receive automatically one notification.");
                showSurvey();
            }
            else if(preg_match('[^birthday programing]', strtolower($message)))
            {
                $messageReply = "This service cooming soon : birthday programing" ;
            }
            else
            {
                $messageReply = "I’m sorry; I’m not sure I understand. Try typing “help” or “service” ";
            }
        }
    }
}

if(preg_match('[.gif]', strtolower($messageReply)))
{
    sendImageMessage($messageReply);
}
else
{
    sendTextMessage($messageReply);
}

messageTraiter();
