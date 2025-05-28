<?php

namespace App\Repositories\Contracts;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function categoryAdd($data, $id);

    public function tagAdd($data, $id);
}
