<?php
require '../vendor/autoload.php';

define('DATA_PATH', realpath('../data') );

$response = new \StdClass;
$response -> succeed = true;


$options = array(
   'innate' => DATA_PATH.'/smartbot/memory/innate.php'     
);

try{
    $bot = new \SmartBot\Bot( DATA_PATH.'/smartbot/', $options );
} catch( \SmartBot\Bot\Exception $e ) {
    $response -> succeed = false;
    $response -> message = (get_class($e).' : '.$e -> getMessage() );
    echo json_encode($response);
    exit;
}

$bot -> addContext(array(
        'Humor:Funny',
        'Time:Morning',
        'Epoch:Winter'
));

$bot -> setCaller( $this -> identity() -> get() -> skype );
//         $ai -> setCaller( uniqid() );

$response -> messages = array();

foreach( explode(PHP_EOL, $bot -> talk( $this -> request -> getPost('message') ) ) as $botResponse ) {
    $message = new \stdClass();
    $message -> text = $botResponse;
    $message -> recipient = $bot -> getCaller();
    $message -> wait = 0;
    
    if(preg_match('/(.*)\/([0-9])/', $message -> text, $matches ) ) {
        $message -> text = $matches[1];
        $message -> wait = (int) $matches[2];
    }
    
    if( preg_match('/\[([a-z\.]+)\] (.*)/i', $message -> text, $matches ) )  {
        $message -> recipient  = $matches[1];
        $message -> text    = $matches[2];
    }
    
    $response -> messages[] = $message;
}


