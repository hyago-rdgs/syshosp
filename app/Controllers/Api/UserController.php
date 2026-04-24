<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Services\UserService;
use Exception;

class UserController extends BaseApiController
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        try {
            $params = [
                "search" => $this->request->getGet("search"),
                "role" => $this->request->getGet("role"),
                "sort" => $this->request->getGet("sort"),
                "orderBy" => $this->request->getGet("orderBy"),
                "perPage" => $this->request->getGet("perPage"),
                "page" => $this->request->getGet("page")
            ];

            $result = $this->userService->getUsers($params);

            return $this->respondSuccess($result["data"], "usuarios listados", $result["pager"], 200);
        } catch (Exception $e) {
            return $this->respondError("Erro ao buscar usuários", 500, $e->getMessage());
        }
    }
}