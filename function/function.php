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
                        "title":"Birthday Programing",
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
    if(file_exists("fichier/user/".$id.".txt"))
    {
        return true ;
    }
    else
    {
        return false ;
    }
}
function selectRandomImage()
{
    $tableau = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
    $imageKey = array_rand($tableau);
    $imageId = $tableau[$imageKey];
    $imagePath = "pattern/background/".$imagesId.".png" ;
    return $imagePath;
}
function selectRandomMessage()
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

    if(preg_match('[hi|hello|good morning|morning]', strtolower($message)))
    {
        $reply = "Hello ".$name." i'm happy to meet you ! ";
    }
    else if(preg_match('[how are you|what was your day]', strtolower($message)))
    {
        $reply = "I'm fine. Thanks !";
    }
    else if(preg_match('[name|what is your name|names]', strtolower($message)))
    {
        $reply = "My name is Pinohh ! It is my master who chose this name and i like it 😎.";
    }
    else if(preg_match('[what do you do|what you do|now]', strtolower($message)))
    {
        $reply = "Now i tchat with you ".$name." 😀 ";
    }
    else if(preg_match('[what is the time|time]', strtolower($message)))
    {
        $reply = "I'm not a clock 😜 please see in your device.";
    }
    else if(preg_match('[info|information|about you|about pinohh]', strtolower($message)))
    {
        $reply = "Cool 😎 . visit us here https://pinohh.herokuapp.com";
    }
    else if(preg_match('[^cool|^ok|^yes]', strtolower($message)))
    {
        $reply = "😉😉😉 👍🏾 ";
    }
    else if(preg_match('[^bye|goodbye|see you soon|after]', strtolower($message)))
    {
        $reply = getGiphy("goodbye");
    }
    else if(preg_match('[^thank|^thanks|^thx|nice]', strtolower($message)))
    {
        $reply = "😊😊";
    }
    else if(preg_match('[^help|^need help]', strtolower($message)))
    {
        $reply = "Hi there. So I can tell you the birthday programing , the survey vote and more.Please go to the persistent menu.";
    }
    else if(preg_match('[^old|^what ol are you|old are you]', strtolower($message)))
    {
        $reply = "I don't know exactlly 🤖 but i born on 2017/03/15 at 8h18 PM";
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
    if(filter_var(strtolower($message), FILTER_VALIDATE_EMAIL) || preg_match('[^null]', strtolower($message)))
    {
        sendTextMessage("Thank you for your correct answer to my question.Your option is correctly set");
        allService();
        $query->addUser($sender,strtolower($message));
        file_put_contents($chemin,"");
    }
    else
    {
        sendTextMessage("Please provide a valid information 😕 .");
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
        sendTextMessage("Your position is incorrecte 😔. Please enter a correct position");
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
                  "text":"Made your choice to vote this survey.",
                  "quick_replies":[
                    {
                      "content_type":"text",
                      "title":"For",
                      "payload":"FOR"
                    },
                    {
                      "content_type":"text",
                      "title":"Againts",
                      "payload":"AGAINTS"
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

    if(preg_match('[^for|^againts|^neutral]', strtolower($message)))
    {
        file_put_contents("etape/".$sender.".txt","");
        $data = $query->getLastSurvey();
        if($query->haveVote($sender,$data['id'])==false)
        {
          $query->addVote($sender,$data['id'],$message);
          sendTextMessage("Thanks you for your vote 🤝 $name ");
        }
        else
        {
          sendTextMessage("thanks but, 😶 you have already voted for this survey. Wait for the next poll to vote again.");
        }

    }
    else
    {
        sendTextMessage("Please vote normaly");
        surveyResponse();
    }



}
