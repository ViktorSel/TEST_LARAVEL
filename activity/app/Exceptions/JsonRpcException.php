<?php

namespace App\Exceptions;

use Exception;
use App\Http\Response\JsonRpcResponse;

class JsonRpcException extends Exception {

    protected $code;
    protected $message;
    protected $id;

	public function __construct($message, $id = null) {
        if ($message == 'Parse error') {
            $this->message = "Parse error";
            $this->code = -32700;
            $this->id = $id;
        }
	}

    public function register() {
        $this->reportable(function () {
            return JsonRpcResponse::error([
                "message" => $this->message,
                "code" => $this->code,
            ], $this->id | null);
        })->stop();
    }
}
