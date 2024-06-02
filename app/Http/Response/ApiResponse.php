<?php

namespace App\Http\Response;

class ApiResponse 
{
    protected $data = [];
    protected $headers = [];
    protected $status = 200;
    protected $statusText = 'OK';
    protected $message = '';

    public function data ($data = [])
    {
        $this->data = $data;
        return $this;
    }

    public function headers ($headers = [])
    {
        $this->headers = $headers;
        return $this;
    }

    public function status ($status = 200)
    {
        $this->status = $status;
        return $this;
    }

    public function statusText ($statusText = 'OK')
    {
        $this->statusText = $statusText;
        return $this;
    }

    public function message ($message = '')
    {
        $this->message = $message;
        return $this;
    }

    public function send () 
    {
        $response = [
            'status' => $this->status,
            'statusText' => $this->statusText,
            'message' => $this->message,
            'api_version' => env('API_VERSION', 'v1'),
            'data' => $this->data
        ];

        return response($response, $this->status, $this->headers);
    }
}