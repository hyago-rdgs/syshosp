<?php
declare(strict_types=1);

namespace App\Repositories;
use App\Models\User;
use App\Models\UserModel;

class UserRepository
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function getUsers(array $filters = [], int $perPage = 10, int $page = 1): array
    {
        $builder = $this->userModel;

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $builder = $builder->groupStart()
                ->like("name", $search)
                ->orLike("username", $search)
                ->orLike("email", $search)
                ->groupEnd();
        }

        if (!empty($filters["role"])) {
            $builder = $builder->where("role", $filters["role"]);
        }

        if (!empty($filters["sort"])) {
            $allowedSorts = ["name", "username", "email", "created_at"];
            $sortField = in_array($filters["sort"], $allowedSorts) ? $filters["sort"] : "name";

            if (!empty($filters["orderBy"])) {
                $order = in_array($filters["orderBy"], ["asc", "desc"]) ? $filters["orderBy"] : "asc";
                $builder = $builder->orderBy($sortField, $order);
            }

            $builder = $builder->orderBy($sortField);

        }

        return [
            "data" => $this->userModel->paginate($perPage, "default", $page),
            "pager" => $this->userModel->pager->getDetails()
        ];
    }
}