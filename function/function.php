<?php

function sendTextMessage($messageReply)
{
    global $sender ;
    global $message ;
    global $facebook_token ;

    $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$facebook_token;
    //Initiate cURL.
    $ch = curl_init($url);
    //The JSON data.
    $jsonData = '{
        "recipient":{
            "id":"'.$sender.'"
        },
        "message":{
            "text":"'.$messageReply.'"
        }
    }';

    $jsonDataEncoded = $jsonData;
    //Tell cURL that we want to send a POST request.
    curl_setopt($ch, CURLOPT_POST, 1);
    //Attach our encoded JSON string to the POST fields.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    //Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    //Execute the request
    if(!empty($message))
    {
        $result = curl_exec($ch);
    }
}

function sendImageMessage($imgUrl)
{
    global $sender ;
    global $facebook_token ;
    global $message ;

    $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$facebook_token;
    //Initiate cURL.
    $ch = curl_init($url);
    //The JSON data.
    $jsonData = '{
                  "recipient":{
                    "id":"'.$sender.'"
                  },
                  "message":{
                    "attachment":{
                      "type":"image",
                      "payload":{
                        "url":"'.$imgUrl.'"
                      }
                    }
                  }
                }';

    $jsonDataEncoded = $jsonData;
    //Tell cURL that we want to send a POST request.
    curl_setopt($ch, CURLOPT_POST, 1);
    //Attach our encoded JSON string to the POST fields.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    //Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    //Execute the request
    if(!empty($message))
    {
        $result = curl_exec($ch);
    }

}
function allService()
{

    global $sender ;
    global $message ;
    global $facebook_token ;


    $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$facebook_token;
    //Initiate cURL.
    $ch = curl_init($url);
    //The JSON data.
    $jsonData = '{
                  "recipient":{
                    "id":"'.$sender.'"
                  },
                  "message":{
                    "text":"Here are our main services. Please choose one.",
                    "quick_replies":[
                      {
                        "content_type":"text",
                        "title":"Road Traffic Layer",
                        "payload":"ROAD_TRAFFIC_LAYER"
                      },
                      {
                        "content_type":"text",
                        "title":"Vote of Survey",
                        "payload":"VOTE_OF_SURVEY"
                      },
                      {
                        "content_type":"text",
                        "title":"Birthday Programming",
                        "payload":"BIRTHDAY_PROGRAMMING"
                      },
                    ]
                  }
                }';

    $jsonDataEncoded = $jsonData;
    //Tell cURL that we want to send a POST request.
    curl_setopt($ch, CURLOPT_POST, 1);
    //Attach our encoded JSON string to the POST fields.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    //Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    //Execute the request
    if(!empty($message))
    {
        $result = curl_exec($ch);
    }

}
function sharePosition()
{

    global $sender ;
    global $message ;
    global $facebook_token ;

    $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$facebook_token;
    //Initiate cURL.
    $ch = curl_init($url);
    //The JSON data.
    $jsonData = '{
                  "recipient":{
                    "id":"'.$sender.'"
                  },
                  "message":{
                    "text":"Share your position to access this service",
                    "quick_replies":[
                      {
                        "content_type":"location",
                      },
                    ]
                  }
                }';

    $jsonDataEncoded = $jsonData;
    //Tell cURL that we want to send a POST request.
    curl_setopt($ch, CURLOPT_POST, 1);
    //Attach our encoded JSON string to the POST fields.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
    //Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    //Execute the request
    if(!empty($message))
    {
        $result = curl_exec($ch);
    }

}

function getUserInfos()
{
    global $facebook_token ;
    global $sender ;
    $url = "https://graph.facebook.com/v2.6/$sender?fields=first_name,last_name,profile_pic,locale,timezone,gender&access_token=$facebook_token" ;
    $data = file_get_contents($url);
    return json_decode($data,true) ;
}

function isNew($id)
{
    file_exists("fichier/user/".$id.".txt")? true: false;
}
function selectRandomImage()
{
    $tableau = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
    $imageKey = array_rand($tableau);
    $imageId = $tableau[$imageKey];
    $imagePath = "pattern/background/".$imagesId.".png" ;
    return $imagePath;
}
function selectRandomMessage($name,$sender)
{
    $tableau  = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
    $messageKey = array_rand($tableau);
    $messageId = $tableau[$messageKey];
    $messagePath = "pattern/message/".$messageId.".txt" ;
    $message = file_get_contents($messagePath);
    return $message ;
}

function basicResponse($message,$name)
{
    $reply  = " ";

    if(preg_match("#(hi|hello|good morning|morning)#i", $message))
    {
        $reply = "Hello ".$name." I'm happy to meet you ! ";
    }
    else if(preg_match("#(How doing |what's up| how are you)#i", $message))
    {
        $reply = "I'm fine. Thanks !";
    }
    else if(preg_match("#(name|what's your name|How do we call you)#i",$message))
    {
        $reply = "My name is Pinohh ! The name was choosed by my devs and I'm proud of it !";
    }
    else if(preg_match("#(what are you doing|what you do| what do you do)#i", $message))
    {
        $reply = "Now I'm tchating with you ".$name." 😀 ";
    }
    else if(preg_match("#(info|information|about you|about pinohh|more)#i", $message))
    {
        $reply = "Cool 😎 . visit us here https://pinohh.herokuapp.com";
    }
    else if(preg_match("#^(cool|ok|yes)#i", $message))
    {
        $reply = "😉😉😉 👍🏾 ";
    }
    else if(preg_match("#^(bye|goodbye|see you soon|after)#i", $message))
    {
        $reply = getGiphy("goodbye");
    }
    else if(preg_match("#^(thank|thanks|thx|nice|cheer(s)?)#i", $message))
    {
        $reply = "😊😊";
    }
    else if(preg_match("#^(help|need help])#i",$message))
    {
        $reply = "Hi there. So I can tell you the birthday programing , the survey vote and more.Please go to the persistent menu.";
    }
    else if(preg_match("#(where are you |where do you come from | where are you going)#i", $message))
    {
        $reply = "I'm from Cameroon 🇨🇲. \n I was made with :heart: by Cameroonians devs ! \n Get more information on the site : http://pinohh.herokuapp.com";
    }
    else if(preg_match("#^(time please|what is the time|what is the date])#i",$message))
    {
        $reply = "I'm not a clock's or colendar please watch in your device";
    }

    return $reply ;
}

function getGiphy($search)
{
    $url = "http://api.giphy.com/v1/gifs/random?api_key=dc6zaTOxFJmzC&tag=$search";
    $input = json_decode(file_get_contents($url) , true);
    $imgurl = $input['data']['image_url'] ;
    return $imgurl ;
}
function messageTraiter()
{
   $fichier  = fopen("tempon/messageTraiter.txt","r+");
   $msg = fgets($fichier);
   $msg += 1;
   fseek($fichier,0);
   fputs($fichier,$msg);
   fclose($fichier);
}

/*
Ici se trouver l'ensemble des fucntion ecrit pour definir les different etape d'execution
d'une tache par le User.
*/

function setUserInformation()
{
    global $sender ;
    global $message ;
    global $chemin ;
    global $query ;
    if(filter_var(strtolower($message), FILTER_VALIDATE_EMAIL) || preg_match("#^(none)#i", $message))
    {
        sendTextMessage("Thank you for your  answer to my question.Your option is correctly set");
        allService();
        $query->addUser($sender,strtolower($message));
        file_put_contents($chemin,"");
    }
    else
    {
        sendTextMessage("Please provide a valid email or type \"none\" if you don't get one 😕 .");
    }
}

function getUserPosition()
{
    global $sender ;
    global $input ;

    if(isset($input['entry'][0]['messaging'][0]['message']['attachments'][0]['payload']['coordinates']))
    {
        $lat = $input['entry'][0]['messaging'][0]['message']['attachments'][0]['payload']['coordinates']['lat'];
        $long = $input['entry'][0]['messaging'][0]['message']['attachments'][0]['payload']['coordinates']['long'];
        $url = "http://pinohh.000webhostapp.com/traffic.php?lat=$lat&long=$long";
        $apiKey = "ab98a89f9bd91e26d14d2a5095fba4d8b10aaf2a7b8b";
        $width = 1024 ;
        $fetchUrl = "https://api.thumbnail.ws/api/".$apiKey."/thumbnail/get?url=".urlencode($url)."&width=".$width ;
        sendTextMessage("Here is the road traffic of your position. Click on the image to enlarge.");
        sendImageMessage($fetchUrl);
        file_put_contents("etape/".$sender.".txt","");
    }
    else
    {
        sendTextMessage("Your position is incorrect  😔. Please enter a correct position");
        sharePosition();

    }

}

function surveyResponse()
{

  global $sender ;
  global $facebook_token ;
  global $message ;

  $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$facebook_token;
  //Initiate cURL.
  $ch = curl_init($url);
  //The JSON data.
  $jsonData = '{
                "recipient":{
                  "id":"'.$sender.'"
                },
                "message":{
                  "text":"Make your choice to vote this survey.",
                  "quick_replies":[
                    {
                      "content_type":"text",
                      "title":"For",
                      "payload":"FOR"
                    },
                    {
                      "content_type":"text",
                      "title":"Against",
                      "payload":"AGAINST"
                    },
                    {
                      "content_type":"text",
                      "title":"Neutral",
                      "payload":"NEUTRAL"
                    },
                  ]
                }
              }';

  $jsonDataEncoded = $jsonData;
  //Tell cURL that we want to send a POST request.
  curl_setopt($ch, CURLOPT_POST, 1);
  //Attach our encoded JSON string to the POST fields.
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
  //Set the content type to application/json
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  //Execute the request
  if(!empty($message))
  {
      $result = curl_exec($ch);
  }
}

function showSurvey()
{
    global $sender ;
    global $message ;
    global $facebook_token ;
    global $query ;

    $data = $query->getLastSurvey();
    sendTextMessage("🎯 The survey of the week is : ".$data['text']."🎯");
    sendImageMessage($data['image']);
    surveyResponse();
    //envoi de la reponse.

}

function testVote()
{
    global $message ;
    global $sender;
    global $name ;
    global $query ;

    if(preg_match("#^(for|againts|neutral)#i", $message))
    {
        file_put_contents("etape/".$sender.".txt","");
        $data = $query->getLastSurvey();
        if($query->haveVote($sender,$data['id'])==false)
        {
          $query->addVote($sender,$data['id'],$message);
          sendTextMessage("Your vote has been successfully saved. Thank you 🤝 $name ");
        }
        else
        {
          //You can view results here .... link for survey results
          sendTextMessage("thanks but, 😶 you have already voted for this survey.  Wait for the next poll to vote again.");
        }

    }
    else
    {
        sendTextMessage("Please vote by using either \"For\" , \"Against\" or \" Neutral\" .");
        surveyResponse();
    }



}

function testUsername()
{
    global $message ;
    global $sender ;
    if(strlen($message)>=2)
    {
      $path = "fichier/birthday/".$sender.".txt" ;
      fopen($path,"a+");
      file_put_contents($path,$message." ^ ");
      file_put_contents("etape/".$sender.".txt","3-2");
      sendTextMessage("Coool😉");
      sendTextMessage("Please give me the email address of ".$message);

    }
    else
    {
      sendTextMessage("Please enter a correct person name.");
    }
}


function askCustomizeMessage()
{

  global $sender ;
  global $facebook_token ;
  global $message ;

  $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$facebook_token;
  //Initiate cURL.
  $ch = curl_init($url);
  //The JSON data.
  $jsonData = '{
                "recipient":{
                  "id":"'.$sender.'"
                },
                "message":{
                  "text":"Do you want to enter the text to send him or let me choose a good text customize to please your friend ?",
                  "quick_replies":[
                    {
                      "content_type":"text",
                      "title":"Let Pinohh choose",
                      "payload":"LET_PINOHH_CHOOSE"
                    },
                    {
                      "content_type":"text",
                      "title":"I enter my text",
                      "payload":"I_ENTER_MY_TEXT"
                    },
                  ]
                }
              }';

  $jsonDataEncoded = $jsonData;
  //Tell cURL that we want to send a POST request.
  curl_setopt($ch, CURLOPT_POST, 1);
  //Attach our encoded JSON string to the POST fields.
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
  //Set the content type to application/json
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  //Execute the request
  if(!empty($message))
  {
      $result = curl_exec($ch);
  }

}


function testEmailAddress()
{
  global $sender ;
  global $message ;
  if(filter_var(strtolower($message), FILTER_VALIDATE_EMAIL))
  {
    $path = "fichier/birthday/".$sender.".txt";
    $tmp = file_get_contents($path);
    $tmp = $tmp." ".$message." ^ " ;
    file_put_contents($path,$tmp);
    file_put_contents("etape/".$sender.".txt","3-3");
    sendTextMessage("That is correct 👌");
    sendTextMessage("Enter your friend's birth year. Please use this format : YYYY/MM/DD 📆");
    sendTextMessage("You can also use the expression like: today, tomorrow to express the date.");
  }
  else
  {
    sendTextMessage("Enter a good format of mail address");
  }
}

function testBirthdayYear()
{
  global $sender ;
  global $message ;

  if(preg_match("[^\d{4}/\d{1,2}/\d{1,2}$]", strtolower($message)) || preg_match('[^today]', strtolower($message)) || preg_match('[^tomorrow]', strtolower($message)))
  {
    if(preg_match('[^today]', strtolower($message)))
    {
      $date = date('Y/m/d');
    }
    else if(preg_match('[^tomorrow]', strtolower($message)))
    {
      $date = $date = date('Y/m/d', strtotime('+1 day'));
    }
    else
    {
      $date  = $message ;
    }

    $path = "fichier/birthday/".$sender.".txt";
    $tmp = file_get_contents($path);
    $tmp = $tmp." ".$date." ^ ";
    file_put_contents($path,$tmp);
    file_put_contents("etape/".$sender.".txt","3-4");
    sendTextMessage("Thanks ✨");
    askCustomizeMessage();
  }
  else
  {
    sendTextMessage("Your message is incorrect from what I expect.");
  }
}

function testResponseText()
{
  global $message ;
  global $sender ;
  global $name;
  if(preg_match('[^let pinohh choose]', strtolower($message)))
  {
    sendTextMessage("Youuuupi !!! 🎉🎊🎊🎉🎊🎂🎂🎂. This anniversary has been very well programmed. I take care of everything from this moment.");
    $path = "fichier/birthday/".$sender.".txt";
    $tmp = file_get_contents($path);
    $tmp = $tmp." null";
    file_put_contents($path,$tmp." ^ ".$name);
    file_put_contents("etape/".$sender.".txt","");
  }
  else if(preg_match('[^I enter my text]', strtolower($message)))
  {
    file_put_contents("etape/".$sender.".txt","3-5");
    sendTextMessage("OK please enter a text for your friend");
  }
  else
  {
    sendTextMessage("Please make the right choice");
    askCustomizeMessage();
  }
}

function receiveText()
{
  global $sender ;
  global $message ;
  global $name;

  if(strlen($message)>=3 AND preg_match('[birthday|happy|hbd]', strtolower($message)))
  {
    sendTextMessage("Youuuupi !!! 🎉🎊🎊🎉🎊🎂🎂🎂. This anniversary has been very well programmed. I take care of everything from this moment.");
    $path = "fichier/birthday/".$sender.".txt";
    $tmp = file_get_contents($path);
    $tmp = $tmp." ".$message;
    file_put_contents($path,$tmp." ^ ".$name);
    file_put_contents("etape/".$sender.".txt","");
  }
  else
  {
    sendTextMessage("Please enter a sentence that resembled a birthday sentence.");
  }
}
