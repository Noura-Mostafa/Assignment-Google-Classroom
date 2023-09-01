<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HadaraSms
{
    protected $baseUrl = 'http://smsservice.hadara.ps:4545/SMS.ashx/bulkservice/sessionvalue';

    protected $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function send($to , $message)
    {
        $response = Http::baseUrl($this->baseUrl)
          ->get('sendmessage' , [
            'apiKey' => $this->key,
            'to' => $to,
            'msg' => $message
          ]);

        dd($response->body());
    }
}