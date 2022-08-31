<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function login(string $email, $password)
    {
        $user = $this->model->where('email', $email)->first();
        if (!$user) return false;

        if (!Hash::check($password, $user->password)) return false;

        return $user;
    }


}
