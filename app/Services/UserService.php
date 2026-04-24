<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepository;
use App\Entities\User;
use InvalidArgumentException;
use Exception;

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getUsers(array $params): array
    {
        if (isset($params["perPage"]) && !is_numeric($params["perPage"])) {
            throw new InvalidArgumentException("O paramêtro deve ser um número inteiro positivo.");
        }

        $perPage = (int) ($params["perPage"] ?? 10);
        
        if(isset($params["page"]) && !is_numeric($params["page"])) {
            throw new InvalidArgumentException("O paramêtro deve ser um número inteiro positivo.");
        }

        $page = (int) ($params["page"] ?? 1);

        $filters = [
            "search" => $params["search"] ?? null,
            "role" => $params["role"] ?? null,
            "sort" => $params["sort"] ?? null,
            "orderBy" => $params["orderBy"] ?? null
        ];

        $users = $this->userRepository->getUsers($filters, $perPage, $page);
        return $users;
    }
}