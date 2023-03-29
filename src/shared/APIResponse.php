<?php

namespace Src\shared;

class APIResponse{
    function __construct(private $code, private $status, private $msg, private $data)
    {
        
    }

    public function toArray(){
        return [
            "code" => $this->code,
            "status" => $this->status,
            "msg" => $this->msg,
            "data" => $this->data
        ];
    }
}