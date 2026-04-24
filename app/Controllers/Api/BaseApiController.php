<?php
declare(strict_types=1);

namespace App\Controllers\Api;
use CodeIgniter\RESTful\ResourceController;

class BaseApiController extends ResourceController
{
    protected function respondSuccess($data = null, string $message = "sucesso", array $meta = [], int $code = 200) {
        return $this->respond([
            "success" => true,
            "message" => $message,
            "data" => $data,
            "meta" => $meta,
            "error" => null
        ], $code);
    }

    protected function respondError(string $message = "erro na requisição", int $code = 400, $details = null) {
        return $this->respond([
            "success" => false,
            "message" => $message,
            "data" => null,
            "meta" =>null,
            "error" => [
                "code" => $code,
                "details" => $details
            ]
        ], $code);
    }
}