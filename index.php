<?php
/*
1. Create your bot with BotFather. See https://core.telegram.org/bots
2. Get your bot API Token.
3. Set your webhook URL using this (replace with your token and url parameter): https://api.telegram.org/botxxxAPIxxx:xxxTokenxxx/setWebHook?url=https://www.yourdomain.com/bot/index.php
4. Start conversation with your bot and see what happens!
5. You should receive a response like this:

yourbot, [Mar 5, 2022 at 12:32:51 AM]:
Hello there! This is a test message from YourBot

Your ChatID is: 012345678
*/

// Include TelegramBot Class
require_once "TelegramBot.php";

try {
    $bot    = new TelegramBot("xxxAPIxxx:xxxTokenxxx","YourBot");
    // Read php input stream
    $input  = file_get_contents("php://input");
    // Get Message Received
    $message_received = $bot->getMessage($input);
    // Get ChatID
    $chat_id = $message_received->chat->id;
    // Respond commands
    switch ($message_received->text) {
        // Send Hello Message
        case "/start"   :  $bot->sayHello($chat_id); 
        break;
        // Send Custom Message
        case "/custom"  :  $bot->sendMessage($chat_id, "This is a custom message.");
        break;
        // Send Bye Message
        case "/bye"     :  $bot->sendMessage($chat_id, "Bye!"); 
        break;
    }
}
catch(Exception $e){
    print("<pre>");
    print_r($e);
    print("</pre>");
}
finally{
    print("<pre>");
    print("Test complete.");
    print("</pre>");
}