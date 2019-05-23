<?php

require_once('./vendor/autoload.php');

// Namespace
use \LINE\LINEBot\HTTPClient\CurlHTTPClient;
use \LINE\LINEBot;
use \LINE\LINEBot\MessageBuilder\TextMessageBuilder;

// Token
$channel_token =
'wXRlD4XPs+gtQhhgxLwLcekzU7cpGS0L7DuwT/Rij53yF4r3KGKijL2iWAfnzMdCYk+amyUoVpA9iG8FtokCGTHuUqSgnjT7rvHG6ExH7jQbfMfLvaMSVgebWYHdXckEUJsRZhF8E+93/b4ZZJzKkwdB04t89/1O/w1cDnyilFU=';
$channel_secret ='5b59e47c3d17b45ae8449d3c52bd3830';

// Get message from Line API

$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {

// Loop through each event
foreach ($events['events'] as $event) {

// Get replyToken
$replyToken = $event['replyToken'];
$ask = $event['message']['text'];

switch(strtolower($ask)) {
case 'm':
$respMessage = 'What sup man. Go away!';
break;
case 'f':
$respMessage = 'Love you lady.';
break;
default:
$respMessage = 'What is your sex? M or F';
break;
}

$httpClient = new CurlHTTPClient($channel_token);
$bot = new LINEBot($httpClient, array('channelSecret' => $channel_secret));

$textMessageBuilder = new TextMessageBuilder($respMessage);
$response = $bot->replyMessage($replyToken, $textMessageBuilder);

}
}
echo "OK";
