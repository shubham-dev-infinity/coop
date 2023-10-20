<?php

class TelegramBot
{

    private $apiUrl;
    private $apiToken;
    private $chatId;

    function __construct($conn)
    {

        $this->apiUrl   = 'https://api.telegram.org/bot';

        $sql = "SELECT * FROM dashboard where meta_key='telegram_token'";
        if ($result = mysqli_query($conn, $sql)) {
            $row = $result->fetch_row();
            $this->apiToken = $row[2];
        }

        $sql = "SELECT * FROM dashboard where meta_key='telegram_chatid'";
        if ($result = mysqli_query($conn, $sql)) {
            $row = $result->fetch_row();
            $this->chatId   =  $row[2];
        }
    }

    public function send_message($message)
    {

        $data = [
            'chat_id' => $this->chatId,
            'text' => $message
        ];

        $request_url = $this->apiUrl . $this->apiToken . "/sendMessage?" . http_build_query($data);
        //die($request_url);
        return $this->send_request($request_url);
    }

    private function send_request($request_url)
    {

        $output = file_get_contents($request_url);

        return $output;
    }
}
