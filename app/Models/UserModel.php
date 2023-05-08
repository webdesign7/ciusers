<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'username',
        'password',
        'created_at'
    ];
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'first_name' => 'required|min_length[1]|max_length[64]',
        'last_name' => 'required|min_length[1]|max_length[64]',
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
        'mobile' => 'required|min_length[8]|max_length[11]',
        'username' => 'required|min_length[6]|is_unique[users.username,id,{id}]',
        'password' => 'required|min_length[6]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['encryptPassword'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['encryptPassword'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * @param array $data
     * @return array
     * @throws \Exception
     */
    protected function encryptPassword(array $data): array
    {
        if (! isset($data['data']['password'])) {
            return $data;
        }
        // todo add a private key for better encryption
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);

        return $data;
    }

}
