<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * @param $role
     * @return mixed
     */
   public function getByRole($role);

}
