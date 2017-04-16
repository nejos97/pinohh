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

#Modif 1 strtolower ....
if(preg_match("#^(stop processing)#i", $message ))
{
  if(strlen(file_get_contents("etape/".$sender.".txt"))>0)
   {
     sendTextMessage("Current process was stopped. You can start over at any time");
     file_put_contents("etape/".$sender.".txt","");
   }
   else
   {
     sendTextMessage("No process is currently running.");
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
    #modif 2 typos ....
    fopen("fichier/user/".$sender.".txt","a+");
    sendTextMessage("Hello $name 👋🏾 ! ");
    sendTextMessage("My name is pinohh, I'm very happy to meet you. I will help you to discover me and what I can do.");
    sendTextMessage("But before we start, I will ask you some information in order to configure your options.");
    sendTextMessage("Please enter your email. If you don't have one just anwser : none."); //null to be replaced by none
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
        else if(strcasecmp($etape,"3-1")==0)
        {
            testUsername();
        }
        else if(strcasecmp($etape,"3-2")==0)
        {
            testEmailAddress();
        }
        else if(strcasecmp($etape,"3-3")==0)
        {
            testBirthdayYear();
        }
        else if(strcasecmp($etape,"3-4")==0)
        {
            testResponseText();
        }
        else if(strcasecmp($etape,"3-5")==0)
        {
            receiveText();
        }


    }
    else if(strlen(basicResponse($message,$name))>1)
    {
        $messageReply = basicResponse($message,$name);
    }
    else
    {
        #Modif 3 regex ...
        if(preg_match("#^(main service|service|services|main services)#i", $message))
        {
            allService(); // displayAllServices();
        }
        else
        {
          #Modif 4 see Modif 3 And typos ...
            if(preg_match("#^(road traffic layer)#i", $message))
            {
                file_put_contents("etape/".$sender.".txt","1-1");
                sendTextMessage("This service helps you to get road traffic of your area, this will help you to choose the less busiest path and improve your navigation.");

                sharePosition();

            }
            else if(preg_match("#^(take the survey)#i", $message))
            {
                file_put_contents("etape/".$sender.".txt","2-1");
                #resultats du survey ?...
                sendTextMessage("You can just vote for the last survey. Survey are created every weeks. Soon as a new survey is available I'll send you a notification.");
                showSurvey(); //displaySurvey()
            }
            else if(preg_match("#^(birthday programming)#i",$message))
            {
                sendTextMessage("I will help you from this moment to schedule the automatic sending of birthday greeting cards randomed or customized to your friends 🎉🎊. You will just have to give me some information and I would undertake to make their anniversaries unforgettable !.");
                sendTextMessage("To begin, enter the name of your friend(s) whose birthday you want to schedule.");
                file_put_contents("etape/".$sender.".txt","3-1");
                //what if i enter "jacob joanna"
            }
            else
            {
                $messageReply = "I’m sorry :( I’m not sure I understand. Try typing “help” or “service” ";
            }
        }
    }
}

if(preg_match("#^(.gif)#i",$messageReply))
{
    sendImageMessage($messageReply);
}
else
{
    sendTextMessage($messageReply);
}

messageTraiter();
