<?php
declare(strict_types=1);
namespace App\Models;

use App\Entities\User;

class UserModel extends MyBaseModel
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = User::class;
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = [
        "name",
        "username",
        "email",
        "password",
        "role",
        "created_by",
        "updated_by",
        "deleted_by"
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        "name" => "required|min_length[3]|max_length[255]",
        "username" => "required|min_length[3]|max_length[255]",
        "email" => "required|valid_email",
        "password" => "permit_empty|min_length[6]",
        "role" => "required|in_list[admin,doctor,recepcionist]"
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = ["prepareOutput"];
    protected $beforeDelete = [];
    protected $afterDelete = [];
    protected $hidden = [
        "password",
        "created_by",
        "updated_by",
        "deleted_by",
        "created_at",
        "updated_at",
        "deleted_at"
    ];
}
