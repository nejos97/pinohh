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

function persistentMenu()
{
  global $message ;
  global $facebook_token ;

  $url = 'https://graph.facebook.com/v2.6/me/messenger_profile?access_token='.$facebook_token;
  //Initiate cURL.
  $ch = curl_init($url);
  //The JSON data.
  $jsonData ='{
                "persistent_menu":[
                  {
                    "locale":"default",
                    "composer_input_disabled":false,
                    "call_to_actions":[
                      {
                        "title":"Services",
                        "type":"nested",
                        "call_to_actions":[
                          {
                            "title":"🚦 Road Traffic Layer",
                            "type":"postback",
                            "payload":"ROAD_TRAFFIC_LAYER"
                          },
                          {
                            "title":"🎯 Vote of Survey",
                            "type":"postback",
                            "payload":"VOTE_OF_SURVEY"
                          },
                          {
                            "title":"🎂 Birthday Programming",
                            "type":"postback",
                            "payload":"BIRTHDAY_PROGRAMMING"
                          },
                          {
                            "title":"🛑 Stop Processing",
                            "type":"postback",
                            "payload":"STOP_PROCESSING"
                          }
                        ]
                      },
                      {
                        "title":"Help",
                        "type":"nested",
                        "call_to_actions":[
                          {
                            "title":"🆘 About Road Traffic Layer",
                            "type":"postback",
                            "payload":"HELP_ROAD_TRAFFIC_LAYER"
                          },
                          {
                            "title":"🆘 About Vote of Survey",
                            "type":"postback",
                            "payload":"HELP_VOTE_OF_SURVEY"
                          },
                          {
                            "title":"🆘 About Birthday Programming",
                            "type":"postback",
                            "payload":"HELP_BIRTHDAY_PROGRAMMING"
                          }
                        ]
                      },
                      {
                        "title":"More",
                        "type":"nested",
                        "call_to_actions":[
                          {
                            "type":"web_url",
                            "title":"🤖 About Pinohh",
                            "url":"http://pinohh.herokuapp.com",
                            "webview_height_ratio":"full"
                          },
                          {
                            "type":"web_url",
                            "title":"💻 About Developers",
                            "url":"http://pinohh.herokuapp.com/team.php",
                            "webview_height_ratio":"full"
                          },
                          {
                            "title":"🔕 Unsubscribe",
                            "type":"postback",
                            "payload":"UNSUBSCRIBE"
                          }
                        ]
                      }
                    ]
                  }
                ]
              }';

  $jsonDataEncoded = $jsonData;
  //Tell cURL that we want to send a POST request.
  curl_setopt($ch, CURLOPT_POST, 1);
  //Attach our encoded JSON string to the POST fields.
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  //Set the content type to application/json
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  //Execute the request
  if(!empty($message))
  {
      $result = curl_exec($ch);
  }
  return $result ;
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
function displayAllService()
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

function askUnsubscribe()
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
                    "text":"Are you sure you want to unsubscribe?",
                    "quick_replies":[
                      {
                        "content_type":"text",
                        "title":"Yes unsubscribe",
                        "payload":"YES_UNSUBSCRIBE"
                      },
                      {
                        "content_type":"text",
                        "title":"Cancel",
                        "payload":"CANCEL"
                      }
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

function senderAction()
{
  global $message ;
  global $facebook_token ;
  global $sender ;

  $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$facebook_token;
  //Initiate cURL.
  $ch = curl_init($url);
  //The JSON data.
  $jsonData = '{
                "recipient":{
                	"id":"'.$sender.'"
                },
                "sender_action":"typing_on"
              }';

  $jsonDataEncoded = $jsonData;
  //Tell cURL that we want to send a POST request.
  curl_setopt($ch, CURLOPT_POST, 1);
  //Attach our encoded JSON string to the POST fields.
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  //Set the content type to application/json
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  //Execute the request
  if(!empty($message))
  {
      $result = curl_exec($ch);
  }

  return $result ;
}

function senderActionOff()
{
  global $message ;
  global $facebook_token ;
  global $sender ;

  $url = 'https://graph.facebook.com/v2.6/me/messages?access_token='.$facebook_token;
  //Initiate cURL.
  $ch = curl_init($url);
  //The JSON data.
  $jsonData = '{
                "recipient":{
                	"id":"'.$sender.'"
                },
                "sender_action":"typing_off"
              }';

  $jsonDataEncoded = $jsonData;
  //Tell cURL that we want to send a POST request.
  curl_setopt($ch, CURLOPT_POST, 1);
  //Attach our encoded JSON string to the POST fields.
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  //Set the content type to application/json
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  //Execute the request
  if(!empty($message))
  {
      $result = curl_exec($ch);
  }

  return $result ;
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
      return false;
    }
    else
    {
      return true ;
    }
}
function getRandomImage()
{
    $tableau = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
    $imageKey = array_rand($tableau);
    $imageId = $tableau[$imageKey];
    $imagePath = "pattern/background/".$imageId.".png" ;
    return $imagePath;
}
function getRandomMessage($name,$sender)
{
    $tableau  = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
    $messageKey = array_rand($tableau);
    $messageId = $tableau[$messageKey];
    $messagePath = "pattern/message/".$messageId.".txt" ;
    $message = file_get_contents($messagePath);
    $message = preg_replace("#@receiver@#", "$name", $message) ;
    $message = preg_replace("#@sender@#", "<br/>$sender", $message) ;
    return $message;
}

function basicResponse($message,$name)
{
    $reply  = " ";

    if(preg_match("#(hi|hello|good morning|morning)#i", $message))
    {
        $reply = "Hello ".$name." I'm happy to meet you ! ";
    }
    else if(preg_match("#(How doing |what's up|how are you)#i", $message))
    {
        $reply = "I'm fine. Thanks !";
    }
    else if(preg_match("#(name|what's your name|How do we call you)#i",$message))
    {
        $reply = "My name is Pinohh ! The name was choosed by my devs and I'm proud of it 😎😎 !";
    }
    else if(preg_match("#(what are you doing|what you do|what do you do)#i", $message))
    {
        $reply = "Now I'm tchating with you ".$name." 😀 ";
    }
    else if(preg_match("#(info|information|about you|about pinohh|more)#i", $message))
    {
        $reply = "Cool 😎 . visit us here https://pinohh.herokuapp.com";
    }
    else if(preg_match("#^(cool|ok|yes|haha|i'm fine)#i", $message))
    {
        $reply = "😉😉😉 👍🏾 ";
    }
    else if(preg_match("#^(bye|goodbye|see you soon|after|see you after)#i", $message))
    {
        $reply = getGiphy("goodbye");
    }
    else if(preg_match("#^(thank|thanks|thx|nice|cheer(s)?)#i", $message))
    {
        $reply = "😊😊";
    }
    else if(preg_match("#^(help|need help])$#i",$message))
    {
        $reply = "Hi there. So I can tell you the birthday programming , the survey vote and more.Please go to the persistent menu.";
    }
    else if(preg_match("#(where are you|where do you come from|where are you going)#i", $message))
    {
        $reply = "I'm from Cameroon 🇨🇲. I was made with ❤ by Cameroonians devs 💻 ! Get more information on the site : http://pinohh.herokuapp.com";
    }
    else if(preg_match("#^(time please|time|what is the time|what is the date)#i",$message))
    {
        $reply = "I'm not a clock's or calendar please watch in your device 😜😜";
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
        displayAllService();
        $query->addUser($sender,strtolower($message));
        file_put_contents($chemin,"");
    }
    else
    {
        sendTextMessage("Please provide a valid email or type none if you don't get one 😕 .");
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
        $url = "http://pinohhbot.000webhostapp.com/traffic.php?lat=$lat&long=$long";
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

    global $facebook_token ;
    global $sender ;
    global $message ;
    global $query ;

    $data = $query->getLastSurvey();
    sendImageMessage($data['image']);
    sendTextMessage("🎯 The survey of the week is : ".$data['text']."🎯");
    surveyResponse();

}

function testVote()
{
    global $message ;
    global $sender;
    global $name ;
    global $query ;

    if(preg_match("#^(for|against|neutral)#i", $message))
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
          sendTextMessage("thanks but, 😶 you have already voted for this survey.  Wait for the next poll to vote again.");
        }
    }
    else
    {
        sendTextMessage("Please vote by using either For, Against or Neutral .");
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
    sendTextMessage("Enter a good format of mail address or expression");
  }
}

function testBirthdayYear()
{
  global $sender ;
  global $message ;

  if(preg_match("#^(\d{4}/\d{2}/\d{2})$#i", $message) || preg_match("#^(today)#i", $message) || preg_match("#^(tomorrow)#i", $message))
  {
    if(preg_match("#^(today)#i", $message))
    {
      $date = date('Y/m/d');
    }
    else if(preg_match("#^(tomorrow)#i", $message))
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
    sendTextMessage("Your friend's birth year is incorrect from what I expect.");
  }
}

function testResponseText()
{
  global $message ;
  global $sender ;
  global $name;
  if(preg_match("#^(let pinohh choose)#i", $message))
  {
    sendTextMessage("Youuuupi !!! 🎉🎊🎊🎉🎊🎂🎂🎂. This anniversary has been very well programmed. I take care of everything from this moment.");
    $path = "fichier/birthday/".$sender.".txt";
    $tmp = file_get_contents($path);
    $tmp = $tmp." null ^ ".$name;
    file_put_contents($path,$tmp);
    file_put_contents("etape/".$sender.".txt","");
    sendBirthdayMessage(file_get_contents($path));
  }
  else if(preg_match("#^(I enter my text)#i", $message))
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

  if(strlen($message)>=3 AND preg_match("#(birthday|happy|hbd)#i", $message))
  {
    sendTextMessage("Youuuupi !!! 🎉🎊🎊🎉🎊🎂🎂🎂. This anniversary has been very well programmed. I take care of everything from this moment.");
    $path = "fichier/birthday/".$sender.".txt";
    $tmp = file_get_contents($path);
    $tmp = $tmp." ".$message. " ^ ".$name ;
    file_put_contents($path,$tmp);
    file_put_contents("etape/".$sender.".txt","");
    sendBirthdayMessage(file_get_contents($path));
  }
  else
  {
    sendTextMessage("Please enter a sentence that resembled a birthday sentence.");
  }
}

function unsubscribe()
{
  global $message ;
  global $sender ;
  global $name;
  global $query ;

  if(preg_match("#^(YES UNSUBSCRIBE)#i", $message) OR $message=="YES_UNSUBSCRIBE")
  {
    file_put_contents("etape/".$sender.".txt","");
    sendTextMessage("Please wait... ⏳");
    unlink("etape/".$sender.".txt");
    unlink("fichier/user/".$sender.".txt");
    unlink("fichier/birthday/".$sender.".txt");
    $query->desinscrire((int) $sender);
    sendTextMessage("All went well. Thank you for your trust $name .");
  }
  else if(preg_match("#^(cancel)#i", $message) OR $message=="CANCEL")
  {
    file_put_contents("etape/".$sender.".txt","");
    sendTextMessage("Waooow I was surprised at your decision $name 😀");
  }
  else
  {
    askUnsubscribe();
  }

}


function sendBirthdayMessage($text)
{
  global $sender;
  global $query ;
  $data = explode("^",$text);
  $friendName = trim($data[0]);
  $mail = trim($data[1]);
  $year = trim($data[2]);
  $message = trim($data[3]);
  $senderName = trim($data[4]);

  if(strtolower($message)=="null")
  {
    $message = getRandomMessage($friendName,$senderName);
  }

  $imgName = md5(random_int(0, 10000000000000));
  $getImage = getRandomImage();
  $newPath = "fichier/image/".$imgName.".png";
  copy($getImage,$newPath);
  file_put_contents("green.txt",$sender);
  $query->addNewBirthday($sender,$friendName,$year,$mail,$newPath,$message,$senderName);

}

function getMailpattern($friendName,$message,$image)
{
    return $mail = "<html><head><title>Happy Birthday $friendName !!!</title><link href=\"https://fonts.googleapis.com/css?family=Lobster\" rel=\"stylesheet\"><style></style></head><body><center><h1>Happy Birthday $friendName</h1><div style=\"background:url('http://pinohhbot.000webhostapp.com/$image'); width:943px;height:790px;\"><p style=\"font-size:4.1em;padding:50px;font-weight:bold;color:#3498db;font-family:Lobster\"> $message </p></div><span><em>By <a href=\"https://pinohh.herokuapp.com\">Pinohh</a></em></span></center></body></html>";

}

function viewResult()
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
                  "text":"View the survey result",
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
