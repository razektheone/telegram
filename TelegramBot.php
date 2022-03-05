<?php

Class TelegramBot {

    protected $token        = "";
    protected $url          = ""; 
    protected $chat_id      = "";
    protected $parse_mode   = "";
    protected $bot_username = "";

    public function __construct($token, $bot_username, $parse_mode = 'Markdown'){
        $this->url          = "https://api.telegram.org/bot";
        $this->token        = $token;
        $this->bot_username = $bot_username;
        $this->parse_mode   = $parse_mode;
    }

    public function sendMessage($chat_id, $text, $reply = null){
        return $this->bot('sendMessage', [
                'chat_id'       => $chat_id,
                'text'          => $text,
                'reply_markup'  => $reply,
                'parse_mode'    => $this->parse_mode
            ]);
    }

    public function getMessage($input){
        $update = json_decode($input);
        return  $update->message;
    }

    public function sayHello($chat_id){
        $this->sendMessage($chat_id, "Hello there! This is a test message from $this->bot_username");
        $this->sendMessage($chat_id, "Your Chat ID is: $chat_id");
    }

    private function bot($method, $data){
        $url = $this->url . $this->token . "/$method";
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $res = curl_exec($ch);
        curl_close();
        return json_decode($res);
    }
}
?>